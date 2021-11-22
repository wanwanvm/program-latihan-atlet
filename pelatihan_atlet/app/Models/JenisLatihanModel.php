<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLatihanModel extends Model
{
    protected $table = 'jenis_latihan';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_program',
        'nama',
        'bobot',
        'benchmarking',
        'nilai'
    ];
}