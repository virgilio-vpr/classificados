<?php

namespace App\Controllers;

use App\Libraries\Fotos;
use App\Models\Categorias_model;
use App\Models\Anuncios_model;
use CodeIgniter\Controller;
use App\Libraries\Code_msg;
use App\Models\Usuarios_model;

class Anuncios extends Controller
{
    protected $codeMsg;
    protected $foto;
    protected $categorias_model;
    protected $anuncios_model;
    protected $usuarios_model;

    public function __construct()
    {
        helper('form');
        $this->codeMsg = new Code_msg();
        $this->foto = new Fotos();
        $this->categorias_model = new Categorias_Model();
        $this->anuncios_model = new Anuncios_model();
        $this->usuarios_model = new Usuarios_model();
    }

    //---- Carrega a página dos meus anúncios se estiver logado ------//
    public function index()
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }

        $a = $this->anuncios_model->getMeusAnuncios(session()->get('id'));

        $array = [
            'anuncios' => $a
        ];
        return view('elements/meus_anuncios', $array);
    }

    //---- Carrega os últimos anúncios cadastrados do BD na pag. home------//
    public function getUltimosAnuncios($page, $perPage, $filtros)
    {
        $ult_anuncios = $this->anuncios_model->getUltimosAnuncios($page, $perPage, $filtros);
        return $ult_anuncios;
    }

    //----------------------Número total de anúncios -----------------------//
    public function getTotalAnuncios($filtros)
    {
        $total_anuncios = $this->anuncios_model->getTotalAnuncios($filtros);
        return $total_anuncios;
    }

    //-------------------Numero total de Usuários -------------------------//
    public function getTotalUsuarios($filtros)
    {
        $total_usuarios = $this->usuarios_model->getTotalUsuarios($filtros);
        return $total_usuarios;
    }


    //--------------- Faz o controle de cadastro dos anuncios -------------//
    public function cadastrar()
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }
        $cats = $this->categorias_model->getLista();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {

            if (
                !empty($_POST['titulo']) && !empty($_POST['categoria'])
                && !empty($_POST['valor']) && is_numeric($_POST['valor'])
                && !empty($_POST['descricao']) && (!empty($_POST['estado']
                || $_POST['estado'] == 0))
            ) {
                $titulo = addslashes($_POST['titulo']);
                $categoria = addslashes($_POST['categoria']);
                $valor = addslashes($_POST['valor']);
                $valor = number_format(str_replace(",", ".", str_replace(".", "", $valor)), 2, '.', '');
                $descricao = addslashes($_POST['descricao']);
                $estado = addslashes($_POST['estado']);

                $categ = $this->anuncios_model->cadastrarAnuncio($categoria, $titulo, $descricao, $valor, $estado);

                // echo "<pre>";
                // dd($categ);
                // die;

                if ($categ == true) {
                    $variaveis = [
                        'msg'        => 'Anúncio cadastrado com sucesso!',
                        'status_msg' => '1',
                        'cats'       => $cats
                    ];
                    // echo "<pre>";
                    //dd($cats);
                    // die;

                    echo view('elements/add_anuncios', $variaveis);
                } else {
                    $variaveis = [
                        'msg'        => 'Erro ao cadastrar anuncio!',
                        'status_msg' => '2',
                        'cats'       => $cats
                    ];
                return view('elements/add_anuncios', $variaveis);
                }
            } else {
                $variaveis = [
                    'msg'        => 'Preencha todos os campos do formulário!',
                    'status_msg' => '3',
                    'cats'       => $cats
                ];
                return view('elements/add_anuncios', $variaveis);
            }
        } else {
            $variaveis = [
                'msg'        => '',
                'status_msg' => '',
                'cats'       => $cats
            ];
            echo view('elements/add_anuncios', $variaveis);
        }
    }

    //--------------------- Exclui anúncio do base de dados --------------------//
    public function excluir($id)
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }
        if (isset($id) && !empty($id)) {
            $this->anuncios_model->excluirAnuncio($id);
            return redirect()->to(site_url('public/anuncios/index'));
        } else {
            return redirect()->to(site_url('public/anuncios/index'));
        }
    }

    //------ Busca o anúncios através do 'id' na base de dados para edição -----//
    public function editar($id)
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }
        $cats = $this->categorias_model->getLista();
        if (isset($id) && !empty($id)) {
            $info = $this->anuncios_model->getAnuncio($id);
            if (!empty($info)) {
                $variaveis = [
                    'msg'        => '',
                    'status_msg' => '',
                    'cats'       => $cats,
                    'info'       => $info
                ];
                echo view('elements/editar_anuncio', $variaveis);
            }
        } else {
            return redirect()->to(site_url('public/anuncios/index'));
        }
    }

    //--------------------------- Update do anúncio -----------------------------//
    public function update($id)
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }
        $cats = $this->categorias_model->getLista();
        $info = $this->anuncios_model->getAnuncio($id);
        if (
            isset($_POST['titulo']) && !empty($_POST['titulo']) && !empty($_POST['categoria'])
            && !empty($_POST['valor']) && !empty($_POST['descricao'])
            && (!empty($_POST['estado'] || $_POST['estado'] == 0))
        ) {
            //--------- Faz o tratamento das variáveis dentro do POST -----------//
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $valor = number_format(str_replace(",", ".", str_replace(".", "", $valor)), 2, '.', '');
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            //----------------- Verifica arquivos de imagens --------------------//
            foreach ($this->request->getFiles()['fotos'] as $img) {

                // ------ chama classe Fotos para tratamento das imagens --------//
                $result = $this->foto->checkFoto($img);

                if ($result['code'] == '0') {
                    $this->anuncios_model->cadastrarURL($result['url'], $id);
                }
            }
            $update = $this->anuncios_model->updateAnuncio($categoria, $titulo, $descricao, $valor, $estado, $id);
            $info = $this->anuncios_model->getAnuncio($id);
            if ($update == true) {
                if ($result['code'] == '0') {
                    $msg = $this->codeMsg->codeMsg($result['code']);
                    $st = '0';
                } else if ($result['code'] == '1') {
                    $msg = $this->codeMsg->codeMsg('1');
                    echo "<pre>";
                    $st = '1';
                } else if ($result['code'] == '2') {
                    $msg = $this->codeMsg->codeMsg('2');
                    $st = '2';
                } else {
                    $msg = $this->codeMsg->codeMsg('3');
                    $st = '3';
                }
            } else {
                $msg = $this->codeMsg->codeMsg('4');
                $st = '4';
            }
        } else {
            $msg = $this->codeMsg->codeMsg('5');
            $st = '5';
        }
        $variaveis = [
            'msg'  => $msg,
            'st'   => $st,
            'cats' => $cats,
            'info' => $info
        ];
        return view('elements/editar_anuncio', $variaveis);
    }

    //----------------------------- Exclui foto do anuncio ----------------------------//
    public function excluir_foto($id)
    {
        if (!session()->has('id')) {
            return redirect()->to(site_url('public'));
        }
        if (isset($id) && !empty($id)) {
            $row = $this->anuncios_model->excluirFoto($id);
            if (!empty($row)) {
                $res_delete = $this->foto->excluirFoto($row->url_foto);
                if ($res_delete == true) {
                    $variaveis = [
                        'msg'  => $this->codeMsg->codeMsg('6'),
                        'st'   => '6',
                        'cats' => $this->categorias_model->getLista(),
                        'info' => $this->anuncios_model->getAnuncio($row->id_anuncio)
                    ];
                    return view('elements/editar_anuncio', $variaveis);
                }
            } else {
                return redirect()->to(site_url('public/anuncios/index'));
            }
        } else {
            return redirect()->to(site_url('public/anuncios/index'));
        }
    }
}
