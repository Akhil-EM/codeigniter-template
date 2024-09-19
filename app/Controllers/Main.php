<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    private $NoteModel;
    private $UserModel;
    public function __construct()
    {
        helper(["get_response_object_helper", "check_session_and_redirect_helper","url"]); //file name
        $this->NoteModel = new \App\Models\Note();
        $this->UserModel = new \App\Models\User();
    }


    public function index()
    {

        if (!session()->has('user'))return redirect()->to("/login");
        $validation = null;
        $userId = session()->get("user")["id"];
        $notes = $this->NoteModel->where("deleted_at", null)->where("user_id", $userId)->orderBy("created_at", "DESC")->findAll();
        $profile = $this->UserModel->select(select: 'id,name,password')->find($userId);
        $data = [
            "notes" => $notes,
            "profile" => [
                "name" => $profile["name"] ? $profile["name"] : null,
                "password" => $profile["password"] ? $profile["password"] : null,
                "password_exists" => $profile["password"] ? true : false
            ]
        ];
        return  view("admin/partials/header_view", getResponseObject("Notes")) .
                view("admin/index_view", getResponseObject("notes", $validation, $data)) .
                view("admin/partials/footer_view", getResponseObject("notes", $validation, $data));
    }

    public function getNote($noteId)
    {

        if (!session()->has('user')) return redirect()->to("/login");
        $validation = null;
        $data = ["note" => $this->NoteModel->find($noteId)];
        return  view("admin/partials/header_view", getResponseObject("Notes")) .
        view("admin/note_view", getResponseObject("notes", $validation, $data)) .
        view("admin/partials/footer_view", getResponseObject("notes", $validation, $data));
    }

    public function addNote($noteId = null)
    {    
        if (!session()->has('user')) return redirect()->to("/login");
        $validation = null;
        $error = null;
        $success = null;
        $data = [
            "title" => null,
            "content" => null
        ];
        $extraData = [
            "noteId" => $noteId ?? null
        ];
        if ($noteId) {
            $dbNote = $this->NoteModel->find($noteId);
            $data = ["title" => $dbNote["title"], "content" => $dbNote["content"]];
        }


        if ($this->request->getMethod() == "POST") {
            echo("<h1>Form submitted</h1>");
            $data = $this->request->getPost();
            $validationRules = [
                "title" => "required|min_length[3]",
            ];
            $validationMessages = [
                "title" => [
                    "required" => "Title is required",
                    "min_length" => "Title must be at least 3 characters"
                ]
            ];
            $validation = $this->validate($validationRules, $validationMessages);

            if (!$this->validate($validationRules, $validationMessages)) {
                $validation = $this->validator;
            } else {
                //check email exists
                $noteTitleExists = null;
                $validation = $this->validator;
                if ($noteId) {
                    $noteTitleExists = $this->NoteModel->where("title", $this->request->getPost("title"))->where("id !=", $noteId)->first();
                }

                if (!$noteId && $noteTitleExists) {
                    $validation->setError("title", "Title already exists");
                } else {
                    if ($noteId) {
                        //updating
                        $this->NoteModel->update($noteId, $this->request->getPost());
                        $success = "Note updated successfully";
                    } else {
                        //creating
                        $body = [
                            "title" => $this->request->getPost("title"),
                            "content" => $this->request->getPost("content"),
                            "user_id" => session()->get('user')['id']
                        ];
                        //save in database 
                        $this->NoteModel->insert($body);
                        $data = [
                            "title" => null,
                            "content" => null,
                        ];
                        $success = "Note added successfully";
                    }
                }
            }
        }

        return  view("admin/partials/header_view", getResponseObject("Add Note")) .
        view("admin/add_note_view", getResponseObject("notes", $validation, $data, $error, $success, $extraData)) .
        view("admin/partials/footer_view", getResponseObject("notes", $validation, $data,$error, $success, $extraData));
    }

    public function deleteNote($noteId)
    {
        if (!session()->has('user')) return redirect()->to("/login");
        $error = null;
        $success = null;
        $noteDeleted = $this->NoteModel->delete($noteId);
        if ($noteDeleted) {
            $success = "Note deleted successfully";
        } else {
            $error = "Something went wrong";
        }

        return redirect()->to("/")->with("success", $success)->with("error", $error);
    }
}
