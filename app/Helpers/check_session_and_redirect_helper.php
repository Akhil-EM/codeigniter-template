<?php 
use CodeIgniter\CodeIgniter;
if (!function_exists('checkSessionAndRedirect')) {
    function checkSessionAndRedirect($to) {
      //check session and redirect user
        print_r(session()->has('user'));
        if (!session()->has('user')) {
            return redirect()->to($to);
        }
    }
}