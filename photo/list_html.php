<?php
require(dirname(__FILE__).'/global.php');

//��Ŀ����
get_guide($fid);

unset($lfjuid,$web_admin,$lfjid,$lfjdb,$groupdb);

$groupdb=@include(ROOT_PATH."data/group/2.php");		//���ο����ݴ���

if(!is_writable(Mpath."cache/htm_cache/{$cacheid}_makelist.php")){
	showerr(Mpath."cache/htm_cache/{$cacheid}_makelist.php�ļ�������,���ļ�����д");
}

set_time_limit(0);

$fidDB=$db->get_one("SELECT * FROM {$_pre}sort WHERE fid='$fid'");
$fidDB[M_alias]='ͼƬ';
$fidDB[config]=unserialize($fidDB[config]);
$fidDB[descrip]=En_TruePath($fidDB[descrip],0);
//if($fidDB[type]==2){
//	$rsdb[content]=$fidDB[descrip];
//}

$fupId=intval($fidDB[type]?$fid:$fidDB[fup]);

//�����Ŀ����ģ��
if(is_file(html("$webdb[SideSortStyle]"))){
	$sortnameTPL=html("$webdb[SideSortStyle]");
}else{
	$sortnameTPL=html("side_sort/0");
}

//��Ŀ����ģ��
$aboutsortTPL=html("aboutsort_tpl/0");

//�������ʾ��ʽ
$fidDB[config][ListShowBigType] || $fidDB[config][ListShowBigType]=0;
unset($bigsortTPL);
if(!$fidDB[config][ListShowBigType]){
	$bigsortTPL=html("bigsort_tpl/mod_100");
}
if(!$bigsortTPL){
	$bigsortTPL=html("bigsort_tpl/0",ROOT_PATH."template/default/{$fidDB[config][ListShowBigType]}.htm");
}

//�����б���ʾ��ʽ.
$fidDB[config][ListShowType] || $fidDB[config][ListShowType]=0;
unset($listTPL);
if(!$fidDB[config][ListShowType]){
	$listTPL=html("list_tpl/mod_100");
}

if(!$listTPL){
	$listTPL=html("list_tpl/0",ROOT_PATH."template/default/{$fidDB[config][ListShowType]}.htm");
}

$atc_content='';


//��ת���ⲿ��ַ
if( $fidDB[jumpurl] ){
	$atc_content="<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$fidDB[jumpurl]'>";
	$atc_content=str_replace("?","?&",$atc_content);
}



//SEO
$titleDB[title]			= filtrate("$fidDB[name] - $webdb[webname]");
$titleDB[keywords]		= filtrate("$fidDB[metakeywords]  $webdb[metakeywords]");
$titleDB[description]	= filtrate("$fidDB[descrip]");

$fidDB[style] && $STYLE=$fidDB[style];

//����ͷ����β��
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

/*ģ��*/
$FidTpl=unserialize($fidDB[template]);
$FidTpl['head'] && $head_tpl=$FidTpl['head'];
$FidTpl['foot'] && $foot_tpl=$FidTpl['foot'];

/**
*��ȡ��ǩ����,����ģ����б�������$ch='2';$chtype=2,3,4,5,6,7,8,;
**/
$chdb[main_tpl]=getTpl("list",$FidTpl['list']);

/**
*��ǩ
**/
$ch_fid	= intval($fidDB[config][label_list]);		//�Ƿ�������Ŀר�ñ�ǩ
$ch_pagetype = 2;									//2,Ϊlistҳ,3,Ϊbencandyҳ
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//ϵͳ�ض�ID����,ÿ��ϵͳ������ͬ
$ch = 0;											//�������κ�ר��
require(ROOT_PATH."inc/label_module.php");





//��ʾ�ӷ���
$listdb_moresort=ListMoreSort();

//�б�ҳ������ͼƬ
$Lrows=$fidDB[maxperpage]?$fidDB[maxperpage]:($webdb[list_row]?$webdb[list_row]:20);



@extract($db->get_one("SELECT COUNT(aid) AS NUM FROM {$_pre}article WHERE fid=$fid AND yz=1"));














