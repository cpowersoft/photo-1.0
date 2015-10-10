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

get_guide($fid);	//��Ŀ����


/**
*��ȡͼƬ
**/
$min=intval($page)-1;
$rsdb=$db->get_one("SELECT R.*,A.* FROM {$_pre}article A LEFT JOIN {$_pre}reply R ON A.aid=R.aid WHERE A.aid=$aid ORDER BY R.topic DESC,R.orderid ASC LIMIT $min,1");

if(!$rsdb){
	showerr("���ݲ�����!");
}elseif($fid!=$rsdb[fid]){
	showerr("FID����");
}

/**
*��Ŀ�����ļ�
**/
$fidDB=$db->get_one("SELECT * FROM {$_pre}sort WHERE fid='$fid'");
$fidDB[M_alias]='ͼƬ';
$fidDB[config]=unserialize($fidDB[config]);
$FidTpl=unserialize($fidDB[template]);

$fupId=intval($fidDB[type]?$fid:$fidDB[fup]);

//��ֹ���ʶ�̬ҳ
if($webdb[Html_Type]==1&&$webdb[ForbidShowPhpPage]&&!$NeedCheck&&!$jobs){
	$detail=m_html_url();
	if(is_file(Mpath.$detail[_showurl])){
		header("location:$detail[showurl]");
		exit;
	}
}

/**
*ͼƬ���
**/
check_article($rsdb);

//ͳ�Ƶ������
$db->query("UPDATE {$_pre}article SET hits=hits+1,lastview='$timestamp' WHERE aid='$aid'");

//SEO
$titleDB[title]		= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
$titleDB[keywords]	= filtrate($rsdb[keywords]);
$rsdb[description] || $rsdb[description]=get_word(preg_replace("/(<([^<]+)>|	|&nbsp;|\n)/is","",$rsdb[content]),250);
$titleDB[description] = filtrate($rsdb[description]);



//ͼƬ���
$STYLE = $rsdb[style] ? $rsdb[style] : ($fidDB[style] ? $fidDB[style] : $STYLE);

//�����Ŀ����ģ��
if(is_file(html("$webdb[SideSortStyle]"))){
	$sortnameTPL=html("$webdb[SideSortStyle]");
}else{
	$sortnameTPL=html("side_sort/0");
}

/**
*ģ��ѡ��
**/
//���ƴ�������,�����ҳģ��
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


//������ʵ��ַ��ԭ
$rsdb[content] = En_TruePath($rsdb[content],0,1);
require_once(ROOT_PATH."inc/encode.php");
//�ļ�����
//<div><a style="COLOR: red" href="http://1.com/upload_files/other/1_20070729020722_YmI=.rar" target=_blank p8name="p8download">�������</a></div>
$rsdb[content]=preg_replace("/<IMG src=\"([^\"]+)\" border=0><A href=\"([^\"]+)\" target=_blank>([^<>]+)<\/A>/eis","encode_fileurl('\\1','\\2','\\3')",$rsdb[content]);
$rsdb[content]=preg_replace("/<([^<>]+)href=\"([^\"]+)\"([^<>]+)p8name=\"p8download\"([^<>]*)>([^<>]+)<\/A>/eis","encode_fileurl('','\\2','\\5')",$rsdb[content]);


$rsdb[content]=show_keyword($rsdb[content]);	//ͻ����ʾ�ؼ���

$IS_BIZ && AvoidGather();	//���ɼ�����

$rsdb[posttime] = date("Y-m-d H:i:s",$rsdb[posttime]);

if($rsdb[copyfromurl]&&!strstr($rsdb[copyfromurl],"http://")){
	$rsdb[copyfromurl]="http://$rsdb[copyfromurl]";
}

//ͼƬ�ֲ�
$showpage = getpage("","","bencandy.php?fid=$fid&aid=$aid",1,$rsdb[pages]);

/**
*��һƪ����һƪ,�Ƚ�Ӱ���ٶ�
**/
$nextdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid<'$id' AND fid='$fid' AND yz=1 ORDER BY aid DESC LIMIT 1");
$nextdb[subject]=get_word($nextdb[title],34);
$nextdb[picurl]=tempdir($nextdb[picurl]);
$backdb=$db->get_one("SELECT picurl,title,aid,fid FROM {$_pre}article WHERE aid>'$id' AND fid='$fid' AND yz=1 ORDER BY aid ASC LIMIT 1");
$backdb[subject]=get_word($backdb[title],34);
$backdb[picurl]=tempdir($backdb[picurl]);

