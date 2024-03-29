<?php
require(dirname(__FILE__).'/global.php');
!$aid && $aid = intval($id);
$id = $aid;
$page<1 && $page=1;


$Cache_FileName=Mpath."cache/bencandy_cache/".floor($id/3000)."/{$id}_{$page}.php";
if(!$jobs&&$webdb[bencandy_cache_time]&&(time()-filemtime($Cache_FileName))<($webdb[bencandy_cache_time]*60)){
	echo read_file($Cache_FileName);
	exit;
}

get_guide($fid);	//栏目导航


/**
*获取图片
**/
$min=intval($page)-1;
$rsdb=$db->get_one("SELECT R.*,A.* FROM {$_pre}article A LEFT JOIN {$_pre}reply R ON A.aid=R.aid WHERE A.aid=$aid ORDER BY R.topic DESC,R.orderid ASC LIMIT $min,1");

if(!$rsdb){
	showerr("数据不存在!");
}elseif($fid!=$rsdb[fid]){
	showerr("FID有误");
}

/**
*栏目配置文件
**/
$fidDB=$db->get_one("SELECT * FROM {$_pre}sort WHERE fid='$fid'");
$fidDB[M_alias]='图片';
$fidDB[config]=unserialize($fidDB[config]);
$FidTpl=unserialize($fidDB[template]);

$fupId=intval($fidDB[type]?$fid:$fidDB[fup]);

//禁止访问动态页
if($webdb[Html_Type]==1&&$webdb[ForbidShowPhpPage]&&!$NeedCheck&&!$jobs){
	$detail=m_html_url();
	if(is_file(Mpath.$detail[_showurl])){
		header("location:$detail[showurl]");
		exit;
	}
}

/**
*图片检查
**/
check_article($rsdb);

//统计点击次数
$db->query("UPDATE {$_pre}article SET hits=hits+1,lastview='$timestamp' WHERE aid='$aid'");

//SEO
$titleDB[title]		= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
$titleDB[keywords]	= filtrate($rsdb[keywords]);
$rsdb[description] || $rsdb[description]=get_word(preg_replace("/(<([^<]+)>|	|&nbsp;|\n)/is","",$rsdb[content]),250);
$titleDB[description] = filtrate($rsdb[description]);



//图片风格
$STYLE = $rsdb[style] ? $rsdb[style] : ($fidDB[style] ? $fidDB[style] : $STYLE);

//相关栏目名称模板
if(is_file(html("$webdb[SideSortStyle]"))){
	$sortnameTPL=html("$webdb[SideSortStyle]");
}else{
	$sortnameTPL=html("side_sort/0");
}

/**
*模板选择
**/
//类似大旗那样,框架网页模板
if($rsdb[iframeurl])
{
	$head_tpl="template/default/none.htm";
	$main_tpl="template/default/none.htm";
	$foot_tpl="template/default/iframe.htm";
}
else
{
	$showTpl=unserialize($rsdb[template]);
	$head_tpl=$showTpl[head]?$showTpl[head]:$FidTpl['head'];
	$main_tpl=$showTpl[bencandy]?$showTpl[bencandy]:$FidTpl['bencandy'];
	$foot_tpl=$showTpl[foot]?$showTpl[foot]:$FidTpl['foot'];
}


//附件真实地址还原
$rsdb[content] = En_TruePath($rsdb[content],0,1);
require_once(ROOT_PATH."inc/encode.php");
//文件下载
//<div><a style="COLOR: red" href="http://1.com/upload_files/other/1_20070729020722_YmI=.rar" target=_blank p8name="p8download">点击下载</a></div>
$rsdb[content]=preg_replace("/<IMG src=\"([^\"]+)\" border=0><A href=\"([^\"]+)\" target=_blank>([^<>]+)<\/A>/eis","encode_fileurl('\\1','\\2','\\3')",$rsdb[content]);
$rsdb[content]=preg_replace("/<([^<>]+)href=\"([^\"]+)\"([^<>]+)p8name=\"p8download\"([^<>]*)>([^<>]+)<\/A>/eis","encode_fileurl('','\\2','\\5')",$rsdb[content]);


$rsdb[content]=show_keyword($rsdb[content]);	//突出显示关键字

$IS_BIZ && AvoidGather();	//防采集处理

