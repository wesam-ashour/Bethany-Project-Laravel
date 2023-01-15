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

        $events = EventAPI::query()->where('status',1)->get();
        if ($id){
            $events = EventAPI::query()->where('status',1)->where('id',$id)->get();
        }
        return  $this->api_response(4,true,trans('event.Events List') , $events , 200);


    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'email' => 'required|email|string',
            'mobile' => 'required',
            'address' => 'required',
        ], [
            'full_name.required' => trans("event.full name field is required"),
            'email.required' => trans("event.email field is required"),
            'mobile.required' => trans("event.mobile field is required"),
            'address.required' => trans("event.address field is required"),


        ]);
        if ($validator->fails()){
            return  $this->setError(400 ,false, $validator->errors()->first() , 400);


        }
        $cheak_event_id = EventAPI::find($request->event_id);
        if ($cheak_event_id){
        $user = new UserAPI();
        $eventUser = new EventUserAPI();
        $cheakuser = UserAPI::where('email', '=', $request->email)->first();
        $cheakmobile = UserAPI::where('mobile', '=', $request->mobile)->first();
        if ($cheakuser && $cheakmobile){
            $cheak_event_user = EventUserAPI::where('user_id', $cheakuser->id)->where('event_id',$request->event_id)->first();
            if ($cheak_event_user){
                return  $this->setError(400 ,false, trans('event.the user already regsiter in this event') , 400);
            }
            $eventUser->user_id = $cheakuser->id;
            $eventUser->event_id = $request->event_id;
            $eventUser->created_at = Carbon::now();
            $eventUser->save();

            return  $this->api_response(2,true,trans('event.The event has been successfully registered') , '' , 200);

        }else{
            if (!$cheakmobile){
                try {
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

                    } catch (Exception $e) {
                        return  $this->setError(400 ,false, trans('event.An error occurred during registration, please try again') , 400);
                    }
                return  $this->api_response(2,true,trans('event.The event has been successfully registered') , '' , 200);

            }
            return  $this->setError(400 ,false, trans('event.This mobile number is already in use') , 400);
        }
        }else{
            return  $this->setError(400 ,false,trans('event.The event id not found') , 400);
        }

    }

    public function verified($id){
        $user = UserAPI::query()->where('id',$id)->get()->first();
        $user->email_verified = 'true';
        $user->update();
        return view('users.emailVerifyDone');
    }
}
