<?php

namespace App\Controllers;
use App\Models\ProgramLatihanModel;
use App\Models\UsersModel;
use App\Models\CaborModel;

class Home extends BaseController
{
	public function index()
	{
        if(is_null(session()->get('logged_in'))){
            return redirect()->to('/auth/login');
        } else {
			$db = \Config\Database::connect();
			$programs = new ProgramLatihanModel();
			$users = new UsersModel();
			$cabor = new CaborModel();
			$id = session()->get('id');
			$id_cabor = session()->get('id_cabor');

			
			$count_program_pelatih = $programs->where('id_pelatih', $id)->countAllResults();
			$count_atlet_pelatih = $users->where('id_cabor', $id_cabor)->where('id_role', 3)->countAllResults();
			$count_cabor_asdep = $cabor->countAllResults();
			$count_pelatih_asdep = $users->where('id_role', 2)->countAllResults();
			$count_atlet_asdep = $users->where('id_role', 3)->countAllResults();
			$grafik_day = $db->query("SELECT SUM(a.bobot) as bobot, b.tanggal_latihan FROM jenis_latihan a, program_latihan b WHERE a.id_program = b.id AND id_atlet = $id GROUP BY tanggal_latihan")->getResult('array');

			$data = [
				'count_program_pelatih' => $count_program_pelatih,
				'count_atlet_pelatih' => $count_atlet_pelatih,
				'count_cabor_asdep' => $count_cabor_asdep,
				'count_pelatih_asdep' => $count_pelatih_asdep,
				'count_atlet_asdep' => $count_atlet_asdep,
				'grafik_day' => $grafik_day,
			];

			return view('pages/dashboard/dashboard', $data);
		}
	}
}
