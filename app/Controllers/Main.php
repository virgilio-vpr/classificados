<?php
namespace App\Controllers;
use App\Controllers\Anuncios;
use App\Models\Categorias_model;

class Main extends BaseController
{
	protected $anuncios;
	protected $categorias_model;
	public function __construct()
	{
		helper('form');
		$this->anuncios = new Anuncios();
		$this->categorias_model = new Categorias_model();
	}

	//-------------------- Carrega a página principal -------------------//
	public function index($p = null)
	{
		$filtros = [];
		if (isset($_POST['filtros']) && !empty($_POST['filtros'])) {
			$filtros = $_POST['filtros'];

			session()->set([
				"filtros"   => $filtros
			]);
		}

		if ($p != null) {
			$p = (int)addslashes($p);
		} else {
			$p = 1;
		}

		$por_pagina = 2;

		if (session()->has('filtros')) {
			$qt_anuncios = $this->anuncios->getTotalAnuncios(session()->get('filtros'));
			$ult_anuncios = $this->anuncios->getUltimosAnuncios($p, $por_pagina, session()->get('filtros'));
			$qt_users = $this->anuncios->getTotalUsuarios(session()->get('filtros'));
			$filtros = session()->get('filtros');
		} else {
			$qt_anuncios = $this->anuncios->getTotalAnuncios($filtros);
			$ult_anuncios = $this->anuncios->getUltimosAnuncios($p, $por_pagina, $filtros);
			$qt_users = $this->anuncios->getTotalUsuarios($filtros);

			$filtros = [
				'categoria' => '',
				'preco'     => '',
				'estado'    => ''
			];
		}
		$total_paginas = ceil($qt_anuncios / $por_pagina);

		//----- Prapara array de objetos e variáveis para pg home --------//
		$array = [
			'qt_anuncios'   => $qt_anuncios,
			'qt_users'      => $qt_users,
			'ult_anuncios'  => $ult_anuncios,
			'total_paginas' => $total_paginas,
			'p'             => $p,
			'categorias'    => $this->categorias_model->getLista(),
			'filtros'       => $filtros
		];
		return view('elements/home', $array);
	}

	//----------------- Método para busca de categorias -------------------//
	public function filtros()
	{
		if (!isset($_POST['filtros']) && empty($_POST['filtros'])) {
			return redirect()->to('public/main/index');
		}
		$filtros = $_POST['filtros'];
		return $filtros;
	}

	//------- Logout -> Destroy a session e redireciona para home ---------//
	public function logout()
	{
		session()->destroy();
		return redirect()->to(site_url('public'));
	}
}
