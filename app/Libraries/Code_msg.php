<?php

namespace App\Libraries;

class Code_msg
{
    public function codeMsg($code)
    {
        switch ($code) {
            case '0':
                $c = 'Edição e/ou imagem carregada com sucesso!';
                break;
            case '1':
                $c = 'O tamanho do arquivo deve ser menor que 1 Mb!';
                break;
            case '2':
                $c = 'Somente arquivos imagem com extensões jpeg, jpg ou png!';
                break;
            case '3':
                $c = 'Edição realizada com sucesso!';
                break;
            case '4':
                $c = 'Erro ao cadastrar anuncio!';
                break;
            case '5':
                $c = 'É necessário preencha todos os campos!';
                break;
            case '6':
                $c = 'Imagem excluída com sucesso!';
                break;
            default:
                $c = '';
                break;
        }
        return $c;
    }
}
