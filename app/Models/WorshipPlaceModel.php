<?php

namespace App\Models;

use CodeIgniter\Model;

class WorshipPlaceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'worship_place';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'address', 'building_size', 'capacity', 'geom', 'lat', 'lng', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function get_all() {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.building_size,{$this->table}.capacity";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, worship_place.lat, worship_place.lng")
            ->from('village')
            ->get();
        return $query;
    }

    public function get_wp_by_radius_api($data = null) {
        $radius = (int)$data['radius'] / 1000;
        $lat = $data['lat'];
        $long = $data['long'];
        $jarak = "(6371 * acos(cos(radians({$lat})) * cos(radians({$this->table}.lat)) * cos(radians({$this->table}.lng) - radians({$long})) + sin(radians({$lat}))* sin(radians({$this->table}.lat))))";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.building_size,{$this->table}.capacity";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, worship_place.lat, worship_place.lng, {$jarak} as jarak")
            ->from('village')
            ->where($vilGeom)
            ->having(['jarak <=' => $radius])
            ->get();
        return $query;
    }

    public function get_wp_by_id_api($id = null) {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.building_size,{$this->table}.capacity,{$this->table}.description";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$columns}, worship_place.lat, worship_place.lng, {$geoJson}")
            ->from('village')
            ->where('worship_place.id', $id)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_list_wp_api()
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->get();
        return $query;
    }

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 2);
        $id = sprintf('WP%02d', $count + 1);
        return $id;
    }

    public function add_wp_api($worship_place = null, $geojson = null) {
        $insert = $this->db->table($this->table)
            ->insert($worship_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $worship_place['id'])
            ->update();
        return $insert && $update;
    }

    public function update_wp_api($id = null, $worship_place = null, $geojson = null) {
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($worship_place);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $id)
            ->update();
        return $query && $update;
    }
}   
