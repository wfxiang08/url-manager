<?php

// 先申明, 并不需要马上就能搜索到
use Thrift\ClassLoader\ThriftClassLoader;

/** @var ThriftClassLoader $thrift_loader */
$thrift_loader = null;

// 只创建一个ThriftClassLoader
if (!isset($GLOBALS["thrift_loader"])) {
  $thrift_loader = new ThriftClassLoader();
  $thrift_loader->register();
  $GLOBALS["thrift_loader"] = $thrift_loader;
} else {
  $thrift_loader = $GLOBALS["thrift_loader"];
}

//
// registerNamespace vs. registerDefinition
// 1. 前者只处理namespace的匹配, 剩下的部分靠文件路径来匹配
// 2. 后者假设代码符合thrift服务的代码格式,
//    ServiceName.php --> ServiceNameIf, ServiceNameClient...
//    Types.php
$thrift_loader->registerDefinition('UrlManager', [__DIR__]);