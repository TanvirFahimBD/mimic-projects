<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DemoController extends Controller
{
    function ViewPage1()
    {
        return view('page.demo');
    }

    function ViewPage2()
    {
        return view('page.welcome');
    }

    public function __invoke(Request $request):string
    {
        return 'Hi without call';
    }

    function GetString(Request $request):string
    {
        return 'From controller';
    }

    function GetParameterByUrl(Request $request): string
    {
        $name = $request->name;
        $email = $request->email;
        return "Email: ${email} & Name: ${name}";
    }

    function PostParameterByBody(Request $request): array
    {
        return $request->input();
    }
    function PostParameterByHeader(Request $request): array
    {
        $pin = $request->header('pin');
        return ["pin"=>$pin];
    }

    function PostAll(Request $request): array
    {
        $age = $request->age;
        $pin = $request->header('pin');
        $name = $request->input('name');
        $email = $request->input('email');
        return [
            "age"=>$age,
            "pin"=>$pin,
            "name"=>$name,
            "email"=>$email,
        ];
    }

    function PostFormData(Request $request): array
    {
        return $request->input();
    }

    function PostFormDataFile(Request $request): array
    {
        $img = $request->file('attachment');
        $fileSize = filesize($img);
        $fileType = filetype($img);
        $fileOrigianlName = $img->getClientOriginalName();
        $fileTempName = $img->getFilename();
        $extension = $img->extension();

        return [
            "fileSize"=>$fileSize,
            "fileType"=>$fileType,
            "fileOrigianlName"=>$fileOrigianlName,
            "fileTempName"=>$fileTempName,
            "extension"=>$extension,
        ];
    }

    function PostFormDataFileStoreMove(Request $request): bool
    {
        $img = $request->file('attachment');
        $fileOrigianlName = $img->getClientOriginalName();
//        $img->move(public_path('upload'), $fileOrigianlName);

        $img->storeAs('uploads', $fileOrigianlName);
        return true;
    }

    function HeaderMis(Request $request): string
    {
        $ip = $request->ip();
        $acceptableContentType = $request->getAcceptableContentTypes();
//        return $acceptableContentType;

        if($request->accepts(['text\html', 'application\json'])){
            return  'true';
        }
        else{
            return  'false';
        }
    }

    function CookieRequest(Request $request): string
    {
//        return $request->cookie();
        return $request->cookie('laravel_session');
    }

    function MisResponse(Request $request): array|null|int|bool|string
    {
        return [
            'a' => 10
        ];
    }

    function JSONRes(Request $request): JsonResponse
    {
        return response()->json(['a'=> 560], 201);
    }

    function RedirectRes1():string
    {
        return redirect('/');
    }

    function BinaryView():BinaryFileResponse
    {
        $filePath = 'upload/448804829_824076516361274_6203799954851927381_n.jpg';
        return response()->file($filePath);
    }

    function BinaryDownload():BinaryFileResponse
    {
        $filePath = 'upload/448804829_824076516361274_6203799954851927381_n.jpg';
        return response()->download($filePath);
    }

    function CookieResponse()
    {
        $name='demo_cookie';
        $value='cookie value';
        $minutes=60;
        $path='/';
        $domain=$_SERVER['SERVER_NAME'];
        $secure=true;
        $httpOnly=true;
        return response('hello world')->cookie($name,$value,$minutes,$path,$domain,$secure,$httpOnly);
    }

    function HeaderResponse()
    {
        return response('hi')
            ->header('key1', 'value1')
            ->header('key2', 'value2')
            ->header('key3', 'value3');
    }
}
