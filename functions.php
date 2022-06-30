<?php
require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

function uploadImagens($diretorio, $imagem, $extensao, $largura, $altura = null) {
    if( !is_dir($diretorio) )
            mkdir($diretorio, 0777, true);

        $name = uniqid(date('HisYmd'));
        $rand = mt_rand();

        $name_file = "{$rand}_{$name}.{$extensao}";


        if ( $altura )
            $recebe_imagem = Image::make($imagem)->crop($largura, $altura);
        else {
            $recebe_imagem = Image::make($imagem)->resize($largura, $altura, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $recebe_imagem->save($diretorio . $name_file, 85);

        return $name_file;
}