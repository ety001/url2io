<?php
 
use ETY001\URL2io\URL2io;
 
class URL2ioTest extends PHPUnit_Framework_TestCase
{
    private $token;

    public function __construct()
    {
        $this->token = 'test_token';
    }

    public function testGetToken()
    {
        $url2io = new URL2io($this->token);
        $this->assertEquals($url2io->getToken(), $this->token);
    }

    public function testSetToken()
    {
        $url2io = new URL2io($this->token);
        $url2io->setToken('oktoken');
        $this->assertEquals($url2io->getToken(), 'oktoken');
    }

    public function testGetApiUrl()
    {
        $url2io = new URL2io($this->token);
        $this->assertEquals($url2io->getApiUrl(), 'http://api.url2io.com/article');
    }

    public function testSetApiUrl()
    {
        $url2io = new URL2io($this->token);
        $url2io->setApiUrl('test_api_url');
        $this->assertEquals($url2io->getApiUrl(), 'test_api_url');
    }

    public function testBuildQuery()
    {
        $url2io = new URL2io($this->token);
        $params = array('a'=>1, 'b'=>2);
        $u = $url2io->buildQuery($params);
        $this->assertEquals($u, $url2io->getApiUrl().'?a=1&amp;b=2');
    }
/*
    public function testContentGet()
    {
        $url2io = new URL2io('nXMp2CFOT825EKHEEsZ_KQ');
        $url = 'https://raw.githubusercontent.com/ety001/url2io/master/tests/testfile';//helloworld
        $t = $url2io->contentGet($url);
        var_dump($t);die();
    }
*/
}