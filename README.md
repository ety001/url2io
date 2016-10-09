URL2io PHP SDK
==============

[![Build Status](https://travis-ci.org/ety001/url2io.svg?branch=master)](https://travis-ci.org/ety001/url2io)

## URL2io 官网文档

<http://www.url2io.com/docs>

## 使用说明

### composer 安装

```
composer require ety001/url2io-phpsdk
```

### 在项目中使用

```
<?php
use ETY001\URL2io\URL2io;
$token = 'Your token';
$url2io = new URL2io($token);
$url = 'the url you want to grab';
$result = $url2io->contentGet($url);
?>
```

## 其他

### 待完善

* 是否由库来处理返回的结果，还是交给用户处理
* 完善错误处理机制

### 协议

MIT

### 联系方式

Email: <ety002@gmail.com>

Blog: <http://www.domyself.me>