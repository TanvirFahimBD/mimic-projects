<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SessionMiddlewareController extends Controller
{
    function LogAction(Request $request)
    {
        $num1 = $request->num1;
        $num2 = $request->num2;
        $res = $num1+$num2;
        Log::info($res);
        return $res;
    }
    function SessionPUT(Request $request):bool
    {
        $email = $request->email;
        $request->session()->put('user_email', $email);
        return true;
    }
    function SessionPULL(Request $request):string
    {
        $email = $request->session()->pull('user_email', 'default');
        return $email;
    }

    function SessionGET(Request $request):string
    {
        $email = $request->session()->get('user_email', 'default');
        return $email;
    }
    function SessionForget(Request $request):bool
    {
        $request->session()->forget('user_email');
        return true;
    }
    function SessionFlush(Request $request):string
    {
        $request->session()->flush();
        return 'flush done';
    }

    function MiddleWareTest(Request $request)
    {
//        $request->headers->add(['newEmail'=>'tanvir@gmail.com']);
//        $request->headers->replace(['email'=>'f@g.com']);
        $request->headers->remove('email');
        return $request->header('email');
    }

    function MiddleWareTest2(Request $request):string
    {
        return 'MiddleWare2 Test Done';
    }

    function RequestLimit(Request $request):string
    {
        return 'Limited request Done';
    }
}
