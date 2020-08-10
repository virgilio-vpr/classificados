<?php

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;


class Login extends Controller
{

    // ----- Executa as chamadas para login -------//
    public function index()
    {
        helper('form');

        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = $_POST['senha'];

            if (!empty($_POST['email']) && !empty($_POST['senha'])) {
                $user = new Usuarios_model();

                $u = $user->logar($email, $senha);

                if ($u == true) {

                    return redirect()->to(site_url('public'));
                } else
                    $status_msg = [
                        'status_msg' => 'Usuário e/ou senha errados!',
                    ];
                return view('elements/login_form', $status_msg);
            } else {
                $status_msg = [
                    'status_msg' => 'Preencha todos os campos!',
                ];
                return view('elements/login_form', $status_msg);
            }
        } else {
            $status_msg = [
                'status_msg' => '',
            ];
            return view('elements/login_form', $status_msg);
        }
    }
}
