<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Password extends BaseController
{
    public function set()
    {
        return view("Password/set");
    }

    public function update()
    {
        $rules = [
            "password" => [
                "label" => "Password",
                "rules" => "required|strong_password"
            ],
            "password_confirmation" => [
                "label" => "Password Confirmation",
                "rules" => "required|matches[password]"
            ]
        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->with("errors", $this->validator->getErrors());
        }

        echo "Valid";
    }
}
