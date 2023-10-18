<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class TourismPackageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tourism_package';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'price', 'capacity', 'contact_person', 'description', 'video_url','custom'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function new01()
    {
        $return = $this->db->table('package_day')->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        return (null == $return) ? 1 : $return['id'] + 1;
    }

    public function new02($p1, $p2)
    {
        $this->db->table($p1)->insert($p2);
    }

    public function new03($p1, $p2, $p3)
    {
        $this->db->table($p1)->update($p2, ['id' => $p3]);
    }

    public function new04($p1)
    {
        $this->db->table('detail_package')->delete(['package_day_tourism_package_id' => $p1]);
        $package_day = model('tourismPackageModel')->package_day($p1);
        foreach ($package_day as $pd) :
            $this->db->table('detail_package')->delete(['package_day_tourism_package_id' => $pd['tourism_package_id']]);
        endforeach;
        $this->db->table('package_day')->delete(['tourism_package_id' => $p1]);
        $this->db->table('detail_service_package')->delete(['tourism_package_id' => $p1]);
    }

    function clearDataPackage($packageid) {
        $this->db->table('detail_package')->delete(['package_day_tourism_package_id' => $packageid]);
        $package_day = $this->package_day($packageid);
        foreach ($package_day as $pd) :
            $this->db->table('detail_package')->delete(['package_day_tourism_package_id' => $pd['tourism_package_id']]);
        endforeach;
        $this->db->table('package_day')->delete(['tourism_package_id' => $packageid]);
        $this->db->table('detail_service_package')->delete(['tourism_package_id' => $packageid]);
    }

    public function add_tp_api($tourism_package = null)
    {
        $tourism_package['created_at'] = Time::now();
        $tourism_package['updated_at'] = Time::now();
        $insert = $this->db->table($this->table)
            ->insert($tourism_package);
        return $insert;
    }

    public function update_tp_api($id = null, $tourism_package = null, $geojson = null)
    {
        $tourism_package['updated_at'] = Time::now();
        $query = $this->db->table($this->table)
            ->where('id', $id)
            ->update($tourism_package);
        $update = $this->db->table($this->table)
            ->set('geom', "ST_GeomFromGeoJSON('{$geojson}')", false)
            ->where('id', $id)
            ->update();
        return $query && $update;
    }

    public function get_list_tp_api()
    {
        $query = $this->db->table($this->table)
            // ->select('id, name, price, capacity, contact_person, description, video_url, lat, lng')
            ->select('id, name, price, capacity, contact_person, description, video_url,custom')
            ->get();
        return $query;
    }

    function get_List_tp_api_noncus() {
        $query = $this->db->table($this->table)
            // ->select('id, name, price, capacity, contact_person, description, video_url, lat, lng')
            ->select('id, name, price, capacity, contact_person, description, video_url,custom')
            ->where('custom','0')
            ->get();
        return $query;
    }

    function get_list_tp_by_cus($custom) {
        $query = $this->db->table($this->table)
            // ->select('id, name, price, capacity, contact_person, description, video_url, lat, lng')
            ->select('id, name, price, capacity, contact_person, description, video_url,custom')
            ->where('custom',$custom)
            ->get();
        return $query;
    }

    public function get_tp_by_id_api($id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 1);
        $id = sprintf('T%02d', $count + 1);
        return $id;
    }

    public function detail_package($id = null)
    {
        return $this->db->table('detail_package')->select('*')->where('package_day_tourism_package_id', $id)->get()->getResultArray();
    }

    public function detail_package_day($day = null, $tourism_package_id = null)
    {
        return $this->db->table('detail_package')->select('*')->where(['package_day_day'=>$day, 'package_day_tourism_package_id'=>$tourism_package_id])->orderBy('activity', 'ASC')->get()->getResultArray();
        
    }

    public function package_day($day = null)
    {
        return $this->db->table('package_day')->select('*')->where('tourism_package_id', $day)->get()->getResultArray();
    }

    public function rumah_gadang($id = null)
    {
        return $this->db->table('rumah_gadang')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function umkm_place($id = null)
    {
        return $this->db->table('umkm_place')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function souvenir_place($id = null)
    {
        return $this->db->table('souvenir_place')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function worship_place($id = null)
    {
        return $this->db->table('worship_place')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function history_place($id = null)
    {
        return $this->db->table('history_place')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function tourism_object($id = null)
    {
        return $this->db->table('tourism_object')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function tourism_activity($id = null)
    {
        return $this->db->table('tourism_activity')->select('*')->where('id', $id)->get()->getRowArray();
    }

    public function study($id = null)
    {
        return $this->db->table('study_place')->select('*')->where('id', $id)->get()->getRowArray();
    }

    function updateSP($packageid,$price) {
        $tourism_package['updated_at'] = Time::now();
        $tourism_package['price'] = $price;
        $query = $this->db->table($this->table)
            ->where('id', $packageid)
            ->update($tourism_package);
        return $query;
    }
}
