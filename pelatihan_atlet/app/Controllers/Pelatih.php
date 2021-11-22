<?php

namespace App\Controllers;

use App\Models\PelatihModel;
use App\Models\CaborModel;

class Pelatih extends BaseController
{
	public function index()
	{
        $db = \Config\Database::connect();

        $pelatih = $db->query('SELECT a.id as id_cabor, a.nama_cabor, b.id as id_user, b.id_role, b.nama, b.email, b.foto FROM cabor a, users b WHERE a.id = b.id_cabor AND b.id_role = 2');
        $cabor = $db->query('SELECT * FROM cabor');

        $data = [
            'title' => 'MANAGE PELATIH',
            'pelatih' => $pelatih,
            'cabor' => $cabor
        ];

        return view('pages/dashboard/pelatih', $data);
	}

    public function create()
	{
        if (!$this->validate([])){
            $cabors = new CaborModel();

            $cabor = $cabors->findAll();
    
            $data = [
                'title' => 'TAMBAH MANAGE PELATIH',
                'cabor' => $cabor,
                'validation' => $this->validator
            ];
    
            return view('pages/dashboard/create-pelatih', $data);
        }
	}

    public function add()
    {
        $validated = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
        ]);
  
        if ($validated == FALSE) {
             
            // Kembali ke function index supaya membawa data uploads dan validasi
            return $this->create();
 
        } else {
            $pelatihs = new PelatihModel();

            // GET FIELD VALUE
            $select_cabor = $this->request->getVar('select_cabor');
            $nama_pelatih = $this->request->getVar('nama_pelatih');
            $email_pelatih = $this->request->getVar('email_pelatih');
            $tempat_lahir = $this->request->getVar('tempat_lahir');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $select_jk = $this->request->getVar('select_jk');
            $alamat_pelatih = $this->request->getVar('alamat_pelatih');
            $password_pelatih = md5($this->request->getVar('password_pelatih'));

            $foto = $this->request->getFile('file_upload');
            $foto->move(ROOTPATH . 'public/assets/img/pelatih');

            $pelatihs->save([
                'id_role' => 2,
                'id_cabor' => $select_cabor,
                'nama' => $nama_pelatih,
                'email' => $email_pelatih,
                'password' => $password_pelatih,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat_pelatih,
                'jenis_kelamin' => $select_jk,
                'foto' => $foto->getName()
            ]);

            session()->setFlashdata('success', 'Submit berhasil');
            return redirect()->to('/manage-pelatih');
        }
    }

    public function detail($id)
    {
        $pelatihs = new PelatihModel();
        $cabors = new CaborModel();
        $db = \Config\Database::connect();

        $atlet_terkait = $db->query("SELECT a.id, a.nama, a.foto, a.email FROM users a, program_latihan b WHERE a.id = b.id_atlet AND b.id_pelatih = $id GROUP BY a.nama");
        $pelatih = $pelatihs->where('id', $id)->first();
        $cabor = $cabors->findAll();

        $data = [
            'title' => 'TAMBAH MANAGE PELATIH',
            'pelatih' => $pelatih,
            'cabor' => $cabor,
            'atlet_terkait' => $atlet_terkait
        ];

        return view('pages/dashboard/detail-pelatih', $data);
    }

    public function edit($id)
    {
        if (!$this->validate([])){
            $pelatihs = new PelatihModel();
            $cabors = new CaborModel();
    
            $pelatih = $pelatihs->where('id', $id)->first();
            $cabor = $cabors->findAll();
    
            $data = [
                'title' => 'EDIT MANAGE PELATIH',
                'pelatih' => $pelatih,
                'cabor' => $cabor,
                'validation' => $this->validator
            ];
    
            return view('pages/dashboard/edit-pelatih', $data);
        }
    }

    public function process_edit($id)
    {
        $pelatihs = new PelatihModel();

        // GET FIELD VALUE
        $select_cabor = $this->request->getVar('select_cabor');
        $nama_pelatih = $this->request->getVar('nama_pelatih');
        $email_pelatih = $this->request->getVar('email_pelatih');
        $tempat_lahir = $this->request->getVar('tempat_lahir');
        $tanggal_lahir = $this->request->getVar('tanggal_lahir');
        $select_jk = $this->request->getVar('select_jk');
        $alamat_pelatih = $this->request->getVar('alamat_pelatih');
        $password_pelatih = $this->request->getVar('password_pelatih');

        $foto = $this->request->getFile('file_upload');

        if(empty($password_pelatih)){
            if(empty($foto->getName())){
                $pelatihs->update($id, [
                    'id_cabor' => $select_cabor,
                    'nama' => $nama_pelatih,
                    'email' => $email_pelatih,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_pelatih,
                    'jenis_kelamin' => $select_jk
                ]);
            } else {
                $pelatihs->update($id, [
                    'id_cabor' => $select_cabor,
                    'nama' => $nama_pelatih,
                    'email' => $email_pelatih,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_pelatih,
                    'jenis_kelamin' => $select_jk,
                    'foto' => $foto->getName()
                ]);
            }
        } else {
            if(empty($foto->getName())){
                $pelatihs->update($id, [
                    'id_cabor' => $select_cabor,
                    'nama' => $nama_pelatih,
                    'email' => $email_pelatih,
                    'password' => md5($password_pelatih),
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_pelatih,
                    'jenis_kelamin' => $select_jk
                ]);
            } else {
                $pelatihs->update($id, [
                    'id_cabor' => $select_cabor,
                    'nama' => $nama_pelatih,
                    'email' => $email_pelatih,
                    'password' => md5($password_pelatih),
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_pelatih,
                    'jenis_kelamin' => $select_jk,
                    'foto' => $foto->getName()
                ]);
            }
        }

        session()->setFlashdata('success', 'Data diubah');
        return redirect()->to('/manage-pelatih');
    }

    public function delete($id)
    {
        $pelatihs = new PelatihModel();

        $pelatihs->delete($id);

        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/manage-pelatih');
    }
}
