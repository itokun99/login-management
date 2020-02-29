<?php

namespace App\Http\Controllers\ClientApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientApp;
use App\ClientCredential;

class AppController extends Controller
{
    public function createCredential ($appId = NULL, $type = NULL) {
        if(!$appId || !$type) return FALSE;

        $uniq = \uniqid();
        $randInt = rand(1, 1000);
        $randStr = \str_random(10);
        $salt = "KCV01";
        $credential1 = \base64_encode("$appId|$type|$uniq|$randInt|$randStr|$salt");
        $credential2 = \base64_encode("$salt|$randStr|$randInt|$uniq|$type|$appId");
        $genCredential = \base64_encode("$credential1|$credential2");

        $create = ClientCredential::create([
            'appId' => $appId,
            'type' => $type,
            'credential' => $genCredential
        ]);

        if(!$create) return FALSE;
        return $genCredential;
    }
    public function appValidator(Request $request) {

        // the app key 
        $appKey = $request->get('appKey');

        // redirect is callback after request flow
        $redirect = $request->get('redirectUrl');

        // custom page for auth
        $authPageUrl = $request->get('authPageUrl');

        /**
         * TYPE OF REQUEST | signin / signup
         */
        $type = $request->get('type');

        $isEmpty = !$appKey || !$redirect || !$type;
        
        if($isEmpty) return  $this->responseError(NULL, "Opp's something wrong, invalid params");

        if($type !== 'signin' && $type !== 'signup') {
            return $this->responseError(NULL, "Opp's something wrong, invalid type of request, allowed type is signin or signup");
        }

        $clientApp = $this->findOne(new ClientApp, 'appKey', $appKey);

        if(!$clientApp) return $this->responseError(NULL, 'appKey not valid, request rejected');

        $credential = $this->createCredential($clientApp->appId, $type);
        if(!$credential) return $this->responseError(NULL, "Opp's something wrong, credential not created! please try again");

        if(!$authPageUrl) $authPageUrl = "http://localhost:8888/signin";
        $url = "$authPageUrl?appKey=$appKey&redirectUrl=$redirect&type=$type&credential=$credential";
        $response = [
            'type' => $type,
            'credential' => $credential,
            'redirectUrl' => $redirect,
            'appKey' => $appKey,
            'url' => $url
        ];

        return $this->responseSuccess($response, 'Credential created');
    }


    public function checkValidator(Request $request) {
        $credential = $request->header('credential');
        if(!$credential) return $this->responseError(NULL, 'Invalid Credential');
        $exist = $this->findOne(new ClientCredential, 'credential', $credential);
        if(!$exist) return $this->responseError(NULL, 'Invalid Credential');
        return $this->responseSuccess(NULL, 'Credential Found');
    }
}
