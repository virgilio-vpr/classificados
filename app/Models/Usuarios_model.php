<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios_model extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    //----------- Puxa o total de usuários na base de dados-------------//
    public function getTotalUsuarios($filtros)
    {
        $filtrostring = ['1=1'];
        $params = [];
        $c = "";
        if (!empty($filtros['categoria'])) {
            $filtrostring[] = 'anuncios.id_categoria = :id_categoria:';
            $params['id_categoria'] = $filtros['categoria'];
        }
        if (!empty($filtros['preco'])) {
            $filtrostring[] = 'anuncios.valor BETWEEN :preco1: AND :preco2:';
            $preco = explode('-', $filtros['preco']);
            $params['preco1'] = $preco[0];
            $params['preco2'] = $preco[1];
        }
        if (!empty($filtros['estado'])) {
            $filtrostring[] = 'anuncios.estado = :estado:';
            $params['estado'] = $filtros['estado'];
        }
        $db = db_connect();
        $sql = $db->query("SELECT * FROM anuncios WHERE " . implode(' AND ', $filtrostring) . "", $params);
        $db->close;

        $users = [];
        if (!empty($sql->getResultArray())) {
            $arrays = $sql->getResultArray();
            foreach ($arrays as $arr) {
                array_push($users, $arr['id_usuario']);
            }
            $c = count(array_unique($users));
        }
        return $c;
    }

    //------------- Cadastrar no banco de dados -----------------//
    public function cadastrar($nome, $email, $senha, $telefone)
    {
        $params = [
            'email'   => $email
        ];

        $db = db_connect();
        $sql = $db->query("SELECT id FROM usuarios WHERE email = :email:", $params);
        $db->close();

        if ($sql->getFirstRow() == "") {
            $params = [
                'id'      => "",
                'nome'    => $nome,
                'email'   => $email,
                'senha'   => md5($senha),
                'telefone' => $telefone
            ];

            $db = db_connect();
            $db->query("
                    INSERT INTO usuarios
                    VALUES(
                        :id:,
                        :nome:,
                        :email:,
                        :senha:,
                        :telefone:
                    )
                ", $params);
            $db->close();
            return true;
        } else {
            return false;
        }
    }

    //-------------- Faz a checagem para login ---------------//
    public function logar($email, $senha)
    {
        $params = [
            'email' => $email,
            'senha' => $senha
        ];

        $db = db_connect();
        $sql = $db->query("SELECT id, nome FROM usuarios WHERE email = :email: && senha = MD5(:senha:)", $params);
        $db->close();

        if (!empty($sql->getResultObject())) {
            $dado = $sql->getResultObject();

            session()->set([
                "id"   => $dado[0]->id,
                "nome" => $dado[0]->nome
            ]);

            return true;
        } else {
            return false;
        }
    }
}
