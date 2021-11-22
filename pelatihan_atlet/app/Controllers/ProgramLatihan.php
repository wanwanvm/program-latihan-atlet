<?php

namespace App\Controllers;
use App\Models\ProgramLatihanModel;
use App\Models\JenisLatihanModel;
use App\Models\AtletModel;
use App\Models\CaborModel;

class ProgramLatihan extends BaseController
{
	public function index()
	{        
        $cabors = new CaborModel();
        $db = \Config\Database::connect();
        $role = session()->get('role');
        $id_cabor = session()->get('id_cabor');
        $id = session()->get('id');

        if($role == 1){
            $program = $db->query("SELECT a.nama, b.id, b.id_atlet, b.tanggal_latihan, b.kesimpulan FROM users a, program_latihan b WHERE a.id = b.id_atlet");
            
            $data = [
                'title' => 'PROGRAM LATIHAN',
                'program' => $program,
            ];
        } else if($role == 2) {
            $program = $db->query("SELECT a.nama, b.id, b.id_atlet, b.tanggal_latihan, b.kesimpulan FROM users a, program_latihan b WHERE a.id = b.id_atlet AND a.id_cabor = $id_cabor");
            $cabor = $cabors->where('id', $id_cabor)->first();

            $data = [
                'title' => 'PROGRAM LATIHAN',
                'program' => $program,
                'cabor' => $cabor,
            ];
        } else {
            $program = $db->query("SELECT a.nama, b.id, b.id_atlet, b.tanggal_latihan, b.kesimpulan FROM users a, program_latihan b WHERE a.id = b.id_atlet AND b.id_atlet = $id");
            $cabor = $cabors->where('id', $id_cabor)->first();

            $data = [
                'title' => 'PROGRAM LATIHAN',
                'program' => $program,
                'cabor' => $cabor,
            ];
        }

        return view('pages/dashboard/program-latihan', $data);
	}

    public function create()
	{
        if (!$this->validate([])){
            $db = \Config\Database::connect();
            $id_pelatih = session()->get('id');
            $id_cabor = session()->get('id_cabor');

            $atlet = $db->query("SELECT a.id as id_atlet, a.nama as nama_atlet, b.nama_cabor FROM users a, cabor b WHERE b.id = a.id_cabor AND a.id_cabor = $id_cabor AND a.id_role = 3");
            $cari_program = $db->query("SELECT a.nama as nama_atlet, b.id, b.tanggal_latihan FROM users a, program_latihan b WHERE a.id = b.id_atlet AND b.id_pelatih = $id_pelatih");
            
            $data = [
                'title' => 'TAMBAH MANAGE PELATIH',
                'atlet' => $atlet,
                'cari_program' => $cari_program,
                'validation' => $this->validator
            ];
    
            return view('pages/dashboard/create-program-latihan', $data);
        }
	}

    public function add_tanggal()
    {
        $programs = new ProgramLatihanModel();

        // GET FIELD VALUE
        $id_pelatih = session()->get('id');
        $id_atlet = $this->request->getVar('id_atlet');
        $tangggal_latihan = $this->request->getVar('tanggal_latihan');

        // INSERT PROGRAM
        $programs->save([
            'id_pelatih' => $id_pelatih,
            'id_atlet' => $id_atlet,
            'tanggal_latihan' => $tangggal_latihan,
        ]);

        session()->setFlashdata('success', 'Tanggal program ditambahkan');
        return redirect()->to('/program-latihan/create');
    }

    public function add()
    {
        $jeniss = new JenisLatihanModel();
        $programs = new ProgramLatihanModel();

        // GET FIELD VALUE
        $id_program = $this->request->getVar('cari_program');
        $tinggi_badan = $this->request->getVar('tinggi_badan');
        $berat_badan = $this->request->getVar('berat_badan');
        $tes_lari = $this->request->getVar('tes_lari');
        $vcr = $this->request->getVar('vcr');
        $putaran = $this->request->getVar('putaran');
        $program_latihan_arr = $this->request->getVar('program_latihan[]');
        $bobot_arr = $this->request->getVar('bobot[]');
        $benchmarking_arr = $this->request->getVar('benchmarking[]');
        $score_latihan_arr = $this->request->getVar('score_latihan[]');
        $kesimpulan = $this->request->getVar('kesimpulan');
        
        // UPDATE PROGRAM BY ID 
        $programs->update($id_program, [
            'tinggi_badan' => $tinggi_badan,
            'berat_badan' => $berat_badan,
            'tes_lari' => $tes_lari,
            'vcr' => $vcr,
            'putaran' => $putaran,
            'kesimpulan' => $kesimpulan,
        ]);

        // BULK INSERT JENIS LATIHAN
        for($i = 0; $i < count($program_latihan_arr); $i++){
            $jeniss->save([
                'id_program' => $id_program,
                'nama' => $program_latihan_arr[$i],
                'bobot' => $bobot_arr[$i],
                'benchmarking' => $benchmarking_arr[$i],
                'nilai' => $score_latihan_arr[$i],
            ]);
        }

        session()->setFlashdata('success', 'Submit program berhasil');
        return redirect()->to('/program-latihan/create');
    }

