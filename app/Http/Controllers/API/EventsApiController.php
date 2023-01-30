<?php

namespace App\Http\Controllers\API;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerified;
use App\Mail\EventMail;
use App\Mail\MessageMail;
use App\Mail\registereduser;
use App\Models\API\EventAPI;
use App\Models\API\EventUserAPI;
use App\Models\API\UserAPI;
use App\Models\Event;
use App\Models\Events;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Exception;

class EventsApiController extends Controller
{
    //
    public function index(Request $request)
    {
        $id = $request->id ;
        $events = EventAPI::query()->where('status',1)->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        if ($id){
            $events = EventAPI::query()->where('status',1)->where('id',$id)->get()->first();
        }
        return  $this->api_response(4,true,trans('event.Events List') , $events , 200);


    }

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|string',
            'mobile' => 'required',
            'address' => 'required',
        ], [
            'full_name.required' => trans("event.full name field is required"),
            'email.required' => trans("event.email field is required"),
            'mobile.required' => trans("event.mobile field is required"),
            'address.required' => trans("event.address field is required"),
        ]);
        if($validator->passes()) {
            $cheak_event_id = EventAPI::find($request->event_id);
            if ($cheak_event_id) {
                $checkuser = UserAPI::where('email', $request->email)->where('mobile', $request->mobile)->first();
                $cheakemail = UserAPI::where('email', '=', $request->email)->get()->first();
                $cheakmobile = UserAPI::where('mobile', '=', $request->mobile)->get()->first();
                $eventUser = new EventUserAPI();

                //check if user exist
                if($checkuser == null){
                    if ($cheakemail){
                        return $this->setError(200, true, trans('event.The email is already used'), 200);
                    }
                    if ($cheakmobile){
                        return $this->setError(200, true, trans('event.The mobile number is already in use'), 200);
                    }
                    try {
                    $user = new UserAPI();
                    $user->full_name = $request->full_name;
                    $user->email = $request->email;
                    $user->mobile = $request->mobile;
                    $user->address = $request->address;
                    $user->created_at = Carbon::now();
                    $user->updated_at = Carbon::now();
                    $user->save();
                    Mail::to($request->email)->send(new EmailVerified(DB::getPdo()->lastInsertId()));
                    $eventUser->user_id = DB::getPdo()->lastInsertId();
                    $eventUser->event_id = $request->event_id;
                    $eventUser->created_at = Carbon::now();
                    $eventUser->save();
                    return $this->api_response(200, true, trans('event.The event has been successfully registered'), '', 200);
                    } catch (Exception $e) {
                        return $this->setError(200, false, trans('event.An error occurred during registration, please try again'), 200);
                    }

                }
                // Check if the user has been registered for this event before
                $previous_registration = EventUserAPI::where('user_id', $checkuser->id)->where('event_id', $request->event_id)->get()->first();
                if ($previous_registration) {
                    return $this->setError(200, true, trans('event.the user already regsiter in this event'), 200);
                } else {
                    // Register the user for the event
                    EventUserAPI::create([
                        'user_id' => $checkuser->id,
                        'event_id' => $request->event_id
                    ]);
                    return $this->api_response(2, true, trans('event.The event has been successfully registered'), '', 200);
                }
            } else {
                return $this->setError(200, true, trans('event.The event id not found'), 200);
            }
        }else{
            return  $this->setError(200 ,false, $validator->errors()->first() , 200);

        }
    }

    public function verified($id){
        $user = UserAPI::query()->where('id',$id)->get()->first();
        $user->email_verified = 'true';
        $user->update();
        return view('forms.users.emailVerifyDone');
    }
}
