<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramLatihanModel extends Model
{
    protected $table = 'program_latihan';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_pelatih',
        'id_atlet',
        'tanggal_latihan',
        'tinggi_badan',
        'berat_badan',
        'tes_lari',
        'vcr',
        'putaran',
        'kesimpulan'
    ];
}