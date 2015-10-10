<?php
!function_exists('html') && exit('ERR');

@include_once(ROOT_PATH."data/label_hf.php");		//��ǩͷ����ײ����������ļ�
@include_once(Mpath."data/all_fid.php");		//ȫ����Ŀ�����ļ�

require_once(Mpath."inc/artic_function.php");		//�漰��ͼƬ����ĺ���

unset($lfjuid,$web_admin,$lfjid,$lfjdb,$groupdb,$bencandy_foot,$bencandy_head);
$groupdb=@include( ROOT_PATH."data/group/2.php");		//���ο���ݴ���

require_once(ROOT_PATH."inc/encode.php");
set_time_limit(0);

//�����Ŀ����ģ��
if(is_file(html("$webdb[SideSortStyle]"))){
	$sortnameTPL=html("$webdb[SideSortStyle]");
}else{
	$sortnameTPL=html("side_sort/0");
}

if($aid){
	$ASQL=" AND aid='$aid' ";
}else{
	$ASQL=" ";
}
if(is_array($bfid_array)){
	$SQL=" WHERE fid IN (".implode(',',$bfid_array).") ";
}elseif(is_numeric($bfid)){
	$SQL=" WHERE fid='$bfid' ";
}else{
	$SQL=" ";
}

//ͷ����β��
$head_tpl=html('head');
$foot_tpl=html('foot');

