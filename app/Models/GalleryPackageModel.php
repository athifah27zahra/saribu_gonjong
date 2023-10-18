<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryPackageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gallery_tourism_package';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'tourism_package_id', 'url'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 3);
        $id = sprintf('IMG%04d', $count + 1);
        return $id;
    }

    public function get_gallery_api($tourism_package_id = null) {
        $query = $this->db->table($this->table)
            ->select('url')
            ->where('tourism_package_id', $tourism_package_id)
            ->get();
        return $query;
    }
}
