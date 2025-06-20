<?php

namespace App\Models;

use CodeIgniter\Model;

class TransacaoModel extends Model
{
    protected $table = 'transacoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descricao', 'valor', 'tipo', 'data', 'categoria_id', 'usuario_id'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $returnType = 'array';

    protected $validationRules = [
        'titulo'       => 'required|min_length[3]|max_length[255]',
        'valor'        => 'required|decimal|greater_than[0]',
        'tipo'         => 'required|in_list[receita,despesa]',
        'data'         => 'required|valid_date',
        'categoria_id' => 'required|integer',
        'usuario_id'   => 'required|integer',
    ];

    protected $userInputValidationRules = [
        'titulo'       => 'required|min_length[3]|max_length[255]',
        'valor'        => 'required|decimal|greater_than[0]',
        'tipo'         => 'required|in_list[receita,despesa]',
        'data'         => 'required|valid_date',
        'categoria_id' => 'required|integer',
    ];

    protected $validationMessages = [
        'titulo' => [
            'required'   => 'O título é obrigatório.',
            'min_length' => 'O título deve ter pelo menos 3 caracteres.',
            'max_length' => 'O título não pode ter mais de 255 caracteres.',
        ],
        'valor' => [
            'required'     => 'O valor é obrigatório.',
            'decimal'      => 'O valor deve ser um número válido.',
            'greater_than' => 'O valor deve ser maior que zero.',
        ],
        'tipo' => [
            'required' => 'O tipo é obrigatório.',
            'in_list'  => 'O tipo deve ser receita ou despesa.',
        ],
        'data' => [
            'required'   => 'A data é obrigatória.',
            'valid_date' => 'Informe uma data válida.',
        ],
        'categoria_id' => [
            'required' => 'A categoria é obrigatória.',
            'integer'  => 'Selecione uma categoria válida.',
        ],
    ];

    public function getTransacoesWithCategoria($usuarioId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('transacoes.*, categorias.nome as categoria_nome')
            ->join('categorias', 'categorias.id = transacoes.categoria_id', 'left')
            ->where('transacoes.deleted_at', null);

        if ($usuarioId) {
            $builder->where('transacoes.usuario_id', $usuarioId);
        }

        return $builder->orderBy('transacoes.data', 'DESC')->get()->getResultArray();
    }

    public function getValidationRules(array $options = []): array
    {
        return $this->validationRules;
    }

    public function getUserInputValidationRules(): array
    {
        return $this->userInputValidationRules;
    }
}
