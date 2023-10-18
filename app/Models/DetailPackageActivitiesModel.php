<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPackageActivitiesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detail_package_activities';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'tourism_package_id', 'package_activities_id, day'];

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
}
