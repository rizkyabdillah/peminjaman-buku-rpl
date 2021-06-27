<?php

namespace App\Controllers;

class Auth extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    public function getBcrypt($prefix)
    {
        echo (password_hash($prefix, PASSWORD_BCRYPT));
    }

    public function index()
    {
        return view('admin/pages/layouts/login', ['valid' => $this->validation]);
    }

    public function auth()
    {
        if (!$this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ]
        ])) {
            // dd($this->validation);
            return redirect()->back()->withInput();
        } else {
            $cek_user = $this->model->getRowDataArray('USER', ['username' => $this->request->getVar('username')]);
            if ($cek_user) {
                if (password_verify($this->request->getVar('password'), $cek_user['password'])) {
                    session()->set([
                        'is_login' => true,
                        'id_user' => $cek_user['id_user'],
                        'level' => $cek_user['level']
                    ]);
                    return redirect()->to(route_to('view_dashboard'));
                }
            }
            session()->setFlashData('pesan', 'Username atau password anda salah!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('view_login'));
    }
}
