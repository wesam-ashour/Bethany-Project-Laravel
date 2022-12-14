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
        $places = PlacesAPI::query()->where('type',1)->get();
        if ($p_id) {
            $places = PlacesAPI::query()->where('type', 1)->where('id',$p_id)->get();
        }
        return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('place.Places list') , $places , 200);



    }

    public function scanned_qr(Request $request){

        $places = PlacesAPI::query()->where('type',1)->where('QRCode',$request->qr_code)->get()->first();

        $places->increment('scanned');
        
        $scanneds = new ScannedsAPI();

        $scanneds->place_id = $places->id;
        $scanneds->created_at = Carbon::now();
        $scanneds->updated_at = Carbon::now();

        $scanneds->save();

        return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('place.Places Scanned') , $places , 200);


    }
}
