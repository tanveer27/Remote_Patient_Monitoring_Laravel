<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use dingo\api\http\requests;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Routing\Helpers;
use App\User;
use App\Itoken;

class AuthenticatePatient extends Controller
{

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password', 'type');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json('invalid_credentials');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json('could_not_create_token');
        }

        // all good so return the token
        // $new_user=$this->getAuthenticatedUser();
        
        $user = JWTAuth::setToken($token)->authenticate();
        $id=$user['id'];        
        $UserID="";
        $AccessToken="";
        $Expires="";
        $RefreshToken="";
        $RefreshTokenExpires="";
        $itok=Itoken::where('user_id',$id)->get();
        if($itok!=null){
        return response()->json(array('devicetokens'=>$itok,'token'=>$token));}
        else{
        return "akam";}
        //return response()->json($u_id);
        
    }
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }
    public function getAuthenticatedUser()
    {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found']);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired']);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid']);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent']);


        }

        // the token is valid and we have found the user via the sub claim
        return response()->json($user);
    }
    public function getToken()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->response->errorMethodNotAllowed('Token not provided');
        }
        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->response->errorInternal('Not able to refresh Token');
        }
        return $this->response->withArray(['token' => $refreshedToken]);
    }
    public function registerpat(){
       // app\User::class->create(['password' => bcrypt($request->password)],['name'=>$request->name],['email'=>$request->email],['type'=>$request->type]);
        $user=new User;
        $rtoken=str_random(16);
        $user->create(['password' => bcrypt("faisal123"),'name'=>"Imran reza",'remember_token' =>$rtoken,'email'=>"faisal785@gmail.com",'type'=>"pat",]);
        var_dump($rtoken);
    }
}
