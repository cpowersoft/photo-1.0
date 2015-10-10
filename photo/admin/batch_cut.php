<?php
!function_exists('html') && exit('ERR');

ck_power('batch_cut');

if($job=="set")
{
	$sortdb=array();
	list_2allsort($fid,"sort");
	get_admin_html('set');
}

elseif($action=="set")
{
	if($page<2){
		$page=1;
		if($beginTime){
			$beginTime=preg_replace("/([\d]+)-([\d]+)-([\d]+) ([\d]+):([\d]+):([\d]+)/eis","mk_time('\\4','\\5', '\\6', '\\2', '\\3', '\\1')",$beginTime);
		}
		if($endTime){
			$endTime=preg_replace("/([\d]+)-([\d]+)-([\d]+) ([\d]+):([\d]+):([\d]+)/eis","mk_time('\\4','\\5', '\\6', '\\2', '\\3', '\\1')",$endTime);
		}
		if($fiddb){
			$fiddb=implode(',',$fiddb);
		}
	}
	$SQL=" WHERE 1 ";
	if($fiddb){
		$SQL.=" AND fid IN ($fiddb) ";
	}
	if($beginTime){
		$SQL.=" AND posttime>'$beginTime'";
	}
	if($endTime){
		$SQL.=" AND posttime<'$endTime'";
	}
	if($beginId){
		$SQL.=" AND aid>'$beginId' ";
	}
	if($endId){
		$SQL.=" AND aid<'$endId' ";
	}
	$rows=10;
	$min=($page-1)*$rows;
	$query = $db->query("SELECT aid,fid,photourl,uid,picurl FROM {$_pre}article $SQL ORDER BY aid ASC LIMIT $min,$rows");
	while($rs = $db->fetch_array($query)){
		$detail=explode("\n",$rs[photourl]);
		list($fileurl)=explode("@@@",$detail[0]);
		$url=ROOT_PATH."$webdb[updir]/$fileurl";
		$picurl="small_{$_pre}/$rs[fid]/{$rs[uid]}_".strtolower(substr(md5($rs[aid]),0,10)).".jpg";
		$newurl=ROOT_PATH."$webdb[updir]/$picurl";
		
		if(is_file($url)){
			makepath(ROOT_PATH."$webdb[updir]/small_{$_pre}/$rs[fid]/");	//生成目录
			gdpic($url,$newurl,400,300,array('fix'=>1));
			gdpic($url,$newurl.".jpg",300,400,array('fix'=>1));
			gdpic($url,$newurl.".jpg.jpg",400,400,array('fix'=>1));
			if(is_file($newurl)){
				delete_attachment($rs[uid],tempdir($rs[picurl]));
				delete_attachment($rs[uid],tempdir("{$rs[picurl]}.jpg"));
				delete_attachment($rs[uid],tempdir("{$rs[picurl]}.jpg.jpg"));
				$db->query("UPDATE {$_pre}article SET picurl='$picurl' WHERE aid='$rs[aid]'");
				$num++;
			}
		}
		$ck++;
	}
	if(!$ck){
		jump("处理完毕!","$admin_path&job=set",5);
	}else{
		$page++;
		echo "正在处理中,请稍候...$page<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$admin_path&action=$action&page=$page&beginTime=$beginTime&endTime=$endTime&beginId=$beginId&endId=$endId&fiddb=$fiddb'>";
		exit;
	}
}






/*栏目列表*/
function list_2allsort($fid,$table='sort'){
	global $db,$_pre,$sortdb,$webdb;
	$query=$db->query("SELECT * FROM {$_pre}$table WHERE fup='$fid' ORDER BY list DESC");
	while( $rs=$db->fetch_array($query) ){
		$icon="";
		for($i=1;$i<$rs['class'];$i++){
			$icon.="&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		if($icon){
			$icon=substr($icon,0,-24);
			$icon.="--";
		}
		if($table=='spsort'){
			if($rs[list_html]){
				$rs[filename]=$rs[list_html];
			}else{
				$rs[filename]=$webdb[special_list_html];
			}
		}else{
			if($rs[list_html]){
				$rs[filename]=$rs[list_html];
			}else{
				$rs[filename]=$webdb[Info_html_list];
			}
			$rs[filename]=preg_replace("/(.*)\/([^\/]+)/is","\\1/",$rs[filename]);			
		}
		$fid=$rs[fid];
		$page=1;
		eval("\$rs[filename]=\"$rs[filename]\";");
		if(is_dir(Mpath.$rs[filename])||is_file(Mpath.$rs[filename])){
			$rs[havemade]=1;
		}else{
			$rs[havemade]=0;
		}
		$rs[config]=unserialize($rs[config]);
		$rs[icon]=$icon;
		$sortdb[]=$rs;

		list_2allsort($rs[fid],$table);
	}
}
?>