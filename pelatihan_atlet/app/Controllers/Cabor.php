<?php

namespace App\Controllers;

use App\Models\CaborModel;

class Cabor extends BaseController
{
	public function index()
	{
		$cabors = new CaborModel();
        $db = \Config\Database::connect();

        $cabor_count = $db->query('SELECT id_cabor,COUNT(id_cabor) as jumlah FROM users WHERE id_role = 3 GROUP BY id_cabor');
		$cabor = $cabors->findAll();
		$cabor_atlet = $db->query('SELECT a.nama_cabor FROM cabor a, users b WHERE a.id = b.id_cabor AND b.id_role = 3 GROUP BY a.nama_cabor ORDER BY a.id');

		$data = [
			'title' => 'CABANG OLAHRAGA',
			'cabor' => $cabor,
            'cabor_count' => $cabor_count,
            'cabor_atlet' => $cabor_atlet
		];

        return view('pages/dashboard/cabor', $data);
	}
    
    public function add()
	{   
		$cabors = new CaborModel();

        // GET FIELD VALUE
        $nama_cabor = $this->request->getVar('nama_cabor');

        $cabors->save([
            'nama' => $nama_cabor
        ]);

        session()->setFlashdata('success', 'Submit berhasil');
        return redirect()->to('/cabang-olahraga');
	}

    public function edit($id)
    {
        $cabors = new CaborModel();

        // GET FIELD VALUE
        $nama_cabor = $this->request->getVar('nama_cabor');

        $cabors->update($id, [
            "nama" => $nama_cabor
        ]);

        session()->setFlashdata('success', 'Data diubah');
        return redirect()->to('/cabang-olahraga');
    }

    public function delete($id)
    {
        $cabors = new CaborModel();

        $cabors->delete($id);

        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/cabang-olahraga');
    }
}
