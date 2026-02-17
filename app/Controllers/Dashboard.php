<?php
namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\ClientModel;

class Dashboard extends BaseController {
    public function index() {
        $projectModel = new ProjectModel();
        $clientModel = new ClientModel();

        $data = [
            'title'             => 'Dashboard',
            'total_projects'    => $projectModel->countAllResults(),
            'active_projects'   => $projectModel->where('status', 'On Progress')->countAllResults(),
            'completed_projects'=> $projectModel->where('status', 'Completed')->countAllResults(),
            'total_clients'     => $clientModel->countAllResults(),
            'recent_projects'   => $projectModel->select('projects.*, clients.company_name')
                                    ->join('clients', 'clients.id = projects.client_id')
                                    ->orderBy('projects.created_at', 'DESC')
                                    ->limit(5)
                                    ->findAll(),
        ];
        return view('dashboard/index', $data);
    }
}