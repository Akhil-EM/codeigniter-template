<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Ramsey\Uuid\Uuid;
use CodeIgniter\Config\Services;
class Profile extends BaseController
{
    private $UserModel;
    public function __construct(){
        $this->UserModel = new \App\Models\User();
        helper(["get_response_object_helper"]);
    }
    public function index()
    {
        return view("admin/profile_view");
        if (!session()->has('user')) return redirect()->to("/login");
    
        $validation = null;
        $userId = session()->get("user")["id"];
        $profile = $this->UserModel->select('id,name,password,image')->find($userId);
        $success = null;
    
        $data = [
            "profile" => [
                "name" => $profile["name"] ? $profile["name"] : null,
                "password" => null,
                "confirm_password" => null,
                "profileImage"=>$profile["image"]
            ]];
       
        if ($this->request->getMethod() == "POST") {
            // Fetch user inputs
            $name = $this->request->getPost("name");
            $password = $this->request->getPost("password");
            $confirmPassword = $this->request->getPost("confirm_password");
            
            // Set initial data for the view
            $data["profile"] = [
                "name" => $name,
                "password" => $password,
                "confirm_password" => $confirmPassword
            ];
    
            // Validation rules and messages
            $validationRules = [
                "name" => "required"
            ];
            $validationMessages = [
                "name" => [
                    "required" => "Name is required"
                ]
            ];
           
            // Perform validation
            if (!$this->validate($validationRules, $validationMessages)) {
                // Validation failed
                $validation = $this->validator;
            } else if($password && strlen($password) < 8) {
                $validation = $this->validator;
                $validation->setError("password", "Password must be at least 8 characters");
            }else if($password && $password != $confirmPassword){
                $validation = $this->validator;
                $validation->setError("confirm_password", "Passwords must match");
            }else{
              // Validation passed
              if($password){
                $this->UserModel->update($userId, [
                    "name" => $name,
                    "password" => password_hash($password, PASSWORD_DEFAULT)
                ]);
                $data = [
                    "profile" => [
                        "name" => $name,
                        "password" => null,
                        "confirm_password" => null
                    ]
                    ];
                session()->set("user", [
                    "id" => $userId,
                    "name" => $name,
                    "passwordUpdated" => true
                ]);
              }else{
                $this->UserModel->update($userId, [
                    "name" => $name
                ]);
              }
              $success = "Profile updated successfully";
            }
            
        }
    
        return view("common/header_view", getResponseObject("profile")) .
            view("profile_view", getResponseObject("profile", $validation, $data)) .
            view("common/footer_view", getResponseObject("profile", $validation, $data, null, $success));
    }
    
    public function updateImage()
    {
        if (!session()->has('user')) {
            return redirect()->to("/login");
        }
        $requestBody = $this->request->getBody();

        // Log the request body
        Services::logger()->info('Request Body: ' . $requestBody);
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'image' => 'uploaded[image]|max_size[image,1024]|ext_in[image,png,jpg,jpeg]'
        ]);

        if (!$this->validate($validation->getRules())) {
            $data = [
                'errors' => $validation->getErrors()
            ];
            print_r(json_encode($data));
            return "validation error";
        }

        $file = $this->request->getFile('userfile');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);

            // $data = [
            //     'success' => 'File uploaded successfully!'
            // ];
        return "success";
        } else {
            // $data = [
            //     'error' => 'Error uploading file.'
            // ];
        return "error";
        }
        return "unknown";
        // return view('upload_form', $data);
    }
    
}
