<?php

namespace App\Models;

use CodeIgniter\Model;

class TransacaoModel extends Model
{
    protected $table = 'transacoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'valor', 'tipo', 'data', 'usuario_id'];
    protected $useTimestamps = true;
}
