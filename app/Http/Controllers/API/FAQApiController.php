<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\FaqAPI;
use App\Models\setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class FAQApiController extends Controller
{
    //
    public function index(Request $request)
    {

        $faq = FaqAPI::query()->where('deleted_at','=',null)->get();
        return  $this->api_response(JsonResponse::HTTP_ACCEPTED,true,trans('faq.FAQ list') , $faq , 200);



    }

}
