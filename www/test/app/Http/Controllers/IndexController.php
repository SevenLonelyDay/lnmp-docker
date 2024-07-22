<?php

namespace App\Http\Controllers;

use App\Models\GptRecord;
use App\Models\GptUser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class IndexController extends BaseController
{
    public function __construct() {
//        $this->middleware('testmiddle')->only('index');
    }
    public function callAction($method, $parameters)
    {
        // 在执行控制器方法之前执行的操作
        echo 'beforeAction';

        $response = parent::callAction($method, $parameters);

        // 在执行控制器方法之后执行的操作
        // 例如，你可以在这里处理响应数据、日志记录等
        echo 'afterAction';

        return $response;
    }
    public function index() {
        echo '-----方法执行-----';
//        $cache_key = 'gpt_list';
//        $m = Cache::get($cache_key);
//        if(!$m) {
//            $m = GptRecord::query()->limit(20)->orderByDesc('id')->get()->toArray();
//            Cache::add($cache_key, $m, 60*3);
//        }
//
//        return view('welcome', ['title'=>'test', 'data' => $m]);
    }

    public function test() {

        echo 2;
    }
}
