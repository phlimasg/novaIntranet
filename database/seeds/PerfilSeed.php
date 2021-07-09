<?php

use App\Model\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create([
            'nome' => 'Administrador',
            'descricao' => 'Administrador do sistema.',
        ]);
        Perfil::create([
            'nome' => 'Motorista',
            'descricao' => 'Perfil dos motoristas.',
        ]);
        Perfil::create([
            'nome' => 'Coordenador',
            'descricao' => 'Coordenador de setor(Autoriza as solicitações).',
        ]);
        Perfil::create([
            'nome' => 'Usuario',
            'descricao' => 'Usuário comum dos sistema.',
        ]);
    }
}
