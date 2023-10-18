<?php

namespace App\Models;

use CodeIgniter\Model;

class MyBookingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'booking';
    protected $primaryKey       = 'date';
    protected $returnType       = 'array';
    protected $allowedFields    = [];

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

    public function getList(){
        $query = $this->db->table($this->table)
            ->select('booking.*,tourism_package.`custom`,tourism_package.`name` as package_name,tourism_package.`id` as package_id,tourism_package.`contact_person` as contact, users.`phone`')
            ->join('tourism_package', 'tourism_package.id = booking.tourism_package_id', 'left')
            ->join('users', 'users.id = booking.users_id', 'left')
            //->join('tourism_package', 'tourism_package.id = booking.tourism_package_id', 'left')
            ->orderBy("purchase_date", "desc")
            ->get()->getResultArray();
        return $query;
    }

    function getListByUser($iduser) {
        $query = $this->db->table($this->table)
            ->select('booking.*,tourism_package.`custom`,tourism_package.`name` as package_name')
            ->join('tourism_package', 'tourism_package.id = booking.tourism_package_id', 'left')
            ->where("booking.users_id",$iduser)
            ->orderBy("purchase_date", "desc")
            ->get()->getResultArray();
        return $query;
    }

    function getBookDetail($packageid,$tanggal,$userid) {
        $query = $this->db->table($this->table)
            ->select('booking.*,tourism_package.`custom`,tourism_package.`name` as package_name,users.username as user_name')
            ->join('tourism_package', 'tourism_package.id = booking.tourism_package_id', 'left')
            ->join('users', 'users.id = booking.users_id', 'left')
            ->where("booking.users_id",$userid)
            ->where("booking.date",$tanggal)
            ->where("booking.tourism_package_id",$packageid)
            ->get()->getResultArray();
        return $query;
    }

    function getRating($packageid) {
        $query = $this->db->table($this->table)
            ->select('booking.rating,booking.date,booking.review,users.username')
            ->join('users', 'users.id = booking.users_id', 'left')
            ->where("booking.tourism_package_id",$packageid)
            ->get()->getResultArray();
        return $query;
    }

    function updateBook($data) {
        $content = [            
            "date" => $data['datenew'],
            "total_member" => $data['total_member'],
            "comment" => $data['comment'],
        ];
        $query = $this->db
            ->table($this->table)
            ->where("booking.users_id",$data['user_id'])
            ->where("booking.date",$data['date'])
            ->where("booking.tourism_package_id",$data['tourism_package_id'])
            ->update($content);

        return $query;
    }

    function updateStatus($data) {
        $content = [
            "status" => $data['status']
        ];
        $query = $this->db
            ->table($this->table)
            ->where("booking.users_id",$data['user_id'])
            ->where("booking.date",$data['date'])
            ->where("booking.tourism_package_id",$data['tourism_package_id'])
            ->update($content);

        return $query;
    }

    function updateRating($data) {
        $content = [
            "rating" => $data['rating'],
            "review" => $data['review'],
        ];
        $query = $this->db
            ->table($this->table)
            ->where("booking.users_id",$data['user_id'])
            ->where("booking.date",$data['date'])
            ->where("booking.tourism_package_id",$data['tourism_package_id'])
            ->update($content);

        return $query;
    }

    function insertBook($data) {
        $content = [
            "purchase_date" => date("Y-m-d"),
            "purchase_time" => date("H:i:s"),
            "total_member" => $data['total_member'],
            "status" => 1,
            "date" => $data['date'],
            "comment" => $data['comment'],
            "tourism_package_id" => $data['tourism_package_id'],
            "users_id" => $data['user_id']
        ];
        $query = $this->db->table($this->table)->insert($content);

        return $query;
    }

    function deleteBook($data) {
        $query = $this->db->table($this->table)
        ->where("booking.users_id",$data['user_id'])
        ->where("booking.date",$data['date'])
        ->where("booking.tourism_package_id",$data['tourism_package_id'])
        ->delete();
        return $query;
    }
}
