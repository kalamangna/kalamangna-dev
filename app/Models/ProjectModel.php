<?php
namespace App\Models;
use CodeIgniter\Model;
class ProjectModel extends Model {
    protected $table = 'projects';
    protected $allowedFields = ['client_id', 'name', 'start_date', 'end_date', 'status'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}