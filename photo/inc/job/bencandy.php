<?php
header('Content-Type: text/html; charset=gb2312'); 
if(!$lfjid)
{
	die("<A HREF='$webdb[www_url]/do/login.php' onclick=\"clickEdit.cancel('clickEdit_$TagId')\">���ȵ�¼</A>");
}
if($act=="do"){
	if(!$lfjuid){
		$power=0;
	}elseif($web_admin){
		$power=2;
		$rs=$db->get_one("SELECT S.admin,S.fid,A.* FROM {$_pre}article A LEFT JOIN {$_pre}sort S ON A.fid=S.fid WHERE A.aid='$id'");
	}else{
		$rs=$db->get_one("SELECT S.admin,S.fid,A.* FROM {$_pre}article A LEFT JOIN {$_pre}sort S ON A.fid=S.fid WHERE A.aid='$id'");
		$detail=@explode(",",$rs[admin]);
		if($rs[uid]==$lfjuid){
			$power=1;
		}elseif($lfjid&&@in_array($lfjid,$detail)){
			$power=2;
		}else{
			$power=0;
		}
	}
	if($power==0){
		die("����Ȩ����");
	}
	if($step==2){
		if($action=="delete")
		{
			do_work($id,$action);

			//��̬ҳ����
			make_article_html("list.php?fid=$rs[fid]",'del',$rs);
			refreshto("list.php?fid=$rs[fid]","ɾ���ɹ�",1);
		}
		elseif($power==2)
		{
			do_work($id,$action);

			//��̬ҳ����
			if($action!="com"&&$action!="uncom")
			{
				make_article_html("list.php?fid=$rs[fid]",'',$rs);
			}
			refreshto("$FROMURL","�����ɹ�",1);
		}
	}
	else
	{
		$rs=$db->get_one("SELECT * FROM {$_pre}article WHERE aid='$id'");
		echo "<A HREF=\"$webdb[www_url]/member/?main=$Murl/member/post.php?job=postnew&fid=$fid\">�·���</A><br><A HREF=\"$webdb[www_url]/member/?main=$Murl/member/post.php?job=manage&aid=$id\">�޸�</A><br><A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=delete&id=$id\" onclick=\"return confirm('��ȷ��Ҫɾ����?');\">ɾ��</A><br>";
		if($rs[levels]&&$power==2){
			echo "(���Ƽ�)<A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=uncom&levels=0&id=$id\">ȡ���Ƽ�</A><br>";
		}elseif($power==2){
			echo "(δ�Ƽ�)<A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=com&levels=1&id=$id\">�Ƽ�</A><br>";
		}
		if($rs[yz]&&$power==2){
			echo "(�����)<A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=unyz&yz=0&id=$id\">ȡ�����</A><br>";
		}elseif($power==2){
			echo "(δ���)<A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=yz&yz=1&id=$id\">���</A><br>";
		}
		if($rs['list']>$timestamp&&$power==2){
			echo "(���ö�)<A HREF=\"\"><A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=untop&top=$timestamp&id=$id\">ȡ���ö�</A></A><br>";
		}elseif($power==2){
			$times=3600*24*30;
			echo "(δ�ö�)<A HREF=\"$Mdomain/job.php?job=$job&act=$act&step=2&action=top&toptime=$times&id=$id\">�ö�</A><br>";
		}
		if($type!='show'){
			echo "<a href='$Mdomain/bencandy.php?fid=$fid&id=$id&jobs=show'>��ǩ����</a>";
		}else{
			echo "<a href='$Mdomain/bencandy.php?fid=$fid&id=$id&'>�˳���ǩ����</a>";
		}
		echo "<br><a href='$Mdomain/job.php?job=get_small_pic&id=$id'>��ȡ����ͼ</a>";
	}
}
?>