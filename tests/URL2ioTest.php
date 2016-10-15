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

    public function testContentGet()
    {
        $token = getenv('url2io_token');
        if(!$token)
        {
            return;
        }
        //get by curl
        $url2io_curl = new URL2io($token);
        $url = 'https://raw.githubusercontent.com/ety001/url2io/master/tests/testfile';//helloworld
        $t1 = $url2io_curl->contentGet($url);

        //get by file_get_contents
        $url2io_fgc = new URL2io($token);
        $t2 = $url2io_fgc->contentGet($url);

        //var_dump($t);die();
        if(isset($t1['content']))
        {
            $this->assertEquals($t1['content'], '<p>helloworld
</p>');
        }
        else
        {
            $this->assertEmpty(1);
        }

        if(isset($t2['content']))
        {
            $this->assertEquals($t2['content'], '<p>helloworld
</p>');
        }
        else
        {
            $this->assertEmpty(1);
        }
    }

}