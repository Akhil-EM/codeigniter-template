<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;
use Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;
use mysqli;

class Auth extends BaseController
{
    private $UserModel = null;
    private $client;
    public function __construct()
    {
        helper(["get_response_object_helper", "form"]);
        $this->UserModel = new \App\Models\User();

        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));  // Replace with your Google Client ID
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));  // Replace with your Google Client Secret
        $this->client->setRedirectUri('http://localhost:8080/auth/callback');  // Replace with your redirect URI
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }
    public function login()
    {
        // if (session()->has('user')) return redirect()->to("/");
        $validation = null;
        $data = [
            "email" => null,
            "password" => null
        ];
        $error = null;
        $success = null;
        
        if ($this->request->getMethod() == "POST") {

            $validationRules = [
                "email" => "required|valid_email",
                "password" => "required|min_length[8]"];
            $validationMessages = [
                "email" => [
                    "required" => "Email is required",
                    "valid_email" => "Email is not valid",
                    "is_unique" => "Email is already registered"
                ],
                "password" => [
                    "required" => "Password is required",
                    "min_length" => "Password must be at least 8 characters"
                ]
            ];
            
            $data = $this->request->getPost();
            if (!$this->validate($validationRules, $validationMessages)) {
                $validation = $this->validator;
            } else {
                //check email exists
                $userExists = $this->UserModel->where("email", $this->request->getPost("email"))->first();
                if (!$userExists) {
                    $validation = $this->validator;
                    $validation->setError("email", "Email is not registered");
                }else if(!password_verify($this->request->getPost("password"), $userExists["password"])) {
                    $validation = $this->validator;
                    $validation->setError("password", "Password is incorrect");
                }else {
                    //save in database 
                    $data = [
                        "email" => null,
                        "password" => null,
                    ];
                    //set session and login user
                    session()->set('user',
                        [
                            "id" => $userExists["id"],
                            "name" => $userExists["name"],
                            "timestamp" => time()
                    ]);
                    return redirect()->to("/");

                }
            }
        }

        return view("admin/login_view", getResponseObject("login", $validation, $data, $error, $success));
    }

    public function loginWithGoogle(){
        $authUrl = $this->client->createAuthUrl();
        session()->set("googleLoginAction", "login");
        return redirect()->to($authUrl);
    }

    public function registerWithGoogle(){
        $authUrl = $this->client->createAuthUrl();
        session()->set("googleLoginAction", "register");
        return redirect()->to($authUrl);
    }

    public function callback(){
        if ($this->request->getVar('code')) {
            $token = $this->client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));

            if (!isset($token['error'])) {
                $this->client->setAccessToken($token['access_token']);

                // Get the user profile data from Google
                $google_service = new Google_Service_Oauth2($this->client);
                $user_info = $google_service->userinfo->get();
                if(session()->get("googleLoginAction") == "login"){
                    $email = $user_info->email;
                    $user = $this->UserModel->where('email', $email)->first();
                    if (!$user) {
                        $validation = null;
                        $data = [
                            "email" => null,
                            "password" => null
                        ];
    
                        return view("common/header_view", getResponseObject("login", $validation, $data,)) .
                            view("login_view", getResponseObject("login", $validation, $data)) .
                            view("common/footer_view", getResponseObject("login", $validation, $data, "Email is not registered, please register first"));
                    }else{
                        //set session and login user
                        session()->set('user',
                            [
                                "id" => $user["id"],
                                "name" => $user["name"],
                                "timestamp" => time(),
                                "passwordUpdated" => $user["password"] ? true : false
                        ]);
                        return redirect()->to("/");
                    }
                }
                
                if(session()->get("googleLoginAction") == "register"){
                    $email = $user_info->email;
                    $name = $user_info->name;
                    $userExists = $this->UserModel->where("email", $email)->first();
                    if($userExists){
                        $validation = null;
                        $data = [
                            "email" => null,
                            "password" => null
                        ];
    
                        return view("common/header_view", getResponseObject("login", $validation, $data,)) .
                            view("login_view", getResponseObject("login", $validation, $data)) .
                            view("common/footer_view", getResponseObject("login", $validation, $data, "Email is already registered, please login."));
                    }else{
                        $userId = $this->UserModel->insert([
                            "name" => $name,
                            "email" => $email,
                            "google_id" => $user_info->id,
                        ]);
                        $userDetails = $this->UserModel->where('id', $userId)->first();
    
    
                        session()->set('user',[
                                "id" => $userDetails["id"],
                                "name" => $name,
                                "timestamp" => time(),
                                "passwordUpdated" => false
                        ]);
                        return redirect()->to("/");
                    }
                }

               session()->set("googleLoginAction", null);
            }
        }

        return redirect()->to('/login');  // Redirect to login if there was an error
    }
    

    public function register()
    {
        
        if (session()->has('user')) return redirect()->to("/");
        $validation = null;
        $data = [
            "name" => null,
            "email" => null,
            "password" => null,
            "confirm_password" => null
        ];
        $error = null;
        $success = null;


        if ($this->request->getMethod() == "POST") {

            $validationRules = [
                "name" => "required",
                "email" => "required|valid_email|is_unique[users.email]",
                "password" => "required|min_length[8]",
                "confirm_password" => "required|matches[password]"
            ];
            $validationMessages = [
                "name" => ["required" => "Name is required"],
                "email" => [
                    "required" => "Email is required",
                    "valid_email" => "Email is not valid",
                    "is_unique" => "Email is already registered"
                ],
                "password" => [
                    "required" => "Password is required",
                    "min_length" => "Password must be at least 8 characters"
                ],
                "confirm_password" => [
                    "required" => "Confirm password is required",
                    "matches" => "Confirm password does not match"
                ]
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                $validation = $this->validator;
                $data = $this->request->getPost();
            } else {
                //check email exists
                $emailExists = $this->UserModel->where("email", $this->request->getPost("email"))->first();
                if ($emailExists) {
                    $validation = $this->validator;
                    $validation->setError("email", "Email is already registered");
                } else {
                    //save in database 
                    $this->UserModel->insert($this->request->getPost());
                    $data = [
                        "name" => null,
                        "email" => null,
                        "password" => null,
                        "confirm_password" => null
                    ];
                    $success = "Your Registration completed successfully";
                }
            }
        }

        return view("admin/register_view",getResponseObject("register", $validation, $data, $error, $success));
    }

    public function logout()
    {
        if (session()->has('user')) {
            // Destroy the session
            session()->destroy();
            // Use JavaScript to display a message, then redirect
            return redirect()->to("/login");
        } else {
            // Redirect to login if the user is not logged in
            return redirect()->to("/login");
        }
        
    }
}
