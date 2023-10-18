<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class DetailFacilityPackageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_service_package';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'tourism_package_id', 'service_package_id'];

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

    public function get_facility_by_tp_api($tourism_package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('service_package.name')
            ->where('tourism_package_id', $tourism_package_id)
            ->join('service_package', 'detail_service_package.service_package_id = service_package.id')
            ->get();
        return $query;
    }

    public function get_facility_by_tp_api1($tourism_package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('service_package.name,service_package.id,detail_service_package.status')
            ->where('tourism_package_id', $tourism_package_id)
            ->where('status', '1')
            ->join('service_package', 'detail_service_package.service_package_id = service_package.id')
            ->get();
        return $query;
    }

    public function get_facility_by_tp_api2($tourism_package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('service_package.name,service_package.id,detail_service_package.status')
            ->where('tourism_package_id', $tourism_package_id)
            ->where('status', '0')
            ->join('service_package', 'detail_service_package.service_package_id = service_package.id')
            ->get();
        return $query;
    }

    public function get_facility_by_tp_api1e($tourism_package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('tourism_package_id', $tourism_package_id)
            ->where('status', '1')
            ->join('service_package', 'detail_service_package.service_package_id = service_package.id')
            ->get();
        return $query;
    }

    public function get_facility_by_tp_api2e($tourism_package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('tourism_package_id', $tourism_package_id)
            ->where('status', '0')
            ->join('service_package', 'detail_service_package.service_package_id = service_package.id')
            ->get();
        return $query;
    }

    public function get_facility_by_fc_api($facility_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->where('facility_id', $facility_id)
            ->get();
        return $query;
    }


    public function get_new_id_api()
    {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        $count = (int)substr($lastId['id'], 3);
        $id = sprintf('DFC%03d', $count + 1);
        return $id;
    }

    public function add_facility_api($id = null, $data = null)
    {
        $query = false;
        foreach ($data as $facility) {
            $new_id = $this->get_new_id_api();
            $content = [
                'id' => $new_id,
                'rumah_gadang_id' => $id,
                'facility_id' => $facility,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
            $query = $this->db->table($this->table)->insert($content);
        }
        return $query;
    }

    public function update_facility_api($id = null, $data = null)
    {
        $queryDel = $this->db->table($this->table)->delete(['rumah_gadang_id' => $id]);
        $queryIns = $this->add_facility_api($id, $data);
        return $queryDel && $queryIns;
    }
}
