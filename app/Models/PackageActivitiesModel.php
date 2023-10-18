<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageActivitiesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tourism_activity';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'lat', 'lng', 'geom'];

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

    public function get_all()
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->get();
        return $query;
    }

    public function get_id($id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 1);
        $id = sprintf('A%02d', $count + 1);
        return $id;
    }

    public function get_pa_by_id_api($id = null) {
        $columns = "{$this->table}.id,{$this->table}.name";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$columns}, tourism_activity.lat, tourism_activity.lng, {$geoJson}")
            ->from('village')
            ->where("$this->table.id", $id)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function add_pa_api($history_place = null, $geojson = null) {
        $insert = $this->db->table($this->table)
            ->insert($history_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $history_place['id'])
            ->update();
        return $insert && $update;
    }

    public function update_pa_api($id = null, $history_place = null, $geojson = null) {
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($history_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $id)
            ->update();
        return $query && $update;
    }
}
