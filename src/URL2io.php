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
    public function contentGet($url='', $fields=null, $callback=null)
    {
        if($url=='')
        {
            return '';
        }
        $url = urlencode($url);
        $params = array(
            'token' => $this->getToken(),
            'url' => $url
        );
        if($fields)
        {
            $params['fields'] = $fields;
        }
        if($callback)
        {
            $params['callback'] = $callback;
        }
        $paramStr = http_build_query($params, '', '&amp;');
        $queryUrl = $this->getApiUrl() . '?' . $paramStr;
        $result = @file_get_contents($queryUrl);
        
    }
}