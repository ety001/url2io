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

    public function buildQuery($params=array())
    {
        $paramStr = http_build_query($params, '', '&amp;');
        $queryUrl = $this->getApiUrl() . '?' . $paramStr;
        return $queryUrl;
    }

    /**
     * $fields: text, next
     */
    public function contentGet($url='', $fields=null, $callback=null, $isOrigin=true)
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
        $queryUrl = $this->buildQuery($params);
        //var_dump($queryUrl);die();
        $result = file_get_contents($queryUrl);
        //To do: 处理原始数据
        if($isOrigin)
        {
            return $result;
        }
    }
}