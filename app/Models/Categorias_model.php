<?php
namespace App\Models;

use CodeIgniter\Model;

class Categorias_model extends Model
{
    public function getLista()
    {
        $dados = [];
        $db = db_connect();
        $sql = $db->query("SELECT * FROM categorias");
        $db->close();

        if (!empty($sql->getResultObject())) {
            $dados = $sql->getResultObject();
        }

        return $dados;
    }
}