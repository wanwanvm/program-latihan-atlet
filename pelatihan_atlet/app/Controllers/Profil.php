<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Models\CaborModel;

class Profil extends BaseController
{
	public function index()
	{
        $users = new ProfileModel();
        $cabors = new CaborModel();
        $id = session()->get('id');

        $user = $users->where('id', $id)->first();
        $cabor = $cabors->findAll();
        
        $data = [
            'title' => 'EDIT PROFILE',
            'user' => $user,
            'cabor' => $cabor,
            'validation' => $this->validator
        ];
        return view('pages/dashboard/profile', $data);
	}

    public function process_edit($id)
    {
        $users = new ProfileModel();

        // GET FIELD VALUE
        $password = $this->request->getVar('password');

        $users->update($id, [
            'password' => md5($password)
        ]);

        session()->setFlashdata('success', 'Password diubah');
        return redirect()->to('/profil');
    }
}
