<?php

$fidDB=$db->get_one(" SELECT name,type FROM {$_pre}sort WHERE fid='$fid' ");
if($fidDB[type]!=0){
	refreshto("index.php?lfj=module_admin&dirname=news&file=gather&showurl=&testgather=&job=list_title&id=$id",'��ֻ��ѡ��С��Ŀ!',1);
}
$content='��������';
//$content=mysql_escape_string($content);
$title=@preg_replace('/<([^>]*)>/is',"",$title);	//��HTML������˵�
$title=mysql_escape_string($title);

//����Ҫ�ɼ�������ͬ��ͼƬ
//$rsdb[gatherthesame]=1ʱ,�����ɼ���ͬ���������
//!$morepage �����һҳ��ʱ��
$ForbidAdd='';
if($rsdb[gatherthesame]&&!$morepage){
	$ForbidAdd=$db->get_one("SELECT aid FROM {$_pre}article WHERE title='$title' ORDER BY aid DESC LIMIT 1");
}


foreach( $picDB AS $key=>$value){
	$picurl=$value;
	break;
}




//�ɼ�ͼƬ����
if($GetFile&&!$ForbidAdd){

	include_once(ROOT_PATH."inc/waterimage.php");

	$dir_id=$file_dir?$file_dir:"$_pre/$fid".ceil(date('s')%5);
	makepath(ROOT_PATH."$webdb[updir]/$dir_id");

	foreach( $picDB AS $key=>$fileurl){

		$picDB[$key]="$dir_id/{$lfjdb[uid]}_".strtolower(rands(10).strrchr($fileurl,"."));
		if( $getfilecontent=sockOpenUrl($fileurl,'GET','',$curl) ){
			write_file(ROOT_PATH."$webdb[updir]/{$picDB[$key]}",$getfilecontent);
		}else{
			copy($fileurl,ROOT_PATH."$webdb[updir]/{$picDB[$key]}");
		}

		if(!$morepage&&!$ForbidAdd&& getimagesize(ROOT_PATH."$webdb[updir]/{$picDB[$key]}") && $webdb[if_gdimg] ){
			//��������ͼ
			if( !$havemakesmallpic ){
				$Newpicpath=ROOT_PATH."$webdb[updir]/".substr($picDB[$key],0,-6).'.jpg';
				if($havemakesmallpic<1){
					$picurl=substr($picDB[$key],0,-6).'.jpg';
				}
				gdpic(ROOT_PATH."$webdb[updir]/{$picDB[$key]}",$Newpicpath,400,300,array('fix'=>1));

				gdpic(ROOT_PATH."$webdb[updir]/{$picDB[$key]}","{$Newpicpath}.jpg",300,400,array('fix'=>1));

				gdpic(ROOT_PATH."$webdb[updir]/{$picDB[$key]}","{$Newpicpath}.jpg.jpg",400,400,array('fix'=>1));

				$havemakesmallpic++;
			}
			
		}
		//ͼƬ��ˮӡ
		if($webdb[is_waterimg]){
			imageWaterMark(ROOT_PATH."$webdb[updir]/{$picDB[$key]}",$webdb[waterpos],ROOT_PATH.$webdb[waterimg]);
		}
	}
}


$ispic=1;

//������ͬʱ.����һ��BUG
if($morepage&&$rs=$db->get_one("SELECT * FROM {$_pre}article WHERE title='$title' ORDER BY aid DESC LIMIT 1"))
{
	$aid=$rs[aid];
	$photourl=$rs[photourl]."\n".filtrate(implode("\n",$picDB));
	$db->query(" UPDATE {$_pre}article SET photourl='$photourl' WHERE aid='$rs[aid]' ");
}
elseif(!$ForbidAdd)
{	
	//$rsdb[gatherthesame]=1ʱ,����$ForbidAdd����,�����ɼ���ͬ���������

	$photourl=filtrate(implode("\n",$picDB));

	$fname=$fidDB[name];

	$author=filtrate($author);
	$copyfrom=filtrate($copyfrom);

	$yz=1;

	//��ȡʱ��
	$posttime=get_time($posttime);
	$hits=intval($hits);

	$db->query("
	INSERT INTO `{$_pre}article` 
	( `title`, `fid`, `fname`, `pages`, `posttime`, `list`, `uid`, `username`,`copyfrom`, `copyfromurl`,  `picurl`,`ispic`, `yz`, `keywords`, `jumpurl`, `iframeurl`, `ip`,`author`,`hits`,`photourl`) 
	VALUES
	('$title','$fid','$fname','1','$posttime','$posttime','$lfjuid','$username','$copyfrom','$curl','$picurl','$ispic','$yz','$keywords','$jumpurl','$iframeurl','$onlineip','$author','$hits','$photourl')
	");
	
	$aid=$db->insert_id();

	$db->query("INSERT INTO `{$_pre}reply` (  `aid` , `fid` ,`uid` ,  `content` ,topic) VALUES ( '$aid', '$fid','$lfjuid', '$content',1)");
}
?>