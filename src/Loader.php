<?php

namespace xtfkpi\Imgloader;

class Loader
{
    static function get_image($url)
    {
        $uri = trim($url);
        $ex = explode('/', $url);
        $l = count($ex);
        $filename = $ex[$l - 1];
        $ex = explode(".", $filename);
        if (count($ex) < 2) exit("bad incoming file");
        $extension = strtolower($ex[1]);
        $image_extensions = ["jpg", "jpeg", "gif", 'png'];
        if (!in_array($extension, $image_extensions)) {
            throw new badFileExtensionException("bad image file extension");
        }
        $f = file_get_contents($url);
        if (!$f) {
            throw new remoteFileNotFoundException('image can not be found');
        }
        file_put_contents("../img/" . $filename, $f);
    }
}

class badFileExtensionException extends \Exception
{
}

class remoteFileNotFoundException extends \Exception
{
}

$url = 'https://hexa.com.ua/wp-content/themes/hexa/images/girl.jpg';
$rez = Loader::get_image($url);

