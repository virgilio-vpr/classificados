<?php

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;


class Cadastro extends Controller
{

    // ----- Chama formulário de cadastro e valida os dados -------//
    public function index()
    {
        helper('form');

        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = $_POST['senha'];
            $telefone = addslashes($_POST['telefone']);

            if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
                $user = new Usuarios_model();

                $u = $user->cadastrar($nome, $email, $senha, $telefone);

                if ($u == true) {
                    $status_msg = [
                        'status_msg' => 'Cadastrado realizado com sucesso!',
                    ];
                    return view('elements/cadastre_se', $status_msg);
                } else
                    $status_msg = [
                        'status_msg' => 'O email já existe na base de dados!',
                    ];
                return view('elements/cadastre_se', $status_msg);
            } else {
                $status_msg = [
                    'status_msg' => 'Preencha todos os campos!',
                ];
                return view('elements/cadastre_se', $status_msg);
            }
        } else {
            $status_msg = [
                'status_msg' => '',
            ];
            return view('elements/cadastre_se', $status_msg);
        }
    }
}
