<?php
!function_exists('html') && exit('ERR');
if(!$lfjid){
	showerr('请先登录!');
}

$rs=$db->get_one("SELECT S.admin,S.fid,A.* FROM {$_pre}article A LEFT JOIN {$_pre}sort S ON A.fid=S.fid WHERE A.aid='$id'");

if(!$rs){
	showerr("数据不存在!");
}
$detail=@explode(",",$rs[admin]);

if($web_admin){
	$power=1;
}elseif($lfjuid&&$rs[uid]==$lfjuid){
	$power=1;
}elseif($lfjid&&@in_array($lfjid,$detail)){
	$power=1;
}else{
	$power=0;
}
if($power==0){
	showerr("你无权操作");
}
$detail=explode("\n",$rs[photourl]);
foreach($detail AS $key=>$value){
	list($fileurl)=explode('@@@',$value);
	$listdb[]=tempdir($fileurl);;
}


if($action=="cutimg"){
	$NewPic=str_replace($webdb[www_url],"",$uploadfile);
	$NewPic=ROOT_PATH.$NewPic;
	if(!getimagesize($NewPic)){
		showerr("图片有误!!");
	}

	if($nextpic==1){
		$picurl="$_pre/$rs[fid]/{$lfjuid}_small".strtolower(rands(10)).".jpg";
		makepath(ROOT_PATH."$webdb[updir]/$_pre/$rs[fid]/");	//生成目录
		copy($NewPic,ROOT_PATH."$webdb[updir]/$picurl");
		$NewPic=ROOT_PATH."$webdb[updir]/$picurl";
		$uploadfile=tempdir($picurl);
	}

	if($nextpic<3){
		copy($NewPic,$NewPic.'.jpg');
	}
	include(ROOT_PATH."inc/waterimage.php");
	cutimg($NewPic,$NewPic,$x,$y,$rw,$rh,$w,$h,$scale);
	if($reurl){
		$reurl=base64_decode($reurl);
		header("location:$reurl");
		exit;
	}
	if($nextpic==1){
		if(is_file(ROOT_PATH."$webdb[updir]/$picurl")){
			$db->query("UPDATE {$_pre}article SET picurl='$picurl' WHERE aid='$id'");
			delete_attachment($rs[uid],tempdir($rs[picurl]));
			delete_attachment($rs[uid],tempdir("{$rs[picurl]}.jpg"));
			delete_attachment($rs[uid],tempdir("{$rs[picurl]}.jpg.jpg"));
		}
		$url="?nextpic=2&type=cutimg&id=$id&job=$job&width=$rh&height=$rw&srcimg=$uploadfile.jpg";
	}elseif($nextpic==2){
		$url="?nextpic=3&type=cutimg&id=$id&job=$job&width=$rw&height=$rw&srcimg=$uploadfile.jpg";
	}elseif($nextpic==3){
		$pic1="$uploadfile?$timestamp";
		$pic2=str_replace(".jpg?","?",$pic1);
		$pic3=str_replace(".jpg?","?",$pic2);
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=?job=$job&id=$id&type=end'>";
		exit;
	}else{
		$url="$uploadfile?$timestamp";
	}
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$url'>";
	exit;
}elseif($type=='cutimg'){
	require(html("cutimg"));
	exit;
}elseif($type=='end'){
	$rs[picurl]=tempdir($rs[picurl]);
	echo "<body onclick='window.self.close();'>效果如下:<hr><img src='$rs[picurl]'> <hr><img src='{$rs[picurl]}.jpg'> <hr><img src='{$rs[picurl]}.jpg.jpg'> ";
	exit;
}


print <<<EOT
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#F7F7F7">请选择一张图片裁剪为缩略图</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">

EOT;
foreach($listdb AS $key=>$value){
print <<<EOT

<div style="width:300px;float:left;border:1px solid #ccc;background:#eee;margin:8px;">
      <input onclick="window.location.href='?job=$job&nextpic=1&id=$id&type=cutimg&width=400&height=300&srcimg=$value'" type="radio" name="radiobutton" value="radiobutton">
      <a href="$value" target="_blank"><img src="$value" border="0" onload="this.width='250'"></a> 
</div>

EOT;
}
print <<<EOT

    </td>
  </tr>
</table>
</body>
</html>
EOT;


?>