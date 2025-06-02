<?php

namespace App\Controllers;

class TransacaoController extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('usuario')) {
            return redirect()->to('/');
        }

        $usuario = session()->get('usuario');
        return view('dashboard', ['usuario' => $usuario]);
    }
}
