<?php

namespace App\Models;

use CodeIgniter\Model;

class UmkmPlaceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'umkm_place';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'address', 'contact_person', 'capacity', 'open', 'close', 'geom', 'lat', 'lng', 'description'];

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

    public function get_all() {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.capacity,{$this->table}.open,{$this->table}.close";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, umkm_place.lat, umkm_place.lng")
            ->from('village')
            ->get();
        return $query;
    }

    public function get_up_by_radius_api($data = null) {
        $radius = (int)$data['radius'] / 1000;
        $lat = $data['lat'];
        $long = $data['long'];
        $jarak = "(6371 * acos(cos(radians({$lat})) * cos(radians({$this->table}.lat)) * cos(radians({$this->table}.lng) - radians({$long})) + sin(radians({$lat}))* sin(radians({$this->table}.lat))))";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.capacity,{$this->table}.open,{$this->table}.close";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$columns}, umkm_place.lat, umkm_place.lng, {$jarak} as jarak,{$geoJson}")
            ->from('village')
            ->where($vilGeom)
            ->having(['jarak <=' => $radius])
            ->get();
        return $query;
    }

    public function get_up_by_id_api($id = null) {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.capacity,{$this->table}.open,{$this->table}.close,{$this->table}.description";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$columns}, umkm_place.lat, umkm_place.lng, {$geoJson}")
            ->from('village')
            ->where("$this->table.id", $id)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_list_up_api()
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->get();
        return $query;
    }

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 2);
        $id = sprintf('UP%02d', $count + 1);
        return $id;
    }

    public function add_up_api($umkm_place = null, $geojson = null) {
        $insert = $this->db->table($this->table)
            ->insert($umkm_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $umkm_place['id'])
            ->update();
        return $insert && $update;
    }

    public function update_up_api($id = null, $umkm_place = null, $geojson = null) {
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($umkm_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $id)
            ->update();
        return $query && $update;
    }
}
