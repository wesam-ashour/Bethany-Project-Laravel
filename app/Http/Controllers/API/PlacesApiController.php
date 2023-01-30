<?php

namespace App\Http\Controllers\API;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Mail\EventMail;
use App\Mail\registereduser;
use App\Models\API\PlacesAPI;
use App\Models\API\ScannedsAPI;

use App\Models\Event;
use App\Models\Events;
use App\Models\EventUser;
use App\Models\Places;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlacesApiController extends Controller
{
    //
    public function index(Request $request)
    {

        $p_id = $request->p_id ;
        $places = PlacesAPI::query()->get();

        $lat = $request->lat;
        $lon = $request->long;
        if ($lat && $lon){
                $points = $request->input('points');
                $data = [];

                $earthRadius = 6371;
                $latFrom = deg2rad($lat);
                $lonFrom = deg2rad($lon);

                foreach ($places as $point) {
                    $latTo = deg2rad($point['lat']);
                    $lonTo = deg2rad($point['long']);
                    $latDelta = $latTo - $latFrom;
                    $lonDelta = $lonTo - $lonFrom;
                    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                    $distance = $angle * $earthRadius;
                    $point['distance'] = (int)($distance*1000 / 10) * 10 + 9;
                    $data[] = $point;

                }
        }
        if ($p_id) {
            $places = PlacesAPI::query()->where('type', 1)->where('id',$p_id)->get();
        }
        return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('place.Places list') , $places , 200);



    }

    public function scanned_qr(Request $request){

       $validator = Validator::make($request->all(),[
            'qr_code' => 'required',
        ], [
            'qr_code.required' => trans("place.qr_code field is required"),

        ]);
        if ($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],409);

        }
        $places = PlacesAPI::query()->where('QRCode',$request->qr_code)->get()->first();

        if($places){
            $places->increment('scanned');

            $scanneds = new ScannedsAPI();

            $scanneds->place_id = $places->id;
            $scanneds->created_at = Carbon::now();
            $scanneds->updated_at = Carbon::now();

            $scanneds->save();

            return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('place.Places Scanned') , $places , 200);
        }else{
            return response()->json(['error'=> trans("place.No data for readable QR code")],409);
        }


    }
}
