<?php
require(dirname(__FILE__)."/"."global.php");
require_once(ROOT_PATH."inc/class.inc.php");
$Guidedb=new Guide_DB;

unset($Article_Module);

$Guidedb->ifpost=1;
$Guidedb->forbidpost=1;

if(!$aid&&!$rid){
	$aid=$id;
}
if($rid)
{
	if(!$aid){
		showerr("aid������!");
	}
	//�޸�������޸Ķ�ҳ����
	$rsdb=$db->get_one("SELECT R.*,A.* FROM {$_pre}article A LEFT JOIN {$_pre}reply R ON A.aid=R.aid WHERE R.rid='$rid'");
	$aid=$rsdb[aid];
	$fid=$rsdb[fid];
}
elseif($aid)
{
	//ֻ�����޸�����/����ͼƬ
	$rsdb=$db->get_one("SELECT R.*,A.* FROM {$_pre}article A LEFT JOIN {$_pre}reply R ON A.aid=R.aid WHERE A.aid='$aid' ORDER BY R.rid ASC LIMIT 1");
	isset($_POST[fid]) || $fid=$rsdb[fid];
}


if($fid||$step){
	$fidDB=$db->get_one("SELECT * FROM {$_pre}sort WHERE fid='$fid'");
	!$fidDB && showerr("��Ŀ����");
	$fidDB[type]!=0 && showerr("��ֻ��ѡ������Ŀ��������!");
}

$job=='postnew' && !$mid && $mid=$fidDB[fmid];

if($lfjid&&@in_array($lfjid,explode(',',$fidDB[admin])))
{
	$web_admin=1;
}
if($fidDB&&!$web_admin&&!in_array($groupdb[gid],explode(',',$fidDB[allowpost])))
{
	showerr("�������û�����Ȩ�ڱ���Ŀ��{$fidDB[name]}�����κβ���");
}

if(!$lfjid&&$job!='postnew')
{
	showerr("�ο���Ȩ����");
}

$atc_power=0;
if($lfjid){
	if($web_admin||$lfjuid==$rsdb[uid]){
		$atc_power=1;
	}
}
$uid=isset($rsdb[uid])?$rsdb[uid]:$lfjuid;

if($job=='endHTML')
{
	$htmlurldb=m_html_url();
	//��ҳ���ɾ�̬
	@unlink(Mpath."index.htm.bak");
	rename(Mpath."index.htm",Mpath."index.htm.bak");
	refreshto("myarticle.php?job=myarticle","<CENTER>[<A HREF='?job=postnew&fid=$fid'>����������</A>] [<A HREF='?job=post_more&aid=$aid'>����������</A>] [<A HREF='myarticle.php?job=myarticle&fid=$fid'>����ͼƬ�б�</A>] [<A HREF='{$htmlurldb[showurl]}' target=_blank>�鿴ͼƬ</A>] [<A HREF='?job=manage&aid=$aid'>�޸�ͼƬ</A>]</CENTER><div style='display:none;'><iframe src='$Mdomain/job.php?job=article_html&fid=$fid&aid=$aid' width=0 height=0></iframe></div>",60);
}
elseif($job=='manage')
{
	if(!$atc_power)showerr("��ûȨ��");
	if($rsdb[pages]<2){
		header("location:post.php?job=edit&aid=$aid");exit;
	}
	if($step==2){
		asort($orderDB);
		$i=0;
		foreach( $orderDB AS $key=>$value){
			$i++;
			$db->query("UPDATE {$_pre}reply SET orderid=$i WHERE aid='$aid' AND rid='$key'");
		}
		refreshto("$FROMURL","����ɹ�",1);
	}
	if($rsdb[pages]>1){
		$MSG="�޸�����";
		$i=0;
		$query = $db->query("SELECT * FROM {$_pre}reply WHERE aid='$aid' ORDER BY topic DESC,orderid ASC");
		while($rs = $db->fetch_array($query)){
			if(!$rs[subhead]){
				$rs[subhead]=$rsdb[title];
			}
			$rs[postdate]='';
			if($rs[postdate]){
				$rs[postdate]=date("Y-m-d H:i:s",$rs[postdate]);
			}
			$rs[i]=++$i;
			$listdb[]=$rs;
		}
		require(ROOT_PATH."member/head.php");
		require(dirname(__FILE__)."/template/post_set.htm");
		require(ROOT_PATH."member/foot.php");
		exit;
	}
}
elseif($action=="delete")
{
	if(!$atc_power)showerr("��ûȨ��");
	//ɾ��ͼƬ�ĺ���
	delete_m_article($rsdb[aid],$rsdb[rid]);
	refreshto("myarticle.php?job=myarticle","ɾ���ɹ�",1);
}

if($job=='edit'||$job=='post_more'||$job=='edit_more'){
	if(!$atc_power)showerr("��ûȨ��");
}

//�Է���ǰ�뷢��ǰ������
require_once(Mpath."inc/check.postarticle.php");

