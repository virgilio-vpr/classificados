<?php

namespace App\Models;

use CodeIgniter\Model;

class Anuncios_model extends Model
{
    protected $table      = 'anuncios';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    //----------- Puxa o total de anuncios na base de dados-------------//
    public function getTotalAnuncios($filtros = null)
    {
        $filtrostring = ['1=1'];
        $params = [];
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
        $sql = $db->query("SELECT COUNT(*) as c FROM anuncios WHERE " . implode(' AND ', $filtrostring), $params);
        $db->close;
        $row = $sql->getRowObject();
        return $row->c;
    }

    //------------- Puxa os anuncios do banco de dados -----------------//
    public function getMeusAnuncios($id_usuario)
    {
        $dados = [];
        $params = [
            'id_usuario'   => $id_usuario
        ];
        $db = db_connect();
        $sql = $db->query("SELECT *,
            (select anuncios_imagens.url_foto from anuncios_imagens where anuncios_imagens
                .id_anuncio = anuncios.id limit 1) as url_foto        
            FROM anuncios
            WHERE id_usuario = :id_usuario:", $params);
        $db->close();

        if (!empty($sql->getResultObject())) {
            $dados = $sql->getResultObject();
        }
        return $dados;
    }

    //-------- Puxa os últimos anuncios do banco de dados para pg. home-----------//
    public function getUltimosAnuncios($page, $perPage, $filtros)
    {   
        $offset = ($page - 1) * $perPage;
        $array = [];
       
        $filtrostring = ['1=1'];
        $params = [];
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
        $sql = $db->query("SELECT
        *,
        (select anuncios_imagens.url_foto from anuncios_imagens where 
            anuncios_imagens.id_anuncio = anuncios.id limit 1) as url_foto,
        (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria   
        FROM anuncios WHERE " . implode(' AND ', $filtrostring) . " ORDER BY id DESC LIMIT $offset, $perPage", $params);
        $db->close();

        if (!empty($sql->getResultObject())) {
            $array = $sql->getResultObject();
        }
        return $array;
    }

    //-------------------- Faz o cadastro de anuncios -----------------------------//
    public function cadastrarAnuncio($categoria, $titulo, $descricao, $valor, $estado)
    {
        $params = [
            'id'         => "",
            'id_usuario' => session()->get('id'),
            'id_categoria'  => $categoria,
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'valor'      => $valor,
            'estado'     => $estado
        ];
        $db = db_connect();
        $db->query("
                    INSERT INTO anuncios
                    VALUES(
                        :id:,
                        :id_usuario:,
                        :id_categoria:,
                        :titulo:,
                        :descricao:,
                        :valor:,
                        :estado:
                    )
                ", $params);
        $db->close();
        return true;
    }

    //----------------------- Deletar anúncio ------------------------//
    public function excluirAnuncio($id)
    {
        $params = [
            'id' => $id
        ];
        $db = db_connect();
        $db->query("DELETE FROM anuncios_imagens WHERE id_anuncio = :id:", $params);
        $db->query("DELETE FROM anuncios WHERE id = :id:", $params);
        $db->close();
    }
    //----------------------- Deletar Foto ------------------------//
    public function excluirFoto($id)
    {
        $row = [];
        $db = db_connect();
        $sql = $db->query("SELECT id_anuncio, url_foto FROM anuncios_imagens WHERE id = $id");
        $db->query("DELETE FROM anuncios_imagens WHERE id = $id");
        $db->close();

        if (!empty($sql->getRowObject())) {
            $row = $sql->getRowObject();
        }
        return $row;
    }

    //----------- Puxa um único anuncio do BD para edição ------------//
    public function getAnuncio($id)
    {
        $array = [];
        $params = [
            'id' => $id
        ];
        $db = db_connect();
        $sql = $db->query("SELECT *,
                        (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
                        (select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone
                        FROM anuncios WHERE id = :id:", $params);
        $db->close();

        if (!empty($sql->getResultArray())) {
            $array = $sql->getResultArray();
            $array['fotos'] = [];
            $db = db_connect();
            $sql = $db->query("SELECT id, url_foto FROM anuncios_imagens WHERE id_anuncio = $id");
            $db->close();

            if (!empty($sql->getResultArray())) {
                $array['fotos'] = $sql->getResultArray();
            }
        }
        return $array;
    }

    //-------------------------- Update do Anúncio ------------------------//
    public function updateAnuncio($categoria, $titulo, $descricao, $valor, $estado, $id)
    {
        $params = [
            'id'         => $id,
            'id_usuario' => session()->get('id'),
            'id_categoria'  => $categoria,
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'valor'      => $valor,
            'estado'     => $estado
        ];
        $db = db_connect();
        $db->query("UPDATE anuncios
                    SET id_categoria = :id_categoria:, titulo = :titulo:, descricao = :descricao:, valor = :valor:, estado = :estado:
                    WHERE id = :id: AND id_usuario = :id_usuario:", $params);
        $db->close();
        return true;
    }

    //------------- Cadastrar url e id das imagens no BD ------------------//
    public function cadastrarURL($url, $id)
    {
        $params = [
            'id_anuncio' => $id,
            'url_foto' => $url
        ];
        $db = db_connect();
        $db->query("INSERT INTO anuncios_imagens (id_anuncio, url_foto) VALUES(:id_anuncio:, :url_foto:)", $params);
        $db->close();
        return;
    }
}
