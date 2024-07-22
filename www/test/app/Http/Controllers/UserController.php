<?php

namespace App\Http\Controllers;

use App\Models\GptRecord;
use App\Models\GptUser;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class UserController extends BaseController
{
    public function getList()
    {

        $a = new IndexController();
        $a->callAction('index', []);die;

        $cache_key = 'gpt_user_list';
        $m = Cache::get($cache_key);
        if(!$m) {
            $m = GptUser::query()
                ->with(['record' => function ($query) {
                    $query->select(['id', 'userid', 'title', 'content', 'created_at']);
                }])
                ->get()?->toArray();
            Cache::add($cache_key, $m, 30);
        }

        return view('user/index', ['title' => 'test', 'data' => $m]);
    }

    public function offline()
    {
        echo '禁用';
        die;
        $user = GptUser::query()->where([['status', '=', 1], ['token', 'not like', '2023-%']])->update(['token' => date('Y-m-d His')]);

        return json_encode(['code' => 200, 'msg' => 'succ', 'data' => $user]);
    }

    public function add($username)
    {
        if (empty($username)) {
            return json_encode(['code' => 500, 'msg' => 'err', 'data' => '']);
        }
        $user = GptUser::query()->select(['id', 'status'])->where(['username' => $username])->first()?->toArray();
        if ($user) {
            if ($user['status'] == 1) {
                return json_encode(['code' => 302, 'msg' => 'err', 'data' => '']);
            }
            $user = GptUser::query()->where(['username' => $username])->update([
                'status' => 1,
            ]);
        } else {
            $user = GptUser::query()->insert([
                'username' => $username,
                'token' => '0',
                'login_time' => 0
            ]);
        }

        return json_encode(['code' => 200, 'msg' => 'succ', 'data' => $user]);
    }

    public function disable($username)
    {
        if (empty($username)) {
            return json_encode(['code' => 500, 'msg' => 'err', 'data' => '']);
        }
        $user = GptUser::query()->select(['id', 'status'])->where(['username' => $username, 'status' => 1])->first()?->toArray();
        if (!$user) {
            return json_encode(['code' => 302, 'msg' => 'err', 'data' => '']);
        }
        $user = GptUser::query()->where(['username' => $username])->update([
            'status' => 0,
        ]);

        return json_encode(['code' => 200, 'msg' => 'disable succ', 'data' => $user]);
    }

    public function del($username)
    {
        if (empty($username)) {
            return json_encode(['code' => 500, 'msg' => 'err', 'data' => '']);
        }
        $user = GptUser::query()->select(['id', 'status'])->where(['username' => $username, 'status' => 0, 'login_time' => 0])->first()?->toArray();
        if (!$user) {
            return json_encode(['code' => 302, 'msg' => 'err', 'data' => '']);
        }
        $user = GptUser::query()->where(['username' => $username])->delete();

        return json_encode(['code' => 200, 'msg' => 'del succ', 'data' => $user]);
    }
}