if($job=='postnew')
{

	if($step=='post')
	{
		post_new();

		//���ɾ�̬
		make_article_html("$Murl/member/post.php?job=endHTML&aid=$aid");

		$mid && $mid<106 && $none='none';

		refreshto("?job=postnew&fid=$fid","<CENTER>[<A HREF='?job=postnew&fid=$fid'>��������������</A>] <span style='display:$none;'>[<A HREF='?job=post_more&fid=$fid&aid=$aid'>����������</A>]</span> [<A HREF='myarticle.php?job=myarticle&fid=$fid'>���������б�</A>] [<A HREF='$Mdomain/bencandy.php?fid=$fid&aid=$aid' target=_blank>�鿴����</A>] [<A HREF='?job=edit&aid=$aid'>����޸�</A>]</CENTER>",60);
	}
	$MSG='�·�������';

	$select_fid=$Guidedb->SelectIn("{$_pre}sort",0,$fid);

	require(ROOT_PATH."member/head.php");
	require(dirname(__FILE__)."/template/post.htm");
	require(ROOT_PATH."member/foot.php");
}
elseif($job=='edit')
{
	if($rsdb[yz]&&!$web_admin&&$groupdb[EditPassPower]==2){
		showerr("����˵�ͼƬ,�㲻�����޸�");
	}
	if($step=='post')
	{
		post_edit();

		//���ɾ�̬
		make_article_html("$Murl/member/post.php?job=endHTML&aid=$aid");

		$mid && $mid<106 && $none='none';

		refreshto("$FROMURL","<CENTER>[<A HREF='?job=postnew&fid=$fid'>����������</A>] <span style='display:$none;'>[<A HREF='?job=post_more&aid=$aid'>����������</A>]</span> [<A HREF='myarticle.php?job=myarticle&fid=$fid'>���������б�</A>] [<A HREF='$Mdomain/bencandy.php?fid=$fid&aid=$aid' target=_blank>�鿴����</A>] [<A HREF='?job=edit&aid=$aid'>�����޸�</A>]</CENTER>",60);
	}
	$MSG='�޸�����';

	$select_fid=$Guidedb->SelectIn("{$_pre}sort",0,$fid);

	require(ROOT_PATH."member/head.php");
	require(dirname(__FILE__)."/template/post.htm");
	require(ROOT_PATH."member/foot.php");
}
elseif($job=='post_more')
{
	if($step=='post')
	{
		//��������
		query_reply($aid,'','');

		//���ɾ�̬
		make_article_html("$Murl/member/post.php?job=endHTML&aid=$aid");

		refreshto("$FROMURL","<CENTER>[<A HREF='?job=postnew&fid=$fid'>����������</A>] [<A HREF='?job=post_more&aid=$aid'>����������</A>] [<A HREF='myarticle.php?job=myarticle&fid=$fid'>����ͼƬ�б�</A>] [<A HREF='$Murl/bencandy.php?fid=$fid&aid=$aid' target=_blank>�鿴ͼƬ</A>] [<A HREF='?job=manage&aid=$aid'>�޸�ͼƬ</A>]</CENTER>",60);
	}
	$MSG='����ͼƬ';
	unset($rsdb[content],$rsdb[subhead]);

	require(ROOT_PATH."member/head.php");
	require(dirname(__FILE__)."/template/post.htm");
	require(ROOT_PATH."member/foot.php");
}
elseif($job=='edit_more')
{
	if($step=='post')
	{
		//�޸�����
		query_reply($aid,$rid,'edit');

		//���ɾ�̬
		make_article_html("$Murl/member/post.php?job=endHTML&aid=$aid");

		refreshto("$FROMURL","<CENTER>[<A HREF='?job=postnew&fid=$fid'>����������</A>] [<A HREF='?job=post_more&aid=$aid'>����������</A>] [<A HREF='myarticle.php?job=myarticle&fid=$fid'>����ͼƬ�б�</A>] [<A HREF='$Mdomain/bencandy.php?fid=$fid&aid=$aid' target=_blank>�鿴ͼƬ</A>] [<A HREF='?job=edit_more&aid=$aid&rid=$rid'>�޸�ͼƬ</A>]</CENTER>",60);
	}
	$MSG='�޸�ͼƬ';
	require(ROOT_PATH."member/head.php");
	require(dirname(__FILE__)."/template/post.htm");
	require(ROOT_PATH."member/foot.php");
}



/**
*�û���ѡ��
**/
function group_box($name="postdb[group]",$ckdb=array()){
	global $db,$pre;
	$query=$db->query("SELECT * FROM {$pre}group ORDER BY gid ASC");
	while($rs=$db->fetch_array($query))
	{
		$checked=in_array($rs[gid],$ckdb)?"checked":"";
		$show.="<input type='checkbox' name='{$name}[]' value='{$rs[gid]}' $checked>&nbsp;{$rs[grouptitle]}&nbsp;&nbsp;";
	}
	return $show;
}

/**
*ģ��ѡ��
**/
function select_template($cname,$type=1,$ck=''){
	global $db,$pre;
	$show="<select name='$cname' $reto><option value='' style='color:red;'>��ѡ��ģ��</option>";
	if($type==7||$type==8){
		//$show.="<option value='template/default/none.htm'>��Ҫ����</option>";
	}
	$query=$db->query("SELECT * FROM {$pre}template WHERE type='$type'");
	while($rs=$db->fetch_array($query))
	{
		if(!$rs[name]){
			$rs[name]="ģ��$rs[id]";
		}
		$rs[filepath]==$ck?$ckk='selected':$ckk='';
		$show.="  <option value='$rs[filepath]' $ckk>$rs[name]</option>";
	}
	 return $show." </select>";
}

/**
*���ѡ��
**/
function select_style($name='stylekey',$ck='',$url='',$select=''){
	if($url) 
	$reto=" onchange=\"window.location=('{$url}&{$name}='+this.options[this.selectedIndex].value+'')\"";
	$show="<select name='$name' $reto><option value=''>ѡ����</option>";
	$filedir=opendir(ROOT_PATH."data/style/");
	while($file=readdir($filedir)){
		if(ereg("\.php$",$file)){
			include ROOT_PATH."data/style/$file";
			$ck==$styledb[keywords]?$ckk='selected':$ckk='';	//ָ����ĳ��
			/*ֻѡ��һ��
			if($select){
				if($style_web!=$select){
					continue;
				}
			}
			*/
			$show.="<option value='$styledb[keywords]' $ckk style='color=blue'>$styledb[name]</option>";
		}
	}
	return $show." </select>";   
}

?>