//����ͷ����β��
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
*Ϊ��ȡ��ǩ����
**/
$chdb[main_tpl]=getTpl("bencandy",$main_tpl);

/**
*��ǩ
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//�Ƿ�������Ŀר�ñ�ǩ
$ch_pagetype = 3;									//2,Ϊlistҳ,3,Ϊbencandyҳ
$ch_module = 0;										//ͼƬģ��,Ĭ��Ϊ0
$ch = 0;											//�������κ�ר��
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

//���˲�������
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

//��ģ����չ�ӿ�
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
*ͼƬ���
**/
function check_article(&$rsdb){
	global $fidDB,$timestamp,$web_admin,$groupdb,$timestamp,$lfjid,$lfjuid,$fid,$id,$aid,$buy,$lfjdb,$webdb,$pre,$db;
	if(!$rsdb)
	{
		showerr("ͼƬ������");
	}
	//if( $fidDB[allowviewcontent]&&!in_array($fidDB[M_keyword],array('mv','download')) )
	if( $fidDB[allowviewcontent] )
	{
		if( !$web_admin&&!in_array($groupdb[gid],explode(",",$fidDB[allowviewcontent])) )
		{
			showerr("�������û��鲻�������ͼƬ����");
		}
	}
	
	//if( $rsdb[allowview]&&!in_array($fidDB[M_keyword],array('mv','download')) )
	if( $rsdb[allowview] )
	{
		if( !$web_admin&&!in_array($groupdb[gid],explode(",",$rsdb[allowview])) )
		{
			showerr("����,�������û��鲻�������ͼƬ����");
		}
	}

	//�����˿�ʼ�����������
	if($rsdb[begintime]&&$timestamp<$rsdb[begintime])
	{
		$rsdb[begintime]=date("Y-m-d H:i:s",$rsdb[begintime]);
		if($web_admin){
			 Remind_msg("����ֻ�е��ˡ�{$rsdb[begintime]}���Ǹ�ʱ��ſ��Բ鿴,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}else{
			showerr("<font color='red' ><u>�ܱ�Ǹ,�����������˱�������ֻ�е��ˡ�{$rsdb[begintime]}���Ǹ�ʱ��ſ��Բ鿴</u></font>");
		}
	}

	//������ʧЧ�����������
	if($rsdb[endtime]&&$timestamp>$rsdb[endtime])
	{
		$rsdb[endtime]=date("Y-m-d H:i:s",$rsdb[endtime]);
		if($web_admin){
			 Remind_msg("�����������鿴�����ǡ�{$rsdb[endtime]}��,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}else{
			showerr("<font color='red' ><u>�ܱ�Ǹ,�����������˱����������鿴�����ǡ�{$rsdb[endtime]}���������ѳ�����������ޣ����Բ��ܲ鿴</u></font>");
		}
	}

	if($rsdb[yz]==2){
		if($web_admin){
			 Remind_msg("����վ�����ݲ����Բ鿴,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}else{
			showerr("����վ�������㲻���Բ鿴");
		}
	}
	//δ���
	if($rsdb[yz]==0&&(!$lfjid||$lfjuid!=$rsdb[uid]))
	{
		if($web_admin){
			 Remind_msg("���Ļ�ûͨ����֤,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}else{
			showerr("<font color='red' ><u>�ܱ�Ǹ,���Ļ�ûͨ����֤,�㲻�ܲ鿴</u></font>");
		}
	}

	//��ʱ����
	if($rsdb[yz]==3&&$rsdb[begintime]>$timestamp)
	{
		if($web_admin){
			 Remind_msg("����Ϊ��ʱ����,ʱ��û��,���ܲ鿴,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}elseif($lfjuid&&$lfjuid==$rsdb[uid]){
			 Remind_msg("����Ϊ��ʱ����,ʱ��û��,���ܲ鿴,��Ϊ��������,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}else{
			showerr("<font color='red' ><u>����Ϊ��ʱ����,ʱ��û��,���ܲ鿴</u></font>");
		}
	}elseif($rsdb[yz]==3){
		corntab_post('DE',$rsdb[aid]);	//��������
	}

	//��ת������
	if($rsdb[jumpurl])
	{
		echo "ҳ��������ת�У����Ժ�...<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$rsdb[jumpurl]'>";
		exit;
	}

	//ͼƬ����
	if($rsdb[passwd])
	{
		if($web_admin)
		{
			 Remind_msg("��������������,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}
		else
		{
			if( $_POST[password] && $_POST[TYPE] == 'article'  )
			{
				if( $_POST[password] != $rsdb[passwd] )
				{
					echo "<A HREF=\"bencandy.php?fid=$fid&NeedCheck=1&aid=$aid\">���벻��ȷ,�������</A>";
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
				echo "<CENTER><form name=\"form1\" method=\"post\" action=\"\">������ͼƬ����:<input type=\"password\" name=\"password\"><input type=\"hidden\" name=\"TYPE\" value=\"article\"><input type=\"hidden\" name=\"NeedCheck\" value=\"1\"><input type=\"submit\" name=\"Submit\" value=\"�ύ\"></form></CENTER>";
				exit;
			}
		}
	}

	//��Ŀ����
	if( $makehtml!=2 && $fidDB[passwd] )
	{
		if($web_admin)
		{
			 Remind_msg("����Ŀ����������,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}
		else
		{
			if( $_POST[password] && $_POST[TYPE] == 'sort' )
			{
				if( $_POST[password] != $fidDB[passwd] )
				{
					echo "<A HREF=\"?fid=$fid&aid=$aid\">���벻��ȷ,�������</A>";
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
				echo "<CENTER><form name=\"form1\" method=\"post\" action=\"\">��������Ŀ����:<input type=\"password\" name=\"password\"><input type=\"hidden\" name=\"TYPE\" value=\"sort\"><input type=\"hidden\" name=\"NeedCheck\" value=\"1\"><input type=\"submit\" name=\"Submit\" value=\"�ύ\"></form></CENTER>";
				exit;
			}
		}
	}

	//���ִ��� 
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
				$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>���ȵ�¼,��Ҫ֧��{$rsdb[money]}{$webdb[MoneyName]}���ܲ鿴ȫ������</div>";
			}else{
				showerr("���ȵ�¼,��Ҫ֧��{$rsdb[money]}{$webdb[MoneyName]}���ܲ鿴");
			}			
		}
		elseif($web_admin)
		{
			 Remind_msg("�����������շ�,��Ϊ���ǹ���Ա,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}
		elseif($lfjuid==$rsdb[uid])
		{
			 Remind_msg("�����������շ�,��Ϊ���Ƿ�����,���Կ��Բ鿴,�������ǲ��ܲ鿴��");
		}
		elseif( !strstr($rsdb[buyuser],",$lfjid,") )
		{
			$lfjdb[money]=get_money($lfjuid);
			if($lfjdb[money]<$rsdb[money])
			{
				if($webdb[view_sell_article]){
					$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>���{$webdb[MoneyName]}����$rsdb[money],���ܲ鿴ȫ������</div>";
				}else{
					showerr("���{$webdb[MoneyName]}����$rsdb[money]");
				}
			}
			elseif($buy==1)
			{
				add_user($lfjuid,"-$rsdb[money]",'�鿴ͼƬ���ݿ۷�');
				add_user($rsdb[uid],"$rsdb[money]",'ͼƬ���������');
				$rsdb[buyuser]=$rsdb[buyuser]?",{$lfjid}{$rsdb[buyuser]}":",$lfjid,";
				$erp=get_id_table($id);
				$db->query("UPDATE {$_pre}article$erp SET buyuser='$rsdb[buyuser]' WHERE aid=$id");
				refreshto("bencandy.php?fid=$fid&NeedCheck=1&id=$id","����ɹ�,��ո�������{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}",3);
			}
			else
			{
				if($webdb[view_sell_article]){
					$rsdb[content] = "$content<div style='border:1px solid red;padding:10px;background:eee;'>����Ҫ����{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}����Ȩ�޲鿴ȫ������,�Ƿ����<br><br>[<A HREF='bencandy.php?fid=$fid&buy=1&NeedCheck=1&id=$id'>��Ҫ����</A>]</div>";
				}else{
					showerr("����Ҫ����{$webdb[MoneyName]}{$rsdb[money]}{$webdb[MoneyDW]}����Ȩ�޲鿴,�Ƿ����<br><br>[<A HREF='bencandy.php?fid=$fid&buy=1&NeedCheck=1&id=$id'>��Ҫ����</A>]");
				}
			}
		}
	}
}
?>