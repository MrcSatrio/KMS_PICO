<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table      = 'berkas';
    protected $primaryKey = 'id_dokumen';

    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['id_dokumen','account_id','id_sorot','id_status','id_event', 'judul', 'berkas','pdf', 'id_kategori','id_sub_kategori','deskripsi','video', 'created_at', 'updated_at'];
}
