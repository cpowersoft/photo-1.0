<?php
require(dirname(__FILE__).'/global.php');
$page<1 && $page=1;


$Cache_FileName=Mpath."cache/list_cache/{$fid}_{$page}.php";
if(!$jobs&&$webdb[list_cache_time]&&(time()-filemtime($Cache_FileName))<($webdb[list_cache_time]*60)){
	echo read_file($Cache_FileName);
	exit;
}

get_guide($fid);	//栏目导航


if(!$fid){
	showerr("栏目FID不存在");
}

//栏目配置文件
$fidDB=$db->get_one("SELECT * FROM {$_pre}sort WHERE fid='$fid'");
if(!$fidDB){
	showerr("栏目ID有误");
}
$fidDB[M_alias]='图片';
$fidDB[config]=unserialize($fidDB[config]);
$fidDB[descrip]=En_TruePath($fidDB[descrip],0);
//if($fidDB[type]==2){
//	$rsdb[content]=$fidDB[descrip];
//}

$fupId=intval($fidDB[type]?$fid:$fidDB[fup]);

//禁止访问动态页
if($webdb[Html_Type]==1&&$webdb[ForbidShowPhpPage]&&!$NeedCheck&&!$jobs){
	$detail=m_html_url();
	if(is_file(Mpath.$detail[_listurl])){
		header("location:$detail[listurl]");
		exit;
	}
}

/**
*栏目配置文件检查
**/
check_fid($fidDB);

//SEO
$titleDB[title]			= filtrate("$fidDB[name] - $webdb[webname]");
$titleDB[keywords]		= filtrate("$fidDB[metakeywords]  $webdb[metakeywords]");
$titleDB[description]	= filtrate("$fidDB[descrip]");



//显示子分类
$listdb_moresort=ListMoreSort();

//列表页多少篇图片,栏目设置的话.以栏目为标准,否则与系统为标准,系统不存在就默认20
$rows=$fidDB[maxperpage]?$fidDB[maxperpage]:($webdb[list_row]?$webdb[list_row]:20);	

$listdb=ListThisSort($rows,$webdb[ListLeng]?$webdb[ListLeng]:50);		//本栏目图片列表

//图片列表分页
//$page_sql=$webdb[viewNoPassArticle]?'':' AND yz=1 ';
$RS=$db->get_one("SELECT FOUND_ROWS()");
$showpage=getpage('','',"list.php?fid=$fid",$rows,$RS['FOUND_ROWS()']);


//相关栏目名称模板
if(is_file(html("$webdb[SideSortStyle]"))){
	$sortnameTPL=html("$webdb[SideSortStyle]");
}else{
	$sortnameTPL=html("side_sort/0");
}

//栏目介绍模板
$aboutsortTPL=html("aboutsort_tpl/0");


//大分类显示方式
$fidDB[config][ListShowBigType] || $fidDB[config][ListShowBigType]=0;
unset($bigsortTPL);
if(!$fidDB[config][ListShowBigType]){
	$bigsortTPL=html("bigsort_tpl/mod_100");
}
if(!$bigsortTPL){
	$bigsortTPL=html("bigsort_tpl/0",ROOT_PATH."template/default/{$fidDB[config][ListShowBigType]}.htm");
}


//内容列表显示方式.
$fidDB[config][ListShowType] || $fidDB[config][ListShowType]=0;
unset($listTPL);
if(!$fidDB[config][ListShowType]){
	$listTPL=html("list_tpl/mod_100");
}

if(!$listTPL){
	$listTPL=html("list_tpl/0",ROOT_PATH."template/default/{$fidDB[config][ListShowType]}.htm");
}

 

//以栏目风格为标准
$fidDB[style] && $STYLE=$fidDB[style];

//个性头部与尾部
$head_tpl=html('head');
$foot_tpl=html('foot');
if($webdb[IF_Private_tpl]==2||$webdb[IF_Private_tpl]==3){
	if(is_file(Mpath.$webdb[Private_tpl_head])){
		$head_tpl=Mpath.$webdb[Private_tpl_head];
	}
	if(is_file(Mpath.$webdb[Private_tpl_foot])){
		$foot_tpl=Mpath.$webdb[Private_tpl_foot];
	}
}

/*模板*/
$FidTpl=unserialize($fidDB[template]);
$FidTpl['head'] && $head_tpl=$FidTpl['head'];
$FidTpl['foot'] && $foot_tpl=$FidTpl['foot'];

/**
*为获取标签参数
**/
$chdb[main_tpl]=getTpl("list",$FidTpl['list']);

/**
*标签
**/
$ch_fid	= intval($fidDB[config][label_list]);		//是否定义了栏目专用标签
$ch_pagetype = 2;									//2,为list页,3,为bencandy页
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//系统特定ID参数,每个系统不能雷同
$ch = 0;											//不属于任何专题
require(ROOT_PATH."inc/label_module.php");

//多模型扩展接口
//@include(ROOT_PATH."inc/list_{$fidDB[fmid]}.php");

require(ROOT_PATH."inc/head.php");
require($chdb[main_tpl]);
require(ROOT_PATH."inc/foot.php");




if(!$jobs&&$webdb[list_cache_time]&&(time()-filemtime($Cache_FileName))>($webdb[list_cache_time]*60)){
	
	if(!is_dir(dirname($Cache_FileName))){
		makepath(dirname($Cache_FileName));
	}
	write_file($Cache_FileName,$content);
}elseif($jobs=='show'){
	@unlink($Cache_FileName);
}


/**
*栏目配置文件检查
**/
function check_fid($fidDB){
	global $web_admin,$groupdb,$fid;
	if(!$fidDB)
	{
		showerr("栏目不存在");
	}

	//跳转到外部地址
	if( $fidDB[jumpurl] )
	{
		header("location:$fidDB[jumpurl]");
		exit;
	}

	//栏目密码
	if( $fidDB[passwd] )
	{
		if( $_POST[password] )
		{
			if( $_POST[password] != $fidDB[passwd] )
			{
				echo "<A HREF=\"?fid=$fid\">密码不正确,点击返回</A>";
				exit;
			}
			else
			{
				setcookie("sort_passwd_$fid",$fidDB[passwd]);
				$_COOKIE["sort_passwd_$fid"]=$fidDB[passwd];
			}
		}
		if( $_COOKIE["sort_passwd_$fidDB[fid]"] != $fidDB[passwd] )
		{
			echo "<CENTER><form name=\"form1\" method=\"post\" action=\"\">请输入栏目密码:<input type=\"password\" 	name=\"password\"><input type=\"submit\" name=\"Submit\" value=\"提交\"></form></CENTER>";
			exit;
		}
	}

	if( $fidDB[allowviewtitle] || $fidDB[allowviewcontent] )
	{
		if(!$web_admin&&!in_array($groupdb[gid],explode(",","$fidDB[allowviewtitle],$fidDB[allowviewcontent]")))
		{
			showerr("你所在用户组不允许浏览标题");
		}
	}
}

?>