<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_role',
        'id_cabor',
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