<?php
/**
 * phpunit tests
 */
declare(strict_types = 1);
require_once "vendor/autoload.php";
use PHPUnit\Framework\TestCase;
use xtfkpi\Imgloader\Loader;

class LoaderTest extends TestCase
{
    function testGoodURL()
    {
        $rez = Loader::get_image(
            'https://hexa.com.ua/wp-content/themes/hexa/images/girl.jpg');
        $this->assertTrue($rez);
    }

    function testBadFilename()
    {
        $this->expectException(
            xtfkpi\Imgloader\badFilenameException::class
        );
        Loader::get_image('');
    }

    function testNoImageFile()
    {
        $this->expectException(
            xtfkpi\Imgloader\remoteFileNotFoundException::class
        );
        Loader::get_image(
            'https://hexa.com.ua/wp-content/themes/hexa/images/boy.jpg');
    }
}
