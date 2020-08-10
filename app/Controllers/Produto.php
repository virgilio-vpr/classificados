<?php
namespace App\Controllers;
use App\Models\Anuncios_model;

class Produto extends BaseController
{
    protected $anuncios_model;
    public function __construct()
    {
        $this->anuncios_model = new Anuncios_model();
    }

    //------- Método para exibir detalhes do produto anuniado -------//
    public function index($id_anuncio)
    {
        if (isset($id_anuncio) && !empty($id_anuncio)) {
            $id_anuncio = addslashes($id_anuncio);
        } else {
            return redirect()->to(site_url('public'));
        }
        $info = $this->anuncios_model->getAnuncio($id_anuncio);
        $array = [
            'info' => $info
        ];
        echo view('elements/produto', $array);
    }
}
