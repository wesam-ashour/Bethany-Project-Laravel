<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Settings;
use App\Models\API\SettingsAPI;
use App\Models\setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SettingsApiController extends Controller
{
    //
    public function index(Request $request)
    {

        $settings = SettingsAPI::query()->get()->first();
        $settings->image = url(asset('public/images/main/'.$settings->image));
        return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('options.Home Page') , $settings , 200);


    }

}
