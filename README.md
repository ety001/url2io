URL2io PHP SDK
==============

[![Build Status](https://travis-ci.org/ety001/url2io.svg?branch=master)](https://travis-ci.org/ety001/url2io)

## URL2io 官网文档

<http://www.url2io.com/docs>

## 使用说明

### composer 安装

```
composer require "ety001/url2ioPHPSDK"
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

