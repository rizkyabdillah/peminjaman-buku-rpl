<?php

namespace App\Controllers;

class Auth extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    public function index()
    {
        return view('admin/pages/layouts/login', ['valid' => $this->validation]);
    }
}
