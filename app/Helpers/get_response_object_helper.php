<?php

use CodeIgniter\CodeIgniter;

if (!function_exists('getResponseObject')) {
    function getResponseObject($title = "", $validation = null, $data = [], $error = null, $success = null, $extraData = [])
    { {
            return [
                "title" => $title,
                "validation" => $validation,
                "data" => $data,
                "error" => $error,
                "success" => $success,
                "extraData" => $extraData,
            ];
        }
    }
}
