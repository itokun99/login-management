<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\ClientApp;
use App\ClientCredential;
use Carbon;

class AuthController extends Controller
{
    function generateKey($userId = NULL, $name = NULL, $email = NULL) {
        $timestamp = time();
        $init = 'KABAYANCODING';
        $uniqId = \uniqid();
        $rand = str_random(60);
        $base64 = base64_encode($rand);
        $generateKey = "$init|$userId|$name|$email|$timestamp|$uniqId|$base64";
        $token = base64_encode($generateKey);
        return $token;
    }

    function generateId() {
        $version = 01;
        $randInt = rand(1, 100) + rand(1, 100);
        $timestamp = time();
        $userId = "$randInt$timestamp$version";
        return $userId;
    }

    public function signIn(Request $request) {

        // list of parameter
        $appKey = $request->header('appKey');
        $redirectUrl = $request->header('redirectUrl');
        $credential = $request->header('credential');
        $email = $request->input('email');
        $password = $request->input('password');

        // check if empty params and form
        $isEmptyParams =  !$redirectUrl || !$appKey || !$credential;
        $isEmptyForm = !$email || !$password;
        if($isEmptyParams) return $this->responseError(NULL, "Oop's something wrong, Invalid param. Please check url parameter");
        if($isEmptyForm) return $this->responseError(NULL, "Sign In failed, please fill the form correctly");

        // check if email not valid format
        $isValidEmail = $this->validateEmail($email);
        if(!$isValidEmail) return $this->responseError(NULL, "Sign In failed, Email is not valid");

        // check if appKey invalid
        $clientApp = ClientApp::where('appKey', $appKey)->first();
        if(!$clientApp) return $this->responseError(NULL, "invalid appKey");



        // get credential data
        $appId = $clientApp->appId;
        $getCredential = ClientCredential::where('credential', $credential)
                                            ->where('appId', $appId)
                                            ->first();
        if (!$getCredential) return $this->responseError(NULL, "invalid credential");

        // get user data
        $user = User::where('appId', $appId)->where('email', $email)->where('googleId', NULL)->first();
        if(!$user) return $this->responseError(NULL, "Sign In failed, User not registered");

        $checkPassword = $this->checkHash($password, $user->password);
        if(!$checkPassword) return $this->responseError(NULL, "Sign In failed, Wrong password!");  

        // delete the credential if success
        $getCredential->delete();

        // send success response

        $url = "$redirectUrl?unique=$user->token&action=signin";
        $response = [
            'user' => $user,
            'token' => $user->token,
            'redirectUrl' => $url
        ];
        return $this->responseSuccess($response, 'Sign In successfull!');
    }

    public function signUp(Request $request) {
        // list of parameter
        $appKey = $request->header('appKey');
        $redirectUrl = $request->header('redirectUrl');
        $credential = $request->header('credential');

        // form input
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // check if empty params and form
        $isEmptyParams =  !$redirectUrl || !$appKey || !$credential;
        $isEmptyForm = !$email || !$password;
        if($isEmptyParams) return $this->responseError(NULL, "Oop's something wrong, Invalid param. Please check url parameter");
        if($isEmptyForm) return $this->responseError(NULL, "Sign In failed, please fill the form correctly");

        // check if email not valid format
        $isValidEmail = $this->validateEmail($email);
        if(!$isValidEmail) return $this->responseError(NULL, "Sign In failed, Email is not valid");

        // check password
        if(strlen($password) < 6) return $this->responseError(NULL, 'password must be more 6 character!');
        $password = $this->createHash($password);
        if(!$password) return $this->responseError(NULL, 'Opps!, something wrong when creating password');

        // check if appKey invalid
        $clientApp = ClientApp::where('appKey', $appKey)->first();
        if(!$clientApp) return $this->responseError(NULL, "invalid appKey");

        // get credential data
        $appId = $clientApp->appId;
        $getCredential = ClientCredential::where('credential', $credential)
                                            ->where('appId', $appId)
                                            ->first();
        if (!$getCredential) return $this->responseError(NULL, "invalid credential");

        // check existing user
        $user = User::where('appId', $appId)->where('email', $email)->where('googleId', NULL)->first();
        if($user) return $this->responseError(NULL, 'User is already registered');

        $userId = $this->generateId();
        $token = $this->generateKey($userId, $name, $email);


        $user = User::create([
            'appId' => $appId,
            'userId' => $userId,
            'email' => $email,
            'name' => $name,
            'password' => $password,
            'token' => $token,
            'status' => 'active',
            'isLogin' => 1
        ]);

        // error if user not created
        if(!$user) return $this->responseError(NULL, 'Sign Up Failed, Please try again!');

        // delete the credential if success
        $getCredential->delete();

        $url = "$redirectUrl?unique=$user->token&action=signup";
        $response = [
            'user' => $user,
            'token' => $user->token,
            'redirectUrl' => $url
        ];

        return $this->responseSuccess($response, 'Sign Up successfully, Now you can sign in');
    }