if($Ppage<1){
	$Ppage=1;
}
$Rows=20;
$Min=($Ppage-1)*$Rows;

//��ģ����չ�ӿ�
//@include(ROOT_PATH."inc/list_{$fidDB[fmid]}.php");

require(ROOT_PATH."inc/head.php");
$content_head=ob_get_contents();

ob_end_clean();
ob_start();
require(ROOT_PATH."inc/foot.php");
$content_foot=ob_get_contents();
ob_end_clean();
ob_start();
unset($ckk);
unset($lfjuid,$web_admin,$lfjid,$lfjdb);
for($I=$Min;$I<$Min+$Rows;$I++){
	$page=$I+1;
	if($page!=1&&$page>ceil($NUM/$Lrows)){
		break;
	}

	if( $fidDB[passwd] ){//��Ŀ����
		$atc_content="<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$Mdomain/list.php?page=$page&fid=$fid&NeedCheck=1'>";
	}elseif( $fidDB[allowviewtitle] || $fidDB[allowviewcontent] ){//���Ȩ��
		$atc_content="<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$Mdomain/list.php?page=$page&fid=$fid&NeedCheck=1'>";
	}else{
		$listdb=ListThisSort($Lrows,$webdb[ListLeng]?$webdb[ListLeng]:50);	//����ĿͼƬ�б�
		$listdb || $hide_listnews='none';				//����Ǵ����Ļ�,�Ͳ����ڱ���,�Ͱѱ��������
		$showpage=getpage("","","list.php?fid=$fid",$Lrows,$NUM);
	}

	ob_end_clean();
	ob_start();
	require($chdb[main_tpl]);


	
	$content=$atc_content?$atc_content:($content_head.ob_get_contents().$content_foot);
	$content=preg_replace("/<!--include(.*?)include-->/is","\\1",$content);
	$content=str_replace('<!---->','',$content);
	
	make_html($content,'list');
	$ckk++;
}
ob_end_clean();

require_once(Mpath."cache/htm_cache/{$cacheid}_makelist.php");
if($ckk)
{
	$Ppage++;
	//���������ɾ�̬,����Ҫ������״��
	if($JumpUrl){
		//�����һ����Ŀ�Ļ�,ֻ����ǰ��ҳ������
		if(is_numeric($allfid)){
			unlink(Mpath."cache/htm_cache/{$cacheid}_makelist.php");
			header("location:$JumpUrl");exit;
		}
		//header("location:?fid=$fid&Ppage=$Ppage&III=$III");exit;
	}
	write_file(Mpath."cache/htm_cache/{$cacheid}_makelist_record.php","?fid=$fid&Ppage=$Ppage&III=$III&cacheid=$cacheid");
	echo "���Ժ�,���������б�ҳ��̬...$Ppage<META HTTP-EQUIV=REFRESH CONTENT='0;URL=?fid=$fid&Ppage=$Ppage&III=$III&cacheid=$cacheid'>";
	exit;
}
else
{
	$III++;
	$Ppage=0;
	$fiddb=explode(",", $allfid);
	if($fid=$fiddb[$III]){
		//���������ɾ�̬,����Ҫ��״��
		if($JumpUrl){
			//header("location:?fid=$fid&Ppage=$Ppage&III=$III");exit;
		}
		write_file(Mpath."cache/htm_cache/{$cacheid}_makelist_record.php","?fid=$fid&Ppage=$Ppage&III=$III&cacheid=$cacheid");
		echo '<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />';
		echo "���Ժ�,���������б�ҳ��̬...$fid<META HTTP-EQUIV=REFRESH CONTENT='0;URL=?fid=$fid&Ppage=$Ppage&III=$III&cacheid=$cacheid'>";
		exit;
	}else{
		unlink(Mpath."cache/htm_cache/{$cacheid}_makelist_record.php");
		unlink(Mpath."cache/htm_cache/{$cacheid}_makelist.php");
		//���������ɾ�̬,����Ҫ��״��
		if($JumpUrl){
			header("location:$JumpUrl");exit;
		}
		echo '<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />';
		echo "�б���̬ҳ�������,������������ҳ<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$weburl'>";
		exit;
	}
}
?>