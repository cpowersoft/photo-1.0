<?php
function_exists('html') OR exit('ERR');

define('Mdirname', preg_replace("/(.*)\/([^\/]+)\/([^\/]+)/is","\\2",str_replace("\\","/",dirname(__FILE__))) );
define('Mpath', preg_replace("/(.*)\/([^\/]+)\/([^\/]+)/is","\\1/\\2/",str_replace("\\","/",dirname(__FILE__))) );

define('Madmindir', preg_replace("/(.*)\/([^\/]+)/is","\\2",str_replace("\\","/",dirname(__FILE__))) );

$Mpath = Mpath;
define('Adminpath',dirname(__FILE__).'/');

require(Mpath."data/config.php");
require(Mpath."data/all_fid.php");
require_once(Mpath."inc/artic_function.php");	//涉及到图片方面的函数

$Murl=$webdb[www_url].'/'.Mdirname;
$Mdomain=$ModuleDB[$webdb[module_pre]][domain]?$ModuleDB[$webdb[module_pre]][domain]:$Murl;

$_pre="{$pre}{$webdb[module_pre]}";					//数据表前缀

$groupdb=array_merge($groupdb,$groupdb["power_{$_pre}"]);	//权限特别处理

?>