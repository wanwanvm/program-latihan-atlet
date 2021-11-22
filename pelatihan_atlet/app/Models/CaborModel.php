<?php

namespace App\Models;

use CodeIgniter\Model;

class CaborModel extends Model
{
    protected $table = 'cabor';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama'];
}