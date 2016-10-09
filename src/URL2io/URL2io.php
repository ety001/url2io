<?php
namespace ETY001\URL2io;

class URL2io
{
    private $token;
    private $apiUrl;

    public function __construct($token='')
    {
        if($token=='')
        {
            throw new Exception("Need token", 1);
        }
        $this->setToken($token);
        $this->setApiUrl('http://api.url2io.com/article');
    }

    public function setToken($token='')
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setApiUrl($url='')
    {
        $this->apiUrl = $url;
    }

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * $fields: text, next
     */
    public function contentGet($url='', $fields=null)
    {
        if($url=='')
        {
            return '';
        }
    }
}