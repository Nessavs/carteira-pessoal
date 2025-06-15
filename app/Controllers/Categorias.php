<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categorias extends BaseController
{
    private CategoriaModel $model;

    public function __construct()
    {
        $this->model = new CategoriaModel();
        helper(['form', 'url']);
    }

    /* ------------------------------------------------------------------ */
    /*  LISTAGEM                                                          */
    /* ------------------------------------------------------------------ */
    public function index()
    {
        return view('categorias/index', [
            'categorias' => $this->model->findAll(),
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  FORMULÁRIO DE CRIAÇÃO                                             */
    /* ------------------------------------------------------------------ */
    public function create()
    {
        return view('categorias/form');
    }

    /* ------------------------------------------------------------------ */
    /*  SALVAR NOVA CATEGORIA                                             */
    /* ------------------------------------------------------------------ */
    public function store()
    {
        $data = $this->request->getPost(['nome', 'tipo']);

        if (! $this->validate($this->model->getValidationRules(), [], $data)) {
            return view('categorias/form', [
                'validation' => $this->validator,
                'categoria'  => $data,
            ]);
        }

        $this->model->insert($data);
        return redirect()->to(site_url('categorias'));
    }

    /* ------------------------------------------------------------------ */
    /*  FORMULÁRIO DE EDIÇÃO                                              */
    /* ------------------------------------------------------------------ */
    public function edit($id)
    {
        $cat = $this->model->find($id);

        if (! $cat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('categorias/form', ['categoria' => $cat]);
    }

    /* ------------------------------------------------------------------ */
    /*  ATUALIZAR CATEGORIA                                               */
    /* ------------------------------------------------------------------ */
    public function update($id)
    {
        // pega apenas nome e tipo
        $dataInput = $this->request->getPost(['nome', 'tipo']);

        // adiciona o id só para a validação (placeholder {id})
        $dataForValidation = $dataInput + ['id' => $id];

        if (! $this->validate($this->model->getValidationRules(), [], $dataForValidation)) {
            return view('categorias/form', [
                'validation' => $this->validator,
                'categoria'  => ['id' => $id] + $dataInput,
            ]);
        }

        // grava sem enviar id no payload
        $this->model->update($id, $dataInput);
        return redirect()->to(site_url('categorias'));
    }

    /* ------------------------------------------------------------------ */
    /*  EXCLUIR CATEGORIA                                                 */
    /* ------------------------------------------------------------------ */
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('categorias'));
    }
}
