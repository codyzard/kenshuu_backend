<?php

class AuthController extends BaseController
{

    public function login()
    {
        return $this->view('auth.login');
    }

    public function register()
    {
        return $this->view('auth.register');
    }
}