$rsdb[posttime] = date("Y-m-d H:i:s",$rsdb[posttime]);

if($rsdb[copyfromurl]&&!strstr($rsdb[copyfromurl],"http://")){
	$rsdb[copyfromurl]="http://$rsdb[copyfromurl]";
}

//图片分布
$showpage = getpage("","","bencandy.php?fid=$fid&aid=$aid",1,$rsdb[pages]);

/**
*上一篇与下一篇,比较影响速度
**/
$nextdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid<'$id' AND fid='$fid' AND yz=1 ORDER BY aid DESC LIMIT 1");
$nextdb[subject]=get_word($nextdb[title],34);
$nextdb[picurl]=tempdir($nextdb[picurl]);
$backdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid>'$id' AND fid='$fid' AND yz=1 ORDER BY aid ASC LIMIT 1");
$backdb[subject]=get_word($backdb[title],34);
$backdb[picurl]=tempdir($backdb[picurl]);

//个性头部与尾部
$head_tpl=html('head');
$foot_tpl=html('foot');
if($webdb[IF_Private_tpl]==3){
	if(is_file(Mpath.$webdb[Private_tpl_head])){
		$head_tpl=Mpath.$webdb[Private_tpl_head];
	}
	if(is_file(Mpath.$webdb[Private_tpl_foot])){
		$foot_tpl=Mpath.$webdb[Private_tpl_foot];
	}
}

/**
*为获取标签参数
**/
$chdb[main_tpl]=getTpl("bencandy",$main_tpl);

