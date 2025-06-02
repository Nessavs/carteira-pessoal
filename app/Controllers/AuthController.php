<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        $usuario = $model->where('email', $email)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $session->set('usuario', [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'logado' => true,
            ]);
            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('erro', 'Login ou senha inválidos.');
            return redirect()->to('/');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function doRegister()
    {
        $model = new UserModel();

        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'senha' => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT)
        ];

        $model->insert($data);

        return redirect()->to('/')->with('sucesso', 'Usuário registrado com sucesso. Faça login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
