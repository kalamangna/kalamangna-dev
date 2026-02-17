<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    public function login() {
        if (session()->get('isLoggedIn')) return redirect()->to('/dashboard');
        return view('auth/login');
    }
    public function attemptLogin() {
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();
        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set(['id' => $user['id'], 'name' => $user['name'], 'isLoggedIn' => true]);
            return redirect()->to('/dashboard');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }
    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}