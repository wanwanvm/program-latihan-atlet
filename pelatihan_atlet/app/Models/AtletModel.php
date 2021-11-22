<?php

namespace App\Models;

use CodeIgniter\Model;

class AtletModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_role',
        'id_cabor',
        'id_kelas',
        'nama',
        'email',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'foto'
    ];
}