    public function detail($id)
    {
        $db = \Config\Database::connect();
        $jeniss = new JenisLatihanModel();

        $program = $db->query("SELECT a.nama, a.email, a.foto, b.tinggi_badan, b.berat_badan, b.tes_lari, b.vcr, b.putaran, c.nama_kelas, d.nilai, e.nama_cabor FROM users a, program_latihan b, kelas c, jenis_latihan d, cabor e WHERE b.id = $id AND a.id_kelas = c.id AND a.id = b.id_atlet AND b.id = d.id_program AND a.id_cabor = e.id")->getRowArray(0);
        $jenis = $jeniss->where('id_program', $id)->findAll();

        // rumus rumus
        $tinggi_badan = $program['tinggi_badan'] / 100;
        $imt = number_format((float)$program['berat_badan'] / ($tinggi_badan * $tinggi_badan), 2, '.', '');
        // kondisi imt hasil
        if($imt > 30){
            $hasil_imt = 'OBESITAS';
        } 
        if($imt >= 25){
            $hasil_imt = 'GEMUK';
        }
        if($imt >= 20){
            $hasil_imt = 'NORMAL';
        }
        if($imt < 20){
            $hasil_imt = 'KURUS';
        }
        // kondisi kategori
        $kategori = array();        ;
        for($i = 0; $i < count($jenis); $i++){
            if($jenis[$i]['nilai'] >= 4.32){
                $kategori[] = 'E';
            } 
            if($jenis[$i]['nilai'] >= 4){
                $kategori[] = 'D';
            }
            if($jenis[$i]['nilai'] >= 3.89){
                $kategori[] = 'C';
            }
            if($jenis[$i]['nilai'] >= 3.49){
                $kategori[] = 'B';
            }
            if($jenis[$i]['nilai'] < 3.49){
                $kategori[] = 'A';
            }
        }
        // kondisi grade
        $grade = array();        ;
        for($i = 0; $i < count($jenis); $i++){
            if($kategori[$i] == 'E'){
                $grade[] = '1';
            } 
            if($kategori[$i] >= 'D'){
                $grade[] = '2';
            }
            if($kategori[$i] >= 'C'){
                $grade[] = '3';
            }
            if($kategori[$i] >= 'B'){
                $grade[] = '4';
            }
            if($kategori[$i] < 'A'){
                $grade[] = '5';
            }
        }
        // kondisi bobot 1
        $bobot1 = 0;
        $bobot2 = 0;
        for($i = 0; $i < count($jenis); $i++){
            $bobot1 += $jenis[$i]['bobot'];
            $bobot2 += (($jenis[$i]['bobot'] / 100) / 5 * $grade[$i]) * 100;
        }
        // kondisi status fisik
        if($bobot2 >= 90){
            $status_fisik = 'A';
            $keterangan_status = 'SANGAT BAIK';
        }
        if($bobot2 >= 80){
            $status_fisik = 'B';
            $keterangan_status = 'BAIK';
        }
        if($bobot2 >= 60){
            $status_fisik = 'C';
            $keterangan_status = 'CUKUP BAIK';
        }
        if($bobot2 < 60){
            $status_fisik = 'D';
            $keterangan_status = 'KURANG';
        }

        $data = [
            'title' => 'DETAIL DATA ATLET',
            'program' => $program,
            'jenis' => $jenis,
            'tinggi_badan' => $tinggi_badan,
            'imt' => $imt,
            'hasil_imt' => $hasil_imt,
            'kategori' => $kategori,
            'grade' => $grade,
            'bobot1' => $bobot1,
            'bobot2' => $bobot2,
            'status_fisik' => $status_fisik,
            'keterangan_status' => $keterangan_status
        ];

        return view('pages/dashboard/detail-program-latihan', $data);
    }

    public function grafik($id)
    {
        $db = \Config\Database::connect();

        $grafik_day = $db->query("SELECT SUM(a.bobot) as bobot, b.tanggal_latihan, c.nama FROM jenis_latihan a, program_latihan b, users c WHERE a.id_program = b.id AND b.id_atlet = c.id AND id_atlet = $id GROUP BY tanggal_latihan")->getResult('array');
    
        $data = [
            'grafik_day' => $grafik_day,
        ];

        return view('pages/dashboard/grafik-program-latihan', $data);
    }

    public function delete($id)
    {
        $programs = new ProgramLatihanModel();

        $programs->delete($id);

        session()->setFlashdata('success', 'Data dihapus');
        return redirect()->to('/program-latihan');
    }
}
