<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddValorToCategorias extends Migration
{
    public function up()
    {
        $this->forge->addColumn('categorias', [
            'valor' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,       
                'after'      => 'tipo',  
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('categorias', 'valor');
    }
}
