<?php
require(dirname(__FILE__).'/global.php');

$Cache_FileName=Mpath."cache/showsp_cache/$id.php";
if(!$jobs&&$webdb[showsp_cache_time]&&(time()-filemtime($Cache_FileName))<($webdb[showsp_cache_time]*60)){
	echo read_file($Cache_FileName);
	exit;
}

@include(Mpath."data/special_guide_fid.php");		//专题栏目配置文件



//导航条
$GuideFid[$fid]=str_replace("list.php?fid=","listsp.php?fid=",$GuideFid[$fid]);
if(!$GuideFid[$fid]){
	$GuideFid[$fid]="<A HREF='$webdb[www_url]'>&gt;&gt;返回首页</A>";
}


$rsdb=$db->get_one("SELECT * FROM {$_pre}special WHERE id='$id'");
$fid=$rsdb[fid];
if(!$rsdb){
	showerr("数据不存在!");
}elseif($rsdb[yz]!=1){
	if(!$web_admin&&$lfjuid!=$rsdb[uid]){
		showerr("还没有通过审核");
	}
}

/**
*栏目配置文件
**/
$fidDB=$db->get_one("SELECT * FROM {$_pre}spsort WHERE fid='$fid'");
$fidDB[config]=unserialize($fidDB[config]);
$FidTpl=unserialize($fidDB[template]);

//强制跳转到静态页
if($webdb[ForbidShowPhpPage]&&!$NeedCheck&&!$jobs){
	$detail=get_m_SPhtml_url($fidDB,$id,$rsdb[posttime]);
	if(is_file(Mpath.$detail[_showurl])){
		header("location:$detail[_showurl]");
		exit;
	}
}

//风格
$STYLE = $rsdb[style] ? $rsdb[style] : ($fidDB[style] ? $fidDB[style] : $STYLE);

/**
*模板选择
**/
$showTpl=unserialize($rsdb[template]);
$head_tpl=$showTpl[head]?$showTpl[head]:$FidTpl['head'];
$main_tpl=$showTpl[bencandy]?$showTpl[bencandy]:$FidTpl['bencandy'];
$foot_tpl=$showTpl[foot]?$showTpl[foot]:$FidTpl['foot'];

$chdb[main_tpl]=getTpl("showsp",$main_tpl);			//获取标签参数

$ch_fid	= intval($id);								//每个专题的标签不一样
$ch_pagetype = 11;									//2,为list页,3,为bencandy页
$ch_module = $webdb[module_id];						//文章模块,默认为0
$ch = 0;											//不属于任何专题
require(ROOT_PATH."inc/label_module.php");

unset($_listdb,$_picdb,$listdb,$picdb);
//专题里的文章
if($rsdb[aids])
{
	$query = $db->query("SELECT A.*,D.content FROM  {$_pre}article A  LEFT JOIN {$_pre}reply D ON D.aid=A.aid WHERE D.topic=1 AND D.aid IN ($rsdb[aids])");
	while($rs = $db->fetch_array($query)){
		$rs[content]=preg_replace('/<([^<]*)>/is',"",$rs[content]);	//把HTML代码过滤掉
		$rs[content]=preg_replace('/ |　|&nbsp;/is',"",$rs[content]);	//把多余的空格去除掉
		$rs[url]="$Mdomain/bencandy.php?fid=$rs[fid]&id=$rs[aid]";
		$rs[subject]="<a href='$rs[url]' target=_blank>$rs[title]</a>";
		$_listdb[$rs[aid]]=$rs;
	}

	//图片主题
	$query = $db->query("SELECT * FROM {$_pre}article WHERE aid IN ($rsdb[aids]) AND ispic=1");
	while($rs = $db->fetch_array($query)){
		$rs[url]="$Mdomain/bencandy.php?fid=$rs[fid]&id=$rs[aid]";
		$rs[subject]="<a href='$rs[url]' target=_blank>$rs[title]</a>";
		$rs[picurl]=tempdir($rs[picurl]);
		$_picdb[$rs[aid]]=$rs;
	}
	$aidsdb=explode(",",$rsdb[aids]);
	foreach($aidsdb AS $key=>$value){
		if($_listdb[$value]){
			$listdb[]=$_listdb[$value];
		}
		if($_picdb[$value]){
			$picdb[]=$_picdb[$value];
		}
	}
}

