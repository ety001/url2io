<?php
 
use ETY001\URL2io\URL2io;
 
class URL2ioTest extends PHPUnit_Framework_TestCase
{
    public function testSetToken()
    {
        $url2io = new URL2io('test_token');
        $url2io->setToken('oktoken');
        $this->assertTrue($url2io->getToken());
    }
 
}