<?php
namespace ETY001\URL2io;

class URL2io
{
    private $token;
    private $apiUrl;

    /**
     * http methods
     */
    const GET = 'GET';
    const POST = 'POST';

    /**
     * curl链接资源
     */
    protected $curl;
    protected $isCurl;

    public function __construct($token='', $isCurl = true)
    {
        if($token=='')
        {
            throw new Exception("Need token", 1);
        }
        $this->setToken($token);
        $this->setApiUrl('http://api.url2io.com/article');
        $this->isCurl = $isCurl;
        //$this->setApiUrl('http://api.url2io.com/demo/article');
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
        if($this->isCurl)
        {
            //curl
            $result = json_decode($this->request($queryUrl), true);
        }
        else
        {
            //file_get_contents
            $result = json_decode(file_get_contents($queryUrl), true);
        }
        
        //To do: 处理原始数据
        if($isOrigin)
        {
            return $result;
        }
        return $result;
    }

    /**
     * Make a HTTP request.
     *
     * @param string url
     * @param string $method
     * @param array  $params
     * @param array  $data
     *
     * @return array
     */
    protected function request($url, $params = array(),$data = '', $method = self::GET, $charset='utf-8')
    {   
        //初始化链接
        $this->curl = curl_init();
        //请求参数
        $default = array();
        //构造请求参数
        $query = http_build_query(array_merge($default, $params));

        $url = $url . "?" . $query;

        //设置header头
        $header = array(
            "Content-type: text/plain;charset={$charset}"
        );
        curl_setopt($this->curl, CURLOPT_HEADER, 1);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER,$header);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_URL, $url);

        if($method === self::POST && !empty($data)){ 
            curl_setopt($this->curl, CURLOPT_POST, 1);//post提交方式
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            throw new \Exception(curl_error($this->curl), 1);
        }
        //分解响应
        $response = $this->splitHeaders($response);

        //关闭cURL资源，并且释放系统资源
        curl_close($this->curl);

        return $response;
    }

    /**
     * Split the HTTP headers.
     *
     * @param string $rawHeaders
     *
     * @return array
     */
    protected function splitHeaders($rawHeaders)
    {
        $headers = array();
        $lines = explode("\n", trim($rawHeaders));
        $headers['HTTP'] = array_shift($lines);
        foreach ($lines as $h) {
            $h = explode(':', $h, 2);
            if (isset($h[1])) {
                $headers[$h[0]] = trim($h[1]);
            }
        }

        // 获得响应结果里的：头大小
        $headerSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        // 根据头大小去获取消息体内容
        $body = substr($rawHeaders, $headerSize);
        return $body;
    }

}