if($rsdb[tids])
{
	unset($_listdb,$_picdb);
	if(ereg("^pwbbs",$webdb[passport_type]))
	{
		$query = $db->query("SELECT * FROM {$TB_pre}threads WHERE tid IN ($rsdb[tids])");
		while($rs = $db->fetch_array($query)){
			$rs[url]="$webdb[passport_url]/read.php?tid=$rs[tid]";
			$rs[title]=$rs[subject];
			$rs[subject]="<a href='$rs[url]' target=_blank>$rs[subject]</a>";
			$_listdb[$rs[tid]]=$rs;
		}
		//图片主题
		$query = $db->query("SELECT A.*,Att.attachurl FROM {$TB_pre}attachs Att LEFT JOIN {$TB_pre}threads A ON Att.tid=A.tid WHERE A.tid IN ($rsdb[tids]) AND Att.type='img' GROUP BY tid");
		while($rs = $db->fetch_array($query)){
			$rs[url]="$webdb[passport_url]/read.php?tid=$rs[tid]";
			$rs[title]=$rs[subject];
			$rs[picurl]=tempdir($rs[attachurl],'pwbbs');
			$rs[subject]="<a href='$rs[url]' target=_blank>$rs[subject]</a>";
			$_picdb[$rs[tid]]=$rs;
		}
	}
	elseif(ereg("^dzbbs",$webdb[passport_type]))
	{
		$query = $db->query("SELECT * FROM {$TB_pre}threads WHERE tid IN ($rsdb[tids])");
		while($rs = $db->fetch_array($query)){
			$rs[url]="$webdb[passport_url]/viewthread.php?tid=$rs[tid]";
			$rs[title]=$rs[subject];
			$rs[subject]="<a href='$rs[url]' target='_blank'>$rs[subject]</a>";
			$_listdb[$rs[tid]]=$rs;
		}
		//图片主题
		$query = $db->query("SELECT A.*,Att.attachment FROM {$TB_pre}attachments Att LEFT JOIN {$TB_pre}threads A ON Att.tid=A.tid WHERE A.tid IN ($rsdb[tids]) AND Att.isimage='1' GROUP BY Att.tid");
		while($rs = $db->fetch_array($query)){
			$rs[url]="$webdb[passport_url]/viewthread.php?tid=$rs[tid]";
			$rs[title]=$rs[subject];
			$rs[picurl]=tempdir($rs[attachment],'dzbbs');
			$rs[subject]="<a href='$rs[url]' target='_blank'>$rs[subject]</a>";
			$_picdb[$rs[tid]]=$rs;
		}
	}
	$tidsdb=explode(",",$rsdb[tids]);
	foreach($tidsdb AS $key=>$value){
		if($_listdb[$value]){
			$listdb[]=$_listdb[$value];
		}
		if($_picdb[$value]){
			$picdb[]=$_picdb[$value];
		}
	}
}

if(!$listdb){
	$listdb[]=array("subject"=>"本专题暂无文章,请管理员在后台添加文章");
}

//统计点击次数
$db->query("UPDATE {$_pre}special SET hits=hits+1,lastview='$timestamp' WHERE id='$id'");


//SEO
$titleDB[title]			= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
$titleDB[keywords]		= filtrate("$rsdb[keywords] $webdb[metakeywords]");
$rsdb[description]		= get_word(preg_replace("/(<([^<]+)>|	|&nbsp;|\n)/is","",$rsdb[content]),250);
$titleDB[description]	= filtrate($rsdb[description]);




//附件真实地址还原
$rsdb[content] = En_TruePath($rsdb[content],0);
$rsdb[content] = str_replace("\n","<br>",$rsdb[content]);

$rsdb[posttime] = date("Y-m-d H:i:s",$rsdb[posttime]);
$rsdb[picurl] && $rsdb[picurl] = tempdir($rsdb[picurl]);

require(ROOT_PATH."inc/head.php");
require(getTpl("showsp",$main_tpl));
require(ROOT_PATH."inc/foot.php");

$content=ob_get_contents();
ob_end_clean();
ob_start();
if($webdb[www_url]=='/.'){
	$content=str_replace('/./','/',$content);
}
echo $content;


if(!$jobs&&$webdb[showsp_cache_time]&&(time()-filemtime($Cache_FileName))>($webdb[showsp_cache_time]*60)){
	$content=ob_get_contents();
	if(!is_dir(dirname($Cache_FileName))){
		makepath(dirname($Cache_FileName));
	}
	write_file($Cache_FileName,$content);
}elseif($jobs=='show'){
	@unlink($Cache_FileName);
}

?>