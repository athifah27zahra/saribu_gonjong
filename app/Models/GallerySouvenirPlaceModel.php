<?php

namespace App\Models;

use CodeIgniter\Model;

class GallerySouvenirPlaceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gallery_souvenir_place';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'souvenir_place_id', 'url'];

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

    public function get_gallery_api($souvenir_place_id = null) {
        $query = $this->db->table($this->table)
            ->select('url')
            ->where('souvenir_place_id', $souvenir_place_id)
            ->get();
        return $query;
    }

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (null == $lastId) ? 1 : $lastId['id'] + 1;
        $id = sprintf('%03d', $count + 1);
        return $id;
    }

    public function add_gallery_api($id = null, $data = null) {
        $query = false;
        foreach ($data as $gallery) {
            $new_id = $this->get_new_id_api();
            $content = [
                'id' => $new_id,
                'souvenir_place_id' => $id,
                'url' => $gallery,
            ];
            $query = $this->db->table($this->table)->insert($content);
        }
        return $query;
    }

    public function update_gallery_api($id = null, $data = null) {
        $queryDel = $this->delete_gallery_api($id);
    
        foreach ($data as $key => $value) {
            if(empty($value)) {
                unset($data[$key]);
            }
        }
        $queryIns = $this->add_gallery_api($id, $data);
        return $queryDel && $queryIns;
    }

    public function delete_gallery_api($id = null) {
        return $this->db->table($this->table)->delete(['souvenir_place_id' => $id]);
    }
}
