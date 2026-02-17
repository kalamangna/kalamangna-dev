<?php
namespace App\Models;
use CodeIgniter\Model;
class ClientModel extends Model {
    protected $table = 'clients';
    protected $allowedFields = ['name', 'company_name', 'phone', 'province_id', 'province_name', 'city_id', 'city_name', 'address_detail'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}