/**
*标签
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//是否定义了栏目专用标签
$ch_pagetype = 3;									//2,为list页,3,为bencandy页
$ch_module = 0;										//图片模块,默认为0
$ch = 0;											//不属于任何专题
require(ROOT_PATH."inc/label_module.php");

$rsdb[picurl]=tempdir($rsdb[picurl]);

$webdb[AutoTitleNum] && $rsdb[pages]>1 && $rsdb[title]=Set_Title_PageNum($rsdb[title],$page);

if($rsdb[keywords]){
	unset($array);
	$detail=explode(" ",$rsdb[keywords]);
	foreach( $detail AS $key=>$value){
		$_value=urlencode($value);
		$array[]="<A HREF='search.php?type=keyword&keyword=$_value' target=_blank>$value</A>";
	}
	$rsdb[keywords]=implode(" ",$array);
}

//过滤不良词语
$rsdb[content]=replace_bad_word($rsdb[content]);
$rsdb[title]=replace_bad_word($rsdb[title]);
$rsdb[subhead]=replace_bad_word($rsdb[subhead]);

unset($Mrsdb);
$detail=explode("\n",$rsdb[photourl]);
foreach( $detail AS $value){
	list($_url,$_name)=explode("@@@",$value);
	$Mrsdb[photourl][name][]=$_name;
	$Mrsdb[photourl][url][]=tempdir($_url);
}

//多模型扩展接口
//@include(ROOT_PATH."inc/bencandy_{$rsdb[mid]}.php");

require(ROOT_PATH."inc/head.php");
require($chdb[main_tpl]);
require(ROOT_PATH."inc/foot.php");



if(!$jobs&&$webdb[bencandy_cache_time]&&(time()-filemtime($Cache_FileName))>($webdb[bencandy_cache_time]*60)){
	
	if(!is_dir(dirname($Cache_FileName))){
		makepath(dirname($Cache_FileName));
	}
	$content.="<SCRIPT LANGUAGE='JavaScript' src='$webdb[www_url]/do/job.php?job=updatehits&aid=$id'></SCRIPT>";
	write_file($Cache_FileName,$content);
}elseif($jobs=='show'){
	@unlink($Cache_FileName);
}

/**
*图片检查
**/
function check_article(&$rsdb){
	global $fidDB,$timestamp,$web_admin,$groupdb,$timestamp,$lfjid,$lfjuid,$fid,$id,$aid,$buy,$lfjdb,$webdb,$pre,$db;
	if(!$rsdb)
	{
		showerr("图片不存在");
	}
	//if( $fidDB[allowviewcontent]&&!in_array($fidDB[M_keyword],array('mv','download')) )
	if( $fidDB[allowviewcontent] )
	{
		if( !$web_admin&&!in_array($groupdb[gid],explode(",",$fidDB[allowviewcontent])) )
		{
			showerr("你所在用户组不允许浏览图片内容");
		}
	}
	
	//if( $rsdb[allowview]&&!in_array($fidDB[M_keyword],array('mv','download')) )
	if( $rsdb[allowview] )
	{
		if( !$web_admin&&!in_array($groupdb[gid],explode(",",$rsdb[allowview])) )
		{
			showerr("本文,你所在用户组不允许浏览图片内容");
		}
	}

	//设置了开始浏览日期限制
	if($rsdb[begintime]&&$timestamp<$rsdb[begintime])
	{
		$rsdb[begintime]=date("Y-m-d H:i:s",$rsdb[begintime]);
		if($web_admin){
			 Remind_msg("本文只有到了“{$rsdb[begintime]}”那个时间才可以查看,因为你是管理员,所以可以查看,其他人是不能查看的");
		}else{
			showerr("<font color='red' ><u>很抱歉,发布者设置了本文内容只有到了“{$rsdb[begintime]}”那个时间才可以查看</u></font>");
		}
	}

	//设置了失效浏览日期限制
	if($rsdb[endtime]&&$timestamp>$rsdb[endtime])
	{
		$rsdb[endtime]=date("Y-m-d H:i:s",$rsdb[endtime]);
		if($web_admin){
			 Remind_msg("本文内容最后查看期限是“{$rsdb[endtime]}”,因为你是管理员,所以可以查看,其他人是不能查看的");
		}else{
			showerr("<font color='red' ><u>很抱歉,发布者设置了本文内容最后查看期限是“{$rsdb[endtime]}”，现在已超过了这个期限，所以不能查看</u></font>");
		}
	}

	if($rsdb[yz]==2){
		if($web_admin){
			 Remind_msg("回收站的内容不可以查看,因为你是管理员,所以可以查看,其他人是不能查看的");
		}else{
			showerr("回收站的内容你不可以查看");
		}
	}
	//未审核
	if($rsdb[yz]==0&&(!$lfjid||$lfjuid!=$rsdb[uid]))
	{
		if($web_admin){
			 Remind_msg("本文还没通过验证,因为你是管理员,所以可以查看,其他人是不能查看的");
		}else{
			showerr("<font color='red' ><u>很抱歉,本文还没通过验证,你不能查看</u></font>");
		}
	}

	//定时发布
	if($rsdb[yz]==3&&$rsdb[begintime]>$timestamp)
	{
		if($web_admin){
			 Remind_msg("本文为定时发布,时间没到,不能查看,因为你是管理员,所以可以查看,其他人是不能查看的");
		}elseif($lfjuid&&$lfjuid==$rsdb[uid]){
			 Remind_msg("本文为定时发布,时间没到,不能查看,因为你是作者,所以可以查看,其他人是不能查看的");
		}else{
			showerr("<font color='red' ><u>本文为定时发布,时间没到,不能查看</u></font>");
		}
	}elseif($rsdb[yz]==3){
		corntab_post('DE',$rsdb[aid]);	//处理发布
	}

	//跳转到外面
	if($rsdb[jumpurl])
	{
		echo "页面正在跳转中，请稍候...<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$rsdb[jumpurl]'>";
		exit;
	}

	//图片密码
	if($rsdb[passwd])
	{
		if($web_admin)
		{
			 Remind_msg("本文设置了密码,因为你是管理员,所以可以查看,其他人是不能查看的");
		}
		else
		{
			if( $_POST[password] && $_POST[TYPE] == 'article'  )
			{
				if( $_POST[password] != $rsdb[passwd] )
				{
					echo "<A HREF=\"bencandy.php?fid=$fid&NeedCheck=1&aid=$aid\">密码不正确,点击返回</A>";
					exit;
				}
				else
				{
					setcookie("article_passwd_$id",$rsdb[passwd]);
					$_COOKIE["article_passwd_$id"]=$rsdb[passwd];
				}
			}
			if( $_COOKIE["article_passwd_$id"] != $rsdb[passwd] )
			{
				echo "<CENTER><form name=\"form1\" method=\"post\" action=\"\">请输入图片密码:<input type=\"password\" name=\"password\"><input type=\"hidden\" name=\"TYPE\" value=\"article\"><input type=\"hidden\" name=\"NeedCheck\" value=\"1\"><input type=\"submit\" name=\"Submit\" value=\"提交\"></form></CENTER>";
				exit;
			}
		}
	}

	//栏目密码
	if( $makehtml!=2 && $fidDB[passwd] )
	{
		if($web_admin)
		{
			 Remind_msg("本栏目设置了密码,因为你是管理员,所以可以查看,其他人是不能查看的");
		}
		else
		{
			if( $_POST[password] && $_POST[TYPE] == 'sort' )
			{
				if( $_POST[password] != $fidDB[passwd] )
				{
					echo "<A HREF=\"?fid=$fid&aid=$aid\">密码不正确,点击返回</A>";
					exit;
				}
				else
				{
					setcookie("sort_passwd_$fid",$fidDB[passwd]);
					$_COOKIE["sort_passwd_$fid"]=$fidDB[passwd];
				}
			}
			if( $_COOKIE["sort_passwd_$fid"] != $fidDB[passwd] )
			{
				echo "<CENTER><form name=\"form1\" method=\"post\" action=\"\">请输入栏目密码:<input type=\"password\" name=\"password\"><input type=\"hidden\" name=\"TYPE\" value=\"sort\"><input type=\"hidden\" name=\"NeedCheck\" value=\"1\"><input type=\"submit\" name=\"Submit\" value=\"提交\"></form></CENTER>";
				exit;
			}
		}
	}

	//积分处理 
	//if( ($rsdb[money]=abs($rsdb[money]))&&!in_array($fidDB[M_keyword],array('mv','download')) ){
	if( $rsdb[money]=abs($rsdb[money]) ){
		
		if($webdb[view_sell_article]){
			$content = preg_replace('/<([^<]*)>/is',"",$rsdb[content]);
			$num = floor(strlen($content)/3);
			$content = substr($content,0,$num);
		}
		
		if(!$lfjuid)
		{
			if($webdb[view_sell_article]){
				$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>请先登录,需要支付{$rsdb[money]}{$webdb[MoneyName]}才能查看全部内容</div>";
			}else{
				showerr("请先登录,需要支付{$rsdb[money]}{$webdb[MoneyName]}才能查看");
			}			
		}
		elseif($web_admin)
		{
			 Remind_msg("本文设置了收费,因为你是管理员,所以可以查看,其他人是不能查看的");
		}
		elseif($lfjuid==$rsdb[uid])
		{
			 Remind_msg("本文设置了收费,因为你是发布者,所以可以查看,其他人是不能查看的");
		}
		elseif( !strstr($rsdb[buyuser],",$lfjid,") )
		{
			$lfjdb[money]=get_money($lfjuid);
			if($lfjdb[money]<$rsdb[money])
			{
				if($webdb[view_sell_article]){
					$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>你的{$webdb[MoneyName]}不足$rsdb[money],不能查看全部内容</div>";
				}else{
					showerr("你的{$webdb[MoneyName]}不足$rsdb[money]");
				}
			}
			elseif($buy==1)
			{
				add_user($lfjuid,"-$rsdb[money]",'查看图片内容扣分');
				add_user($rsdb[uid],"$rsdb[money]",'图片被浏览奖分');
				$rsdb[buyuser]=$rsdb[buyuser]?",{$lfjid}{$rsdb[buyuser]}":",$lfjid,";
				$erp=get_id_table($id);
				$db->query("UPDATE {$_pre}article$erp SET buyuser='$rsdb[buyuser]' WHERE aid=$id");
				refreshto("bencandy.php?fid=$fid&NeedCheck=1&id=$id","购买成功,你刚刚消耗了{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}",3);
			}
			else
			{
				if($webdb[view_sell_article]){
					$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>你需要消耗{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}才有权限查看全部内容,是否继续<br><br>[<A HREF='bencandy.php?fid=$fid&buy=1&NeedCheck=1&id=$id'>我要继续</A>]</div>";
				}else{
					showerr("你需要消耗{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}才有权限查看,是否继续<br><br>[<A HREF='bencandy.php?fid=$fid&buy=1&NeedCheck=1&id=$id'>我要继续</A>]");
				}
			}
		}
	}
}
?>