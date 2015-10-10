<?php
!function_exists('html') && exit('ERR');
$db->query("UPDATE {$_pre}article SET hits=hits+1,lastview='$timestamp' WHERE aid='$aid'");
$rs=$db->get_one(" SELECT hits,comments FROM {$_pre}article WHERE aid='$aid' ");


echo "<SCRIPT LANGUAGE=\"JavaScript\">";
//处理跨域问题
if($webdb[cookieDomain]){
	echo "document.domain = \"$webdb[cookieDomain]\";";
}

echo "if(parent.document.getElementById('hits')!=null)parent.document.getElementById('hits').innerHTML='$rs[hits]';";

if($lfjid){
	echo "if(parent.document.getElementById('comment_username_tr')!=null)parent.document.getElementById('comment_username_tr').style.display='none';
	";
}
if($web_admin || !$groupdb[CommentArticleYzImg]){
	echo "if(parent.document.getElementById('comment_yzimg_tr')!=null)parent.document.getElementById('comment_yzimg_tr').style.display='none';
	";
}

echo "</SCRIPT>";
?>