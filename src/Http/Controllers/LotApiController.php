<?php


namespace Atiladanvi\LaravelObjectTrafic\Http\Controllers;

use Atiladanvi\LaravelObjectTrafic\LaravelObjectTrafic;
use Illuminate\Http\Request;

/**
 * Class LotApiController
 * @package Atiladanvi\LaravelObjectTrafic\Http\Controllers
 */
class LotApiController extends Controller
{

    /**
     * @param Request $request
     * @param $model
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     * @throws \Exception
     */
    public function index(Request $request, $model){

        if (isset(config('laravel-object-trafic.widgets')[$model])){
            $lot = new LaravelObjectTrafic($request->all(), $model);
            return response($lot->getWidget());
        }else{
            return abort(404);
        }

    }

}
