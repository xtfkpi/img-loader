<?php
/**
 * This class alows to download image files
 */
declare(strict_types = 1);
namespace xtfkpi\Imgloader;
//error_reporting(E_ALL);

class Loader
{
    /**
     * @param string $url of image to download
     * @throws badFileExtensionException
     * @throws remoteFileNotFoundException
     * @return boolean
     */
    static function get_image($url)
    {
        $url = trim($url);
        $ex = explode('/', $url);
        $l = count($ex);
        $filename = $ex[$l - 1];
        $ex = explode(".", $filename);
        if (count($ex) < 2)
            throw new badFilenameException("bad image file");;
        $extension = strtolower($ex[1]);
        $image_extensions = ["jpg", "jpeg", "gif", 'png'];
        if (!in_array($extension, $image_extensions))
            throw new badFilenameException("bad image file");
        @$f = file_get_contents($url);
        if (!$f) {
            throw new remoteFileNotFoundException("image $url can not be found");
        }
        $folder = "img/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        file_put_contents($folder . $filename, $f);
        return true;
    }
}

class badFilenameException extends \Exception
{
}

class remoteFileNotFoundException extends \Exception
{
}

