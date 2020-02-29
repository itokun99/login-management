<?php

namespace App\Http\Controllers\ClientApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientApp;

class AuthController extends Controller
{
    function generateKey() {
        $rand = str_random(30);
        $base64 = base64_encode($rand);
        $appKey = "$base64";
        return $appKey;
    }

    function generateId() {
        $version = 01;
        $randInt = rand(1, 100) + rand(1, 100);
        $timestamp = time();
        $appId = "$randInt$timestamp$version";
        return $appId;
    }

    public function register(Request $request) {
        $appName = $request->input('appName');
        $appEmail = $request->input('appEmail');

        $formValidate = !$appName || !$appEmail;

        if($formValidate) {
            return $this->responseError(NULL, 'Please fille the form correctly');
        }
        
        $emailValid = $this->validateEmail($appEmail);
        if(!$emailValid) return $this->responseError(NULL, 'Email is not valid');

        $appId = $this->generateId();
        $appKey = $this->generateKey();
        $createApp = ClientApp::create([
            'appId' => $appId,
            'appName' => $appName,
            'appEmail' => $appEmail,
            'appKey' => $appKey
        ]);

        if(!$createApp) return $this->responseError($createApp, "Opps, something wrong when registering the App, Please try again");
        return $this->responseSuccess($createApp, 'Registering App successfull!, Now you can using MEMMA in your App');
    }

    public function checkRegistry (Request $request) {
        $appKey = $request->input('appKey');
        if(!$appKey) return $this->responseError(NULL, 'Key is required');
        $app = ClientApp::where('appKey', $appKey)->first();
        if(!$app) return  $this->responseError(NULL, 'No app registered');
        return $this->responseSuccess($app, 'App founded');
    }
}
