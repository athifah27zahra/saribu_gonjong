<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class RumahGadangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rumah_gadang';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'address', 'open', 'close', 'price', 'video_url', 'geom', 'contact_person', 'status', 'description', 'lat', 'lng'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function get_all() {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.geom,{$this->table}.video_url,{$this->table}.status ";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->get();
        return $query;
    }

    public function get_list_rg_api() {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.geom,{$this->table}.video_url";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            // ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_rg_by_id_api($id = null) {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.description,{$this->table}.video_url, {$this->table}.open, {$this->table}.close, {$this->table}.price, {$this->table}.status";
        // $columns = "{$this->table}.*";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng, {$geoJson}")
            ->from('village')
            ->where('rumah_gadang.id', $id)
            // ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_rg_by_name_api($name = null) { 
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.description,{$this->table}.video_url";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->like("{$this->table}.name", $name)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_rg_by_radius_api($data = null) {
        $radius = (int)$data['radius'] / 1000;
        $lat = $data['lat'];
        $long = $data['long'];
        $jarak = "(6371 * acos(cos(radians({$lat})) * cos(radians({$this->table}.lat)) * cos(radians({$this->table}.lng) - radians({$long})) + sin(radians({$lat}))* sin(radians({$this->table}.lat))))";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.contact_person,{$this->table}.description,{$this->table}.video_url";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng, {$jarak} as jarak")
            ->from('village')
            ->where($vilGeom)
            ->having(['jarak <=' => $radius])
            ->get();
        return $query;
    }

    public function get_rg_in_id_api($id = null) {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.open,{$this->table}.close,{$this->table}.price,{$this->table}.contact_person,{$this->table}.status,{$this->table}.recom,{$this->table}.description,{$this->table}.video_url";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->whereIn('rumah_gadang.id', $id)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_rg_by_status_api($status = null) {
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.address,{$this->table}.open,{$this->table}.close,{$this->table}.price,{$this->table}.contact_person,{$this->table}.status,{$this->table}.recom,{$this->table}.description,{$this->table}.video_url";
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("{$columns}, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->where("{$this->table}.status", $status)
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_recommendation_api() {
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("rumah_gadang.id, rumah_gadang.name, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->where('recom', '1')
            ->where($vilGeom)
            ->get();
        return $query;
    }

    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 1);
        $id = sprintf('R%02d', $count + 1);
        return $id;
    }

    public function add_rg_api($rumah_gadang = null, $geojson = null) {
        $rumah_gadang['created_at'] = Time::now();
        $rumah_gadang['updated_at'] = Time::now();
        $insert = $this->db->table($this->table)
            ->insert($rumah_gadang);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $rumah_gadang['id'])
            ->update();
        return $insert && $update;
    }

    public function update_rg_api($id = null, $rumah_gadang = null, $geojson = null) {
        $rumah_gadang['updated_at'] = Time::now();
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($rumah_gadang);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $id)
            ->update();
        return $query && $update;
    }

    public function update_recom_api($data = null) {
        $query = false;
        $rumah_gadang['recom'] = $data['recom'];
        $rumah_gadang['updated_at'] = Time::now();
        $query = $this->db->table($this->table)
            ->where('id', $data['id'])
            ->update($rumah_gadang);
        return $query;
    }

    public function get_list_recommendation_api() {
        $vilGeom = "village.id = '1' AND ST_Contains(village.geom, {$this->table}.geom)";
        $query = $this->db->table($this->table)
            ->select("rumah_gadang.id, rumah_gadang.name, recom, recommendation.name as recommendation, rumah_gadang.lat, rumah_gadang.lng")
            ->from('village')
            ->where($vilGeom)
            ->join('recommendation', 'rumah_gadang.recom = recommendation.id')
            ->get();
        return $query;
    }
    
    public function get_recommendation_data_api() {
        $query = $this->db->table('recommendation')
            ->select("recommendation.id, recommendation.name,")
            ->get();
        return $query;
    }
}
