<?php
//提交表单时候作处理
if($step=='post')
{
	//验证码校对
	if($groupdb[PostArticleYzImg]&&!$web_admin){	
		if(!check_imgnum($yzimg)){		
			showerr("验证码不符合");
		}
	}
	
	if($job=='postnew'||$job=='edit'){
		if(!$postdb[title]){
			showerr("标题不能为空");
		}elseif(strlen($postdb[title])>120){
			showerr("标题不能大于120个字节");
		}
	}
	if(strlen($postdb[keywords])>80){
		showerr("关键字不能大于80个字节");
	}
	if(strlen($postdb[subhead])>120){
		showerr("副标题不能大于120个字节");
	}
	if(strlen($postdb[smalltitle])>80){
		showerr("短标题不能大于80个字节");
	}
	if(strlen($postdb[author])>25){
		showerr("作者不能大于25个字节");
	}
	if(strlen($postdb[copyfrom])>80){
		showerr("来源网站不能大于80个字节");
	}
	if($postdb[htmlname] && !eregi("(\.htm|\.html)$",$postdb[htmlname]) ){
		showerr("自定义文件名只能是htm或html后缀的文件");
	}
	if($job=='postnew'&&$webdb[ForbidRepeatTitle]&&$db->get_one("SELECT * FROM {$_pre}article WHERE title='$postdb[title]' AND fid='$fid'")){
		showerr("系统不允许本栏目有重复的标题,请更换标题!");
	}
	//一些权限功能的设置
	article_more_set_ckecked($job);

	//过滤一些用害的代码
	$postdb[title]		=	filtrate($postdb[title]);
	$postdb[subhead]	=	filtrate($postdb[subhead]);
	$postdb[keywords]	=	filtrate($postdb[keywords]);
	$postdb[smalltitle]	=	filtrate($postdb[smalltitle]);
	$postdb[picurl]		=	filtrate($postdb[picurl]);
	//$postdb[description]=	filtrate($postdb[description]);
	$postdb[author]		=	filtrate($postdb[author]);
	$postdb[copyfrom]	=	filtrate($postdb[copyfrom]);
	$postdb[copyfromurl]=	filtrate($postdb[copyfromurl]);

	$postdb[description]	=	preg_replace('/javascript/i','java script',$postdb[description]);
	$postdb[description]	=	preg_replace('/<iframe ([^<>]+)>/i','&lt;iframe \\1>',$postdb[description]);
	
	//针对火狐浏览器做的处理
	$postdb[content]=str_replace("=\\\"../$webdb[updir]/","=\\\"$webdb[www_url]/$webdb[updir]/",$postdb[content]);

	if(!$groupdb[PostNoDelCode]){
		$postdb[content]	=	preg_replace('/javascript/i','java script',$postdb[content]);
		$postdb[content]	=	preg_replace('/<iframe ([^<>]+)>/i','&lt;iframe \\1>',$postdb[content]);
	}

	//采集外部图片
	$postdb[content]	=	get_outpic($postdb[content],$fid,$GetOutPic);

	//去除超级链接
	$DelLink && $postdb[content] = preg_replace("/<a([^<>]*) href=\\\\\"([^\"]+)\\\\\"/is","<a",$postdb[content]);

	//附件目录转移
	$downloadDIR="$_pre/$fid";
	if($webdb[ArticleDownloadDirTime]){	//按日期存放附件
		$downloadDIR.="/".date($webdb[ArticleDownloadDirTime],$timestamp);
	}
	//$postdb[content]=move_attachment($lfjuid,$postdb[content],$downloadDIR,'PostArticle');

	//对于太大的图片要做处理自动缩放比例
	//$postdb[content]=str_replace("<img ","<img onload=\'if(this.width>600)makesmallpic(this,600,1800);\' ",$postdb[content]);

	//图片频道转移图片目录
	if($post_db){
		foreach($post_db[photourl][url] AS $key=>$value){
			$value=trim($value);
			if(!$value||eregi("://",$value)){
				continue;
			}
			if(!$postdb[picurl]){
				copy(ROOT_PATH."$webdb[updir]/$value",ROOT_PATH."$webdb[updir]/{$value}.jpg");
				$postdb[picurl]="{$value}.jpg";
			}
			move_attachment($lfjuid,tempdir($value),$downloadDIR);
			if(is_file(ROOT_PATH."$webdb[updir]/$downloadDIR/".basename($value))){
				$post_db[photourl][url][$key]="$downloadDIR/".basename($value);
			}			
		}

		unset($_array);
		foreach( $post_db[photourl][url] AS $key=>$value)
		{
			if(!$value){
				continue;
			}
			$_array[]="$value@@@{$post_db[photourl][name][$key]}@@@{$post_db[photourl][fen][$key]}";
		}
		$postdb[photourl]=implode("\n",$_array);
	}


	/*缩略图处理*/
	if( $postdb[picurl] && $postdb[picurl]!=$rsdb[picurl] )
	{
		//图片目录转移
		move_attachment($lfjuid,tempdir($postdb[picurl]),$downloadDIR,'small');
		
		$post_picurl=$postdb[picurl];
		if(file_exists(ROOT_PATH."$webdb[updir]/$downloadDIR/".basename($postdb[picurl]))){
			$postdb[picurl]="$downloadDIR/".basename($postdb[picurl]);
		}

		if(file_exists(ROOT_PATH."$webdb[updir]/$postdb[picurl]")&&$postdb[automakesmall]&&$webdb[if_gdimg])
		{
			//如果是从图片内容提取的图片,需要重命为另一张,否则影响到原来的
			if(strstr($postdb[content],$postdb[picurl])){			
				$smallpic=str_replace(".","_",$postdb[picurl]).".gif";
			}else{			
				$smallpic="$postdb[picurl]";
			}
			$Newpicpath=ROOT_PATH."$webdb[updir]/$smallpic";

			$picWidth>500 && $picWidth=300;
			$picWidth<50 && $picWidth=300;

			$picHeight>500 && $picHeight=225;
			$picHeight<50 && $picHeight=225;
			gdpic(ROOT_PATH."$webdb[updir]/$postdb[picurl]",$Newpicpath,$picWidth?$picWidth:300,$picHeight?$picHeight:225,$webdb[autoCutSmallPic]?array('fix'=>1):'');
			
			//多生成一张3:4的图片,方便标签调用
			gdpic(ROOT_PATH."$webdb[updir]/$postdb[picurl]","$Newpicpath.jpg",$picHeight?$picHeight:225,$picWidth?$picWidth:300,$webdb[autoCutSmallPic]?array('fix'=>1):'');

			//多生成一张1:1的图片,方便标签调用
			gdpic(ROOT_PATH."$webdb[updir]/$postdb[picurl]","$Newpicpath.jpg.jpg",$picWidth?$picWidth:300,$picWidth?$picWidth:300,$webdb[autoCutSmallPic]?array('fix'=>1):'');

			if( file_exists($Newpicpath) ){
				
				$postdb[picurl]=$smallpic;

				//FTP上传文件到远程服务器
				if($webdb[ArticleDownloadUseFtp]){
					ftp_upfile($Newpicpath,$postdb[picurl]);
				}
			}
		}else{
			if(file_exists(ROOT_PATH."$webdb[updir]/{$post_picurl}.jpg")){
				move_attachment($lfjuid,tempdir("{$post_picurl}.jpg"),$downloadDIR,'small');
			}
			if(file_exists(ROOT_PATH."$webdb[updir]/{$post_picurl}.jpg.jpg")){
				move_attachment($lfjuid,tempdir("$post_picurl.jpg.jpg"),$downloadDIR,'small');
			}
		}
	}
	

	//如果系统设置自动提取关键字的话,只有当用户没设置关键字,才自动提取.
	if($job=='postnew'&&$webdb[autoGetKeyword]&&!$postdb[keywords]){
		$postdb[keywords] = keyword_ck($postdb[keywords],$postdb[title]);
		
	}

	//添加作者来源
	if($postdb[copyfrom] && $postdb[addcopyfrom] && $web_admin)
	{
		if(!$db->get_one("SELECT * FROM {$pre}copyfrom WHERE name='$postdb[copyfrom]' ") ){
			$db->query("INSERT INTO `{$pre}copyfrom` (`name` , `list`,uid ) VALUES ('$postdb[copyfrom]', '$timestamp','$lfjdb[uid]')");
		}
	}

	

	//过滤不健康的字
	$postdb[content]	=	replace_bad_word($postdb[content]);
	$postdb[title]		=	replace_bad_word($postdb[title]);
	$postdb[author]		=	replace_bad_word($postdb[author]);
	$postdb[keywords]	=	replace_bad_word($postdb[keywords]);
	$postdb[copyfrom]	=	replace_bad_word($postdb[copyfrom]);
	$postdb[description]=	replace_bad_word($postdb[description]);

	$postdb[picurl]		&&	$postdb[ispic]=1;

	//对附件地址做处理,防止更换域名后,无法访问
	$postdb[content]	=	En_TruePath($postdb[content]);
}
//修改与发表,未提交前
else
{
	//如果系统与栏目禁用评论的话,则图片强制禁用评论
	$forbidcomment=" ";
	if($job=='postnew'){
		if(!$webdb[showComment]||($fidDB&&!$fidDB[allowcomment])){
			$forbidcomment=" checked ";
		}
	}elseif($rsdb[forbidcomment]){
		$forbidcomment=" checked ";
	}
	
	$fonttype=$rsdb[fonttype]==1?" checked ":"";
	if($job=='edit'){
		$yz=$rsdb[yz]==1?" checked ":"";
	}else{
		$yz=" checked ";
	}
	
	if($rsdb["list"]>$timestamp)
	{
		$top=" checked ";
	}
	if($rsdb["levels"])
	{
		$levels=" checked ";
	}
	if($rsdb["target"])
	{
		$target=" checked ";
	}

	$style_select=select_style('postdb[style]',$rsdb[style]);
	
	unset($keywords,$copyfroms,$moduledb,$specials,$baseSpecial);

	$query = $db->query("SELECT * FROM {$_pre}special ORDER BY list DESC LIMIT 500");
	while($rs = $db->fetch_array($query)){
		if($rs[yz]!=1&&$rs[uid]!=$lfjuid){
			continue;
		}
		if($rs[allowpost]&&!$web_admin){
			if( !in_array($groupdb['gid'],explode(",",$rs[allowpost])) ){
				if(!$lfjuid||$rs[uid]!=$lfjuid ){
					continue;
				}				
			}
		}
		$checked='';
		if($aid&&in_array($aid,explode(",",$rs[aids])))
		{
			$checked=' checked ';
		}
		if($rs[ifbase]){
			$baseSpecial.="<input type='checkbox' name='postdb[special][]' value='$rs[id]' $checked>$rs[title] ";
		}else{
			$specials.="<input type='checkbox' name='postdb[special][]' value='$rs[id]' $checked>$rs[title]<br>";
		}		
	}

	$query=$db->query("SELECT * FROM {$_pre}keyword ORDER BY num DESC LIMIT 30");
	while($rs=$db->fetch_array($query)){
		$keywords.="<option value='$rs[keywords]' >$rs[keywords]</option>";
	}
	$query=$db->query("SELECT * FROM {$pre}copyfrom ORDER BY list DESC");
	while($rs=$db->fetch_array($query)){
		$copyfroms.="<option value='$rs[name]'>$rs[name]</option>";
	}

	$group_allowdown=group_box("postdb[allowdown]",explode(",",$rsdb[allowdown]));
	$group_allowview=group_box("postdb[allowview]",explode(",",$rsdb[allowview]));

	$tpl_list=@unserialize($fidDB[template]);
	$tpl_show=@unserialize($rsdb[template]);


	if($rsdb[photourl]){
		$detail=explode("\n",$rsdb[photourl]);
		unset($rsdb[photourl]);
		foreach( $detail AS $_key=>$value){
			list($url,$name,$fen)=explode("@@@",$value);
			$rsdb[photourl][name][]=$name;
			$rsdb[photourl][url][]=$url;
			$rsdb[photourl][fen][]=$fen;
		}
	}


	$value_tpl_head=$tpl_show[head]?$tpl_show[head]:$tpl_list[head];
	$value_tpl_foot=$tpl_show[foot]?$tpl_show[foot]:$tpl_list[foot];
	$value_tpl_show=$tpl_show[bencandy]?$tpl_show[bencandy]:$tpl_list[bencandy];
	$tpl_head=select_template("",7,$value_tpl_head);
	$tpl_head=str_replace("<select","<select onChange='get_obj(\"head_tpl\").value=this.options[this.selectedIndex].value;'",$tpl_head);
	$tpl_foot=select_template("",8,$value_tpl_foot);
	$tpl_foot=str_replace("<select","<select onChange='get_obj(\"foot_tpl\").value=this.options[this.selectedIndex].value;'",$tpl_foot);
	$tpl_show=select_template("",3,$value_tpl_show);
	$tpl_show=str_replace("<select","<select onChange='get_obj(\"main_tpl\").value=this.options[this.selectedIndex].value;'",$tpl_show);

	$rsdb[posttime]		&&	$rsdb[posttime]=date("Y-m-d H:i:s",$rsdb[posttime]);
	$rsdb[begintime]	&&	$rsdb[begintime]=date("Y-m-d H:i:s",$rsdb[begintime]);
	$rsdb[endtime]		&&	$rsdb[endtime]=date("Y-m-d H:i:s",$rsdb[endtime]);

	//地址还原
	$rsdb[content]=En_TruePath($rsdb[content],0);
	$rsdb[content]=editor_replace($rsdb[content]);
	

	//页面显示设置
	if(!$web_admin&&!$groupdb[SetArticleTpl])
	{
		$readonly=' readonly ';
	}

	if($aid){
		//辅栏目内容检查处理
		$query = $db->query("SELECT * FROM {$_pre}fu_article WHERE aid='$aid'");
		while($rs = $db->fetch_array($query)){
			$fu_fiddb[]=$rs[fid];
		}
	}
	$fu_sort=$Guidedb->Checkbox("{$_pre}fu_sort",'fu_fiddb[]',$fu_fiddb);
}
?>