<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitHistoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'visit_history';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'user_id', 'date_visit', 'category', 'object_id','rating','review'];

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

    // API
    public function get_new_id_api() {
        $lastId = $this->db->table($this->table)->select('id')->orderBy('id', 'ASC')->get()->getLastRow('array');
        if ($lastId != null) {
            $count = (int)substr($lastId['id'], 0);
            $id = sprintf('%02d', $count + 1);
            return $id;
        } else {
            return '01';
        }
    }

    public function get_visit_history_by_id_api($id = null) {
        $query = $this->db->table($this->table)
            ->select('visit_history.*')
            ->where('user_id', $id)
            ->orderBy('date_visit', 'DESC')
            ->get();
        return $query;
    }

    public function get_visited_object_api($list_data = null) {
        $new_data = array();
        foreach ($list_data as $data) {
            if ($data['category'] == '1') {
                $query = $this->db->table('rumah_gadang')
                    ->select('name')
                    ->where('id', $data['object_id'])
                    ->get()->getRowArray();
                $data['object_name'] = $query['name'];
            } elseif ($data['category'] == '2') {
                $query = $this->db->table('tourism_package')
                    ->select('name')
                    ->where('id', $data['object_id'])
                    ->get()->getRowArray();
                $data['object_name'] = $query['name'];
            }
            $new_data[] = $data;
        }

        return $new_data;
    }

    function getRating($id) {
        $query = $this->db->table($this->table)
            ->select('visit_history.rating')
            ->where('rumah_gadang_id', $id)
            ->get()->getResultArray();;
        return $query;
    }

    function getVisitByUser($user) {
        $query = $this->db->table($this->table)
            ->select('visit_history.*,rumah_gadang.name as rumah_gadang_name')
            ->join('rumah_gadang', 'rumah_gadang.id = visit_history.rumah_gadang_id', 'left')
            ->where("visit_history.user_id",$user)
            ->get()->getResultArray();
        return $query;
    }

    function getVisitByID($id) {
        $query = $this->db->table($this->table)
            ->select('visit_history.*,rumah_gadang.name as rumah_gadang_name,users.username')
            ->join('rumah_gadang', 'rumah_gadang.id = visit_history.rumah_gadang_id', 'left')
            ->join('users', 'users.id = visit_history.user_id', 'left')
            ->where("visit_history.rumah_gadang_id",$id)
            ->get()->getResultArray();
        return $query;
    }

    function checkVisit($data) {
        $query = $this->db->table($this->table)
            ->select('visit_history.*,rumah_gadang.name as rumah_gadang_name')
            ->join('rumah_gadang', 'rumah_gadang.id = visit_history.rumah_gadang_id', 'left')
            ->where("visit_history.rumah_gadang_id",$data['rumah_gadang_id'])
            ->where("visit_history.user_id",$data['user_id'])
            ->where("visit_history.date_visit",$data['date_visit'])
            ->get()->getResultArray();
        return $query;
    }

    function insertVisit($data) {
        $content = [
            "date_visit" => date("Y-m-d"),
            "rumah_gadang_id" => $data['rumah_gadang_id'],
            "rating" => $data['rating'],
            "review" => $data['review'],
            "user_id" => $data['user_id']
        ];
        $query = $this->db->table($this->table)->insert($content);

        return $query;        
    }

    public function get_object_by_rating_api($object = null, $rating = null) {
        $query = $this->db->table($this->table)
            ->select("ceil(avg(rating)) as avg_rating, {$object}")
            ->where("{$object} IS NOT NULL")
            ->groupBy($object)
            ->having("avg_rating = {$rating}")
            ->get();
        return $query;
    }
}
