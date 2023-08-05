<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view("Home/index");
    }

    private function sendTestEmail()
    {
        $email = \Config\Services::email();

        $email->setTo("recipient@example.com");

        $email->setSubject("Test Email");
        $email->setMessage("Hello from <i>CodeIgniter</i>");

        if ($email->send()) {

            echo "Email sent";
        } else {

            echo "Email not sent";
        }
    }
}
