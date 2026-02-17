<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ClientModel;

class Projects extends BaseController
{
    protected $projectModel;
    protected $clientModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'All Projects',
            'projects' => $this->projectModel->select('projects.*, clients.company_name')
                            ->join('clients', 'clients.id = projects.client_id')
                            ->orderBy('projects.created_at', 'DESC')
                            ->findAll(),
        ];
        return view('projects/index', $data);
    }

    public function show($id = null)
    {
        $project = $this->projectModel->select('projects.*, clients.company_name, clients.name as client_contact')
                        ->join('clients', 'clients.id = projects.client_id')
                        ->find($id);

        if (!$project) return redirect()->to('/projects')->with('error', 'Project not found.');

        $data = [
            'title'    => 'Project Details',
            'project'  => $project,
        ];
        return view('projects/show', $data);
    }

    public function new()
    {
        $data = [
            'title'   => 'Create New Project',
            'clients' => $this->clientModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('projects/create', $data);
    }

    public function create()
    {
        $rules = [
            'client_id'  => 'required|numeric',
            'name'       => 'required|min_length[3]',
            'start_date' => 'required|valid_date',
            'end_date'   => 'required|valid_date',
            'status'     => 'required|in_list[Planning,On Progress,Completed]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->projectModel->save([
            'client_id'   => $this->request->getPost('client_id'),
            'name'        => $this->request->getPost('name'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/projects')->with('success', 'Project created successfully!');
    }

    public function edit($id = null)
    {
        $project = $this->projectModel->find($id);
        if (!$project) return redirect()->to('/projects')->with('error', 'Project not found.');

        $data = [
            'title'   => 'Edit Project',
            'project' => $project,
            'clients' => $this->clientModel->findAll(),
        ];
        return view('projects/edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'client_id'  => 'required|numeric',
            'name'       => 'required|min_length[3]',
            'start_date' => 'required|valid_date',
            'end_date'   => 'required|valid_date',
            'status'     => 'required|in_list[Planning,On Progress,Completed]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->projectModel->update($id, [
            'client_id'   => $this->request->getPost('client_id'),
            'name'        => $this->request->getPost('name'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status'),
        ]);

        return redirect()->to('/projects/'.$id)->with('success', 'Project updated successfully!');
    }

    public function delete($id = null)
    {
        $this->projectModel->delete($id);
        return redirect()->to('/projects')->with('success', 'Project deleted successfully.');
    }
}