$query_fid = $db->query("SELECT * FROM {$_pre}sort $SQL");
while($fidDB = $db->fetch_array($query_fid)){

$fid = $fidDB[fid];
get_guide($fid);	//��Ŀ����
$fidDB[M_alias]='ͼƬ';
$fidDB[config]=unserialize($fidDB[config]);
$FidTpl=unserialize($fidDB[template]);
$fupId=intval($fidDB[type]?$fid:$fidDB[fup]);
$erp=$Fid_db[iftable][$fid]?$Fid_db[iftable][$fid]:'';

$Frows = 100;	//����ֵ����̫��,����������ڴ�֧�ֲ���
$steps = 0;

do{

$ifdo = false;
$steps++;
$min = ($steps-1)*$Frows;
$query_id = $db->query("SELECT * FROM {$_pre}article WHERE fid=$fid $ASQL ORDER BY aid DESC LIMIT $min,$Frows");
while($rsdb = $db->fetch_array($query_id)){
	$ifdo = true;
	$aid = $id = $rsdb[aid];
	$titleDB[title]		= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
	$titleDB[keywords]	= filtrate($rsdb[keywords]);
	$rsdb[description] || $rsdb[description]=get_word(preg_replace("/(<([^<]+)>|	|&nbsp;|\n)/is","",$rsdb[content]),250);
	$titleDB[description] = filtrate($rsdb[description]);

	if( $fidDB[allowviewcontent] || ($rsdb[begintime]&&$timestamp<$rsdb[begintime]) || ($rsdb[endtime]&&$timestamp>$rsdb[endtime]) || $rsdb[yz]!=1 || ($rsdb[passwd]||$fidDB[passwd]) || $rsdb[allowview] || $rsdb[jumpurl] || $rsdb[money] ){		
		$bencandy_content="<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$Mdomain/bencandy.php?&fid=$fid&id=$id&NeedCheck=1'>";
	}else{
		$bencandy_content='';
	}

	$STYLE = $rsdb[style] ? $rsdb[style] : ($fidDB[style] ? $fidDB[style] : $STYLE);

	if($rsdb[iframeurl]){	
		$head_tpl="template/default/none.htm";
		$main_tpl="template/default/none.htm";
		$foot_tpl="template/default/iframe.htm";
	}else{	
		$showTpl=unserialize($rsdb[template]);		
		$main_tpl=$showTpl[bencandy]?$showTpl[bencandy]:$FidTpl['bencandy'];
		$FidTpl['head'] && $head_tpl=$FidTpl['head'];
		$showTpl['head'] && $head_tpl=$showTpl['head'];
		$FidTpl['foot'] && $foot_tpl=$FidTpl['foot'];
		$showTpl['foot'] && $foot_tpl=$showTpl['foot'];
	}
	//����ͷ����β��
	if($webdb[IF_Private_tpl]==3){
		if(is_file(Mpath.$webdb[Private_tpl_head])){
			$head_tpl=Mpath.$webdb[Private_tpl_head];
		}
		if(is_file(Mpath.$webdb[Private_tpl_foot])){
			$foot_tpl=Mpath.$webdb[Private_tpl_foot];
		}
	}
	$rsdb[posttime]=date("Y-m-d H:i:s",$rsdb[full_posttime]=$rsdb[posttime]);
	if($rsdb[copyfromurl]&&!strstr($rsdb[copyfromurl],"http://")){
		$rsdb[copyfromurl]="http://$rsdb[copyfromurl]";
	}

	//��һƪ����һƪ
	$nextdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid<'$id' AND fid='$fid' AND yz=1 ORDER BY aid DESC LIMIT 1");
	$nextdb[subject]=get_word($nextdb[title],34);
	$nextdb[picurl]=tempdir($nextdb[picurl]);
	$backdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid>'$id' AND fid='$fid' AND yz=1 ORDER BY aid ASC LIMIT 1");
	$backdb[subject]=get_word($backdb[title],34);
	$backdb[picurl]=tempdir($backdb[picurl]);

	$rsdb[picurl]=tempdir($rsdb[picurl]);

	if($rsdb[keywords]){
		unset($array);
		$detail=explode(" ",$rsdb[keywords]);
		foreach( $detail AS $value){
			$_value=urlencode($value);
			$array[]="<A HREF='$Mdomain/search.php?type=keyword&keyword=$_value' target=_blank>$value</A>";
		}
		$rsdb[keywords]=implode(" ",$array);
	}
	//���˲�������
	$rsdb[title]=replace_bad_word($rsdb[title]);

	//��ģ����չ�ӿ�
	//@include(ROOT_PATH."inc/bencandy_{$rsdb[mid]}.php");


	$chdb[main_tpl]=getTpl("bencandy",$main_tpl);

	//��ȡ��ǩ����$chdb[main_tpl]
	$ch_fid	= intval($fidDB[config][label_bencandy]);	//�Ƿ�������Ŀר�ñ�ǩ
	$ch_pagetype = 3;									//2,Ϊlistҳ,3,Ϊbencandyҳ
	$ch_module = $webdb[module_id]?$webdb[module_id]:99;//ϵͳ�ض�ID����,ÿ��ϵͳ������ͬ
	$ch = 0;											//�������κ�ר��
	if($bencandy_tpl != $chdb[main_tpl]){
		require(ROOT_PATH."inc/label_module.php");
	}
	$bencandy_tpl = $chdb[main_tpl];
	ob_end_clean();

	if($foot_tpl!=$bencandy_foot||!isset($bencandy_foot)){
		ob_end_clean();
		ob_start();
		require(ROOT_PATH."inc/foot.php");
		$content_foot=ob_get_contents();
		ob_end_clean();
	}
	$bencandy_foot = $foot_tpl;

	ob_start();
	
	$_rsdb = $rsdb;
	$rsdb = '';
	$page = 1;
	do{
		$RMIN = $page-1;
		$reply = $db->get_one("SELECT * FROM {$_pre}reply WHERE aid=$aid ORDER BY topic DESC,orderid ASC LIMIT $RMIN,1");

		$rsdb=$_rsdb+$reply;
		
		//���˲�������
		$rsdb[content]=replace_bad_word($rsdb[content]);
		$rsdb[subhead]=replace_bad_word($rsdb[subhead]);
	
		$webdb[AutoTitleNum] && $rsdb[pages]>1 && $rsdb[title]=Set_Title_PageNum($rsdb[title],$page);
		$rsdb[content] = En_TruePath($rsdb[content],0,1);
		$rsdb[content]=preg_replace("/<IMG src=\"([^\"]+)\" border=0><A href=\"([^\"]+)\" target=_blank>([^<>]+)<\/A>/eis","encode_fileurl('\\1','\\2','\\3')",$rsdb[content]);
		$rsdb[content]=preg_replace("/href=\"([^\"]+)\"([^<>]+)p8name=\"p8download\">([^<>]+)<\/A>/eis","encode_fileurl('','\\1','\\3')",$rsdb[content]);


		$rsdb[content]=show_keyword($rsdb[content]);	//ͻ����ʾ�ؼ���
		$IS_BIZ && AvoidGather();	//���ɼ�����

		$showpage=getpage("","","bencandy.php?fid=$fid&aid=$aid",1,$rsdb[pages]);

		unset($Mrsdb);
		$detail=explode("\n",$rsdb[photourl]);
		foreach( $detail AS $value){
			list($_url,$_name)=explode("@@@",$value);
			$Mrsdb[photourl][name][]=$_name;
			$Mrsdb[photourl][url][]=tempdir($_url);
		}

		if(!$bencandy_content){
			ob_end_clean();
			ob_start();
			$MenuArray='';
			
			require(ROOT_PATH."inc/head.php");
			require($chdb[main_tpl]);

			$bencandy_content=ob_get_contents().$content_foot;
			$bencandy_content=preg_replace("/<!--include(.*?)include-->/is","\\1",$bencandy_content);
			$bencandy_content=str_replace('<!---->','',$bencandy_content);
		}
		make_html($bencandy_content,'bencandy');
		$bencandy_content = '';
		$page++;
		$ifpage=($page>$rsdb[pages])?false:true;
		$STEPS++;
		if($STEPS%100){
			sleep(1);	//ÿ����100ƪ��Ҫ��ͣһ��,��ֹ����������̫��
		}
	}
	while($ifpage);

}//��Ӧ�����������ȡͼƬquery
}while($ifdo); //��Ӧ�����DO

/***********************��β***********************/

ob_end_clean();


}//��Ӧ�������Ŀquery
?>