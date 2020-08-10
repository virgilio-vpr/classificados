<?php

namespace App\Libraries;

class Fotos
{
    public function __construct()
    {
        helper('filesystem');
    }
    public function checkFoto($img)
    {
        if ($img->isValid() && !$img->hasMoved()) {
            $fileType = $img->getMimeType();
            if ($fileType == 'image/jpeg' || $fileType == 'image/png') {
                if ($img->getSize() < 1000000) {
                    $newName = $img->getRandomName();
                    $img->move(WRITEPATH . 'uploads', $newName);

                    $path1 = $img->getTempName();
                    $path2 = $_SERVER['DOCUMENT_ROOT'] . '/classificados/public/assets/images/anuncios/';
                    $nome1 = $img->getName();
                    $nome2 = $img->getRandomName();

                    list($width_orig, $height_orig) = getimagesize($path1 . $nome1);

                 
                    if ($height_orig >= $width_orig) {
                        \Config\Services::image()
                            ->withFile($path1 . $nome1)
                            ->resize(500, 500, true, 'height')
                            ->save($path2 . $nome2, 80);
                    } else {
                        \Config\Services::image()
                            ->withFile($path1 . $nome1)
                            ->resize(500, 500, true, 'width')
                            ->save($path2 . $nome2, 80);
                    }
                    delete_files($path1);

                    

                    $result = [
                        'url'  => 'public/assets/images/anuncios/' . $nome2,
                        'code' => '0'
                    ];
                    return $result;
                } else {
                    $result = [
                        'code' => '1'
                    ];
                    return $result;
                }
            } else {
                $result = [
                    'code' => '2'
                ];
                return $result;
            }
        } else {
            $result = [
                'code' => '3'
            ];
            return $result;
        }
    }

    public function excluirFoto($url_foto)
    {
        if (file_exists('/opt/lampp/htdocs/classificados/' . $url_foto)) {
            unlink('/opt/lampp/htdocs/classificados/' . $url_foto);
        } else {
            return false;
        }
        return true;
    }
}
