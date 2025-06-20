<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table         = 'categorias';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nome', 'tipo', 'valor'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'nome'  => 'required|max_length[100]|is_unique[categorias.nome,id,{id}]',
        'tipo'  => 'required|in_list[receita,despesa]',
        'valor' => 'permit_empty|decimal|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required'   => 'O campo Nome é obrigatório.',
            'max_length' => 'O Nome deve ter no máximo 100 caracteres.',
            'is_unique'  => 'Já existe uma categoria com esse Nome.',
        ],
        'tipo' => [
            'required' => 'O campo Tipo é obrigatório.',
            'in_list'  => 'Tipo inválido. Escolha Receita ou Despesa.',
        ],
        'valor' => [
            'decimal'                  => 'O Valor deve ser numérico.',
            'greater_than_equal_to'    => 'O Valor não pode ser negativo.',
        ],
    ];
}
