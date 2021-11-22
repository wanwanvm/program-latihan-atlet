<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\UsersModel;

class Login extends BaseController
{
	public function index()
	{
        if(session()->get('logged_in')){
            return redirect()->back();
        } else {
            return view('pages\auth\login');
        }
	}

    public function submit()
	{
        $users = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'email' => $email,
            'password' => md5($password)
        ])->first();
        if ($dataUser) {
            session()->set([
                'id' => $dataUser['id'],
                'id_cabor' => $dataUser['id_cabor'],
                'email' => $dataUser['email'],
                'nama' => $dataUser['nama'],
                'role' => $dataUser['id_role'],
                'logged_in' => TRUE
            ]);
            session()->setFlashdata('success', 'Anda berhasil login');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('error', 'Email & Password Salah');
            return redirect()->back();
        }
	}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
