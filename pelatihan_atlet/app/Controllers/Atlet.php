<?php

namespace App\Controllers;

use App\Models\AtletModel;
use App\Models\CaborModel;
use App\Models\KelasModel;
use App\Models\ProgramLatihanModel;

class Atlet extends BaseController
{
	public function index()
	{
        $db = \Config\Database::connect();

        $atlet = $db->query('SELECT a.id as id_cabor, a.nama_cabor, b.id as id_user, b.id_role, b.nama, b.email, b.foto FROM cabor a, users b WHERE a.id = b.id_cabor AND b.id_role = 3');
        $cabor = $db->query('SELECT * FROM cabor');

        $data = [
            'title' => 'MANAGE ATLET',
            'atlet' => $atlet,
            'cabor' => $cabor
        ];

        return view('pages/dashboard/atlet', $data);
	}

    public function create()
	{
        if (!$this->validate([])){
            $cabors = new CaborModel();
            $kelass = new KelasModel();
            
            $cabor = $cabors->findAll();
            $kelas = $kelass->findAll();
    
            $data = [
                'title' => 'TAMBAH MANAGE ATLET',
                'cabor' => $cabor,
                'kelas' => $kelas,
                'validation' => $this->validator
            ];
    
            return view('pages/dashboard/create-atlet', $data);
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
            $atlets = new AtletModel();

            // GET FIELD VALUE
            $select_cabor = $this->request->getVar('select_cabor');
            $nama_atlet = $this->request->getVar('nama_atlet');
            $email_atlet = $this->request->getVar('email_atlet');
            $tempat_lahir = $this->request->getVar('tempat_lahir');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $select_jk = $this->request->getVar('select_jk');
            $select_kelas = $this->request->getVar('select_kelas');
            $alamat_atlet = $this->request->getVar('alamat_atlet');
            $password_atlet = md5($this->request->getVar('password_atlet'));

            $foto = $this->request->getFile('file_upload');
            $foto->move(ROOTPATH . 'public/assets/img/atlet');

            $atlets->save([
                'id_role' => 3,
                'id_cabor' => $select_cabor,
                'id_kelas' => $select_kelas,
                'nama' => $nama_atlet,
                'email' => $email_atlet,
                'password' => $password_atlet,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat_atlet,
                'jenis_kelamin' => $select_jk,
                'foto' => $foto->getName()
            ]);

            session()->setFlashdata('success', 'Submit berhasil');
            return redirect()->to('/manage-atlet');
        }
    }

    public function detail($id)
    {
        $db = \Config\Database::connect();
        $atlets = new AtletModel();
        $cabors = new CaborModel();
        $kelass = new KelasModel();
        $programs = new ProgramLatihanModel();

        $atlet = $atlets->where('id', $id)->first();
        $cabor = $cabors->findAll();
        $kelas = $kelass->findAll();
        $fisik = $programs->where('id_atlet', $id)->first();
        $latihan = $db->query("SELECT c.nama as nama_pelatih, a.nama as nama_latihan, a.nilai, b.tanggal_latihan, b.kesimpulan FROM jenis_latihan a, program_latihan b, users c WHERE a.id_program = b.id AND c.id = b.id_pelatih AND b.id_atlet = $id");

        $data = [
            'title' => 'TAMBAH MANAGE ATLET',
            'atlet' => $atlet,
            'cabor' => $cabor,
            'kelas' => $kelas,
            'fisik' => $fisik,
            'latihan' => $latihan
        ];

        return view('pages/dashboard/detail-atlet', $data);
    }

    public function edit($id)
    {
        if (!$this->validate([])){
            $atlets = new AtletModel();
            $cabors = new CaborModel();
            $kelass = new KelasModel();
            
            
            $atlet = $atlets->where('id', $id)->first();
            $cabor = $cabors->findAll();
            $kelas = $kelass->findAll();
    
            $data = [
                'title' => 'EDIT MANAGE ATLET',
                'atlet' => $atlet,
                'cabor' => $cabor,
                'kelas' => $kelas,
                'validation' => $this->validator
            ];
    
            return view('pages/dashboard/edit-atlet', $data);
        }
    }

    public function process_edit($id)
    {
        $atlets = new AtletModel();

        // GET FIELD VALUE
        $select_cabor = $this->request->getVar('select_cabor');
        $nama_atlet = $this->request->getVar('nama_atlet');
        $email_atlet = $this->request->getVar('email_atlet');
        $tempat_lahir = $this->request->getVar('tempat_lahir');
        $tanggal_lahir = $this->request->getVar('tanggal_lahir');
        $select_jk = $this->request->getVar('select_jk');
        $select_kelas = $this->request->getVar('select_kelas');
        $alamat_atlet = $this->request->getVar('alamat_atlet');
        $password_atlet = $this->request->getVar('password_atlet');

        $foto = $this->request->getFile('file_upload');

        if(empty($password_atlet)){
            if(empty($foto->getName())){
                $atlets->update($id, [
                    'id_cabor' => $select_cabor,
                    'id_kelas' => $select_kelas,
                    'nama' => $nama_atlet,
                    'email' => $email_atlet,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_atlet,
                    'jenis_kelamin' => $select_jk
                ]);
            } else {
                $atlets->update($id, [
                    'id_cabor' => $select_cabor,
                    'id_kelas' => $select_kelas,
                    'nama' => $nama_atlet,
                    'email' => $email_atlet,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_atlet,
                    'jenis_kelamin' => $select_jk,
                    'foto' => $foto->getName()
                ]);
            }
        } else {
            if(empty($foto->getName())){
                $atlets->update($id, [
                    'id_cabor' => $select_cabor,
                    'id_kelas' => $select_kelas,
                    'nama' => $nama_atlet,
                    'email' => $email_atlet,
                    'password' => md5($password_atlet),
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_atlet,
                    'jenis_kelamin' => $select_jk
                ]);
            } else {
                $atlets->update($id, [
                    'id_cabor' => $select_cabor,
                    'id_kelas' => $select_kelas,
                    'nama' => $nama_atlet,
                    'email' => $email_atlet,
                    'password' => md5($password_atlet),
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat_atlet,
                    'jenis_kelamin' => $select_jk,
                    'foto' => $foto->getName()
                ]);
            }
        }

        session()->setFlashdata('success', 'Data diubah');
        return redirect()->to('/manage-atlet');
    }

    public function delete($id)
    {
        $atlets = new AtletModel();

        $atlets->delete($id);

        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/manage-atlet');
    }
}