    public function signInWithGoogle(Request $request) {

        // list of parameter
        $appKey = $request->header('appKey');
        $redirectUrl = $request->header('redirectUrl');
        $credential = $request->header('credential');

        // google parameter
        $googleId = $request->input('googleId');
        $email = $request->input('email');
        
        // check the parameter
        $isEmptyParams =  !$redirectUrl || !$appKey || !$credential;
        $isEmptyForm = !$googleId || !$email;
        if($isEmptyParams) return $this->responseError(NULL, "Oop's something wrong, Invalid param. Please check url parameter");
        if($isEmptyForm) return $this->responseError(NULL, "Sign In failed, Google params is empty");

        // check if email not valid format
        $isValidEmail = $this->validateEmail($email);
        if(!$isValidEmail) return $this->responseError(NULL, "Sign In failed, Email is not valid");

        // check if appKey invalid
        $clientApp = ClientApp::where('appKey', $appKey)->first();
        if(!$clientApp) return $this->responseError(NULL, "invalid appKey");

        // get credential data
        $appId = $clientApp->appId;
        $getCredential = ClientCredential::where('credential', $credential)
                                            ->where('appId', $appId)
                                            ->first();
        if (!$getCredential) return $this->responseError(NULL, "invalid credential");

        $user = User::where('appId', $appId)
                    ->where('email', $email)
                    ->where('googleId', $googleId)
                    ->first();
        if(!$user) return $this->responseError(NULL, "Sign In failed, User not registered");

        // delete the credential if success
        $getCredential->delete();

        // send success response

        $url = "$redirectUrl?unique=$user->token&action=signin";
        $response = [
            'user' => $user,
            'token' => $user->token,
            'redirectUrl' => $url
        ];
        return $this->responseSuccess($response, 'Sign In successfull!');   
    }

    public function signUpWithGoogle(Request $request) {
        // list of parameter
        $appKey = $request->header('appKey');
        $redirectUrl = $request->header('redirectUrl');
        $credential = $request->header('credential');

        // google parameter
        $googleId = $request->input('googleId');
        $email = $request->input('email');
        $name = $request->input('name');
        $photo = $request->input('photo');

        // check the parameter
        $isEmptyParams =  !$redirectUrl || !$appKey || !$credential;
        $isEmptyForm = !$googleId || !$email || !$name;
        if($isEmptyParams) return $this->responseError(NULL, "Oop's something wrong, Invalid param. Please check url parameter");
        if($isEmptyForm) return $this->responseError(NULL, "Sign In failed, Google params is empty");

        // check if email not valid format
        $isValidEmail = $this->validateEmail($email);
        if(!$isValidEmail) return $this->responseError(NULL, "Sign In failed, Email is not valid");

        // check if appKey invalid
        $clientApp = ClientApp::where('appKey', $appKey)->first();
        if(!$clientApp) return $this->responseError(NULL, "invalid appKey");

        // get credential data
        $appId = $clientApp->appId;
        $getCredential = ClientCredential::where('credential', $credential)
                                            ->where('appId', $appId)
                                            ->first();
        if (!$getCredential) return $this->responseError(NULL, "invalid credential");

        // check existing user
        $user = User::where('appId', $appId)
                    ->where('email', $email)
                    ->where('googleId', $googleId)
                    ->first();
        if($user) return $this->responseError(NULL, 'User is already registered');

        $userId = $this->generateId();
        $token = $this->generateKey($userId, $name, $email);

        $user = User::create([
            'appId' => $appId,
            'userId' => $userId,
            'email' => $email,
            'name' => $name,
            'token' => $token,
            'googleId' => $googleId,
            'status' => 'active',
            'isLogin' => 1,
            'photo' => $photo
        ]);

        // error if user not created
        if(!$user) return $this->responseError(NULL, 'Sign Up Failed, Please try again!');

        // delete the credential if success
        $getCredential->delete();

        $url = "$redirectUrl?unique=$user->token&action=signup";
        $response = [
            'user' => $user,
            'token' => $user->token,
            'redirectUrl' => $url
        ];

        return $this->responseSuccess($response, 'Sign Up successfully');
    }
}
