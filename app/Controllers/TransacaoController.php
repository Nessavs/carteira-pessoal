<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\CategoriaModel;

class TransacaoController extends BaseController
{
    private TransacaoModel $transacaoModel;
    private CategoriaModel $categoriaModel;

    public function __construct()
    {
        $this->transacaoModel = new TransacaoModel();
        $this->categoriaModel = new CategoriaModel();
        helper(['form', 'url']);
    }

    private function checkAuth()
    {
        if (!session()->get('usuario')) {
            return redirect()->to('/');
        }
        return null;
    }

    private function getCurrentUserId()
    {
        $usuario = session()->get('usuario');
        return $usuario['id'] ?? null;
    }

    public function dashboard()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $usuario = session()->get('usuario');
        $usuarioId = $this->getCurrentUserId();

        $transacoes = $this->transacaoModel->getTransacoesWithCategoria($usuarioId);
        
        $totalReceitas = 0;
        $totalDespesas = 0;
        $categorias = [];
        
        foreach ($transacoes as $transacao) {
            if ($transacao['tipo'] === 'receita') {
                $totalReceitas += $transacao['valor'];
            } else {
                $totalDespesas += $transacao['valor'];
            }
            
            $categoriaNome = $transacao['categoria_nome'] ?? 'Sem categoria';
            if (!isset($categorias[$categoriaNome])) {
                $categorias[$categoriaNome] = 0;
            }
            $categorias[$categoriaNome] += $transacao['valor'];
        }

        arsort($categorias);
        $topCategorias = array_slice($categorias, 0, 5, true);

        return view('dashboard', [
            'usuario' => $usuario,
            'totalReceitas' => $totalReceitas,
            'totalDespesas' => $totalDespesas,
            'topCategorias' => $topCategorias,
            'totalTransacoes' => count($transacoes)
        ]);
    }

    public function index()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $usuarioId = $this->getCurrentUserId();
        $transacoes = $this->transacaoModel->getTransacoesWithCategoria($usuarioId);

        return view('transacoes/index', [
            'transacoes' => $transacoes,
        ]);
    }

    public function create()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $categorias = $this->categoriaModel->findAll();

        return view('transacoes/form', [
            'categorias' => $categorias,
        ]);
    }

    public function store()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $userInput = $this->request->getPost(['titulo', 'descricao', 'valor', 'tipo', 'data', 'categoria_id']);

        if (!$this->validate($this->transacaoModel->getUserInputValidationRules(), [], $userInput)) {
            $categorias = $this->categoriaModel->findAll();
            return view('transacoes/form', [
                'validation' => $this->validator,
                'transacao'  => $userInput,
                'categorias' => $categorias,
            ]);
        }

        $data = $userInput;
        $data['usuario_id'] = $this->getCurrentUserId();
        $this->transacaoModel->insert($data);
        return redirect()->to(site_url('transacoes'));
    }

    public function edit($id)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $transacao = $this->transacaoModel->find($id);
        $usuarioId = $this->getCurrentUserId();

        if (!$transacao || $transacao['usuario_id'] != $usuarioId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $categorias = $this->categoriaModel->findAll();

        return view('transacoes/form', [
            'transacao'  => $transacao,
            'categorias' => $categorias,
        ]);
    }

    public function update($id)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $transacao = $this->transacaoModel->find($id);
        $usuarioId = $this->getCurrentUserId();

        if (!$transacao || $transacao['usuario_id'] != $usuarioId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $userInput = $this->request->getPost(['titulo', 'descricao', 'valor', 'tipo', 'data', 'categoria_id']);

        if (!$this->validate($this->transacaoModel->getUserInputValidationRules(), [], $userInput)) {
            $categorias = $this->categoriaModel->findAll();
            return view('transacoes/form', [
                'validation' => $this->validator,
                'transacao'  => ['id' => $id] + $userInput,
                'categorias' => $categorias,
            ]);
        }

        $dataInput = $userInput;
        $dataInput['usuario_id'] = $usuarioId;
        $this->transacaoModel->update($id, $dataInput);
        return redirect()->to(site_url('transacoes'));
    }

    public function delete($id)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $transacao = $this->transacaoModel->find($id);
        $usuarioId = $this->getCurrentUserId();

        if (!$transacao || $transacao['usuario_id'] != $usuarioId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->transacaoModel->delete($id);
        return redirect()->to(site_url('transacoes'));
    }
}
