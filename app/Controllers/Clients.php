<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\ProjectModel;

class Clients extends BaseController
{
    protected $clientModel;
    protected $projectModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->projectModel = new ProjectModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Clients Management',
            'clients' => $this->clientModel->orderBy('company_name', 'ASC')->findAll(),
        ];
        return view('clients/index', $data);
    }

    public function show($id = null)
    {
        $client = $this->clientModel->find($id);
        if (!$client) return redirect()->to('/clients')->with('error', 'Client not found.');

        $data = [
            'title'    => 'Client Details',
            'client'   => $client,
            'projects' => $this->projectModel->where('client_id', $id)->findAll(),
        ];
        return view('clients/show', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Add New Client',
        ];
        return view('clients/create', $data);
    }

    public function create()
    {
        $rules = [
            'name'           => 'required|min_length[3]',
            'company_name'   => 'required|min_length[3]',
            'province_id'    => 'required',
            'city_id'        => 'required',
            'address_detail' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->clientModel->save([
            'name'           => $this->request->getPost('name'),
            'company_name'   => $this->request->getPost('company_name'),
            'phone'          => $this->request->getPost('phone'),
            'province_id'    => $this->request->getPost('province_id'),
            'province_name'  => $this->request->getPost('province_name'),
            'city_id'        => $this->request->getPost('city_id'),
            'city_name'      => $this->request->getPost('city_name'),
            'address_detail' => $this->request->getPost('address_detail'),
        ]);

        return redirect()->to('/clients')->with('success', 'Client added successfully.');
    }

    public function edit($id = null)
    {
        $client = $this->clientModel->find($id);
        if (!$client) return redirect()->to('/clients')->with('error', 'Client not found.');

        $data = [
            'title'  => 'Edit Client',
            'client' => $client,
        ];
        return view('clients/edit', $data);
    }

    public function update($id = null)
    {
        $rules = [
            'name'           => 'required|min_length[3]',
            'company_name'   => 'required|min_length[3]',
            'province_id'    => 'required',
            'city_id'        => 'required',
            'address_detail' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->clientModel->update($id, [
            'name'           => $this->request->getPost('name'),
            'company_name'   => $this->request->getPost('company_name'),
            'phone'          => $this->request->getPost('phone'),
            'province_id'    => $this->request->getPost('province_id'),
            'province_name'  => $this->request->getPost('province_name'),
            'city_id'        => $this->request->getPost('city_id'),
            'city_name'      => $this->request->getPost('city_name'),
            'address_detail' => $this->request->getPost('address_detail'),
        ]);

        return redirect()->to('/clients')->with('success', 'Client updated successfully.');
    }

    public function delete($id = null)
    {
        $this->clientModel->delete($id);
        return redirect()->to('/clients')->with('success', 'Client deleted successfully.');
    }
}