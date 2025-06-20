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

    public function index()
    {
        return view('categorias/index', [
            'categorias' => $this->model->findAll(),
        ]);
    }

    public function create()
    {
        return view('categorias/form');
    }

    public function store()
    {
        $data = $this->request->getPost(['nome', 'tipo', 'valor']);

        if (! $this->validate($this->model->getValidationRules(), [], $data)) {
            return view('categorias/form', [
                'validation' => $this->validator,
                'categoria'  => $data,
            ]);
        }

        $this->model->insert($data);
        return redirect()->to(site_url('categorias'));
    }

    public function edit($id)
    {
        $cat = $this->model->find($id);

        if (! $cat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('categorias/form', ['categoria' => $cat]);
    }

    public function update($id)
    {
        $dataInput = $this->request->getPost(['nome', 'tipo', 'valor']);

        $dataForValidation = $dataInput + ['id' => $id];

        if (! $this->validate($this->model->getValidationRules(), [], $dataForValidation)) {
            return view('categorias/form', [
                'validation' => $this->validator,
                'categoria'  => ['id' => $id] + $dataInput,
            ]);
        }

        $this->model->update($id, $dataInput);
        return redirect()->to(site_url('categorias'));
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to(site_url('categorias'));
    }
}
