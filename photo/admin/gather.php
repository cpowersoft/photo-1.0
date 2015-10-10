<?php
!function_exists('html') && exit('ERR');
set_time_limit(0);
error_reporting(0);

ck_power('gather');

if($job=="list")
{
	if(!$page){
		$page=1;
	}
	$rows=20;
	$min=($page-1)*$rows;

	$query = $db->query("SELECT * FROM {$_pre}gather_rule ORDER BY id DESC LIMIT $min,$rows");
	while($rs = $db->fetch_array($query)){
		$rs[posttime]=date("Y-m-d",$rs[posttime]);
		$listdb[]=$rs;
	}
	$showpage=getpage("{$_pre}gather_rule",'',"$admin_path&fid=$fid&job=list",$rows);

	get_admin_html('list',true);
}
elseif($job=="edit_page")
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");

	$show_spe2pagedb[intval($rsdb[show_spe2page])]='checked';
	
	get_admin_html('edit_page',true);
}
elseif($action=="edit_page")
{
	if($first_page&&$second_page){
		$i=0;
		do{
			$do=true;
			if($first_page[$i]!=$second_page[$i]){
				$show_firstpage=substr($first_page,$i);
				preg_match("/([\d]+)/",substr($second_page,$i),$array);
				if($array[0]==2){
					$show_spe2page=0;
				}else{
					$show_spe2page=1;
				}
				$show_morepage = str_replace($array[0],'[page]',substr($second_page,$i));
				$do=false;
			}
			$i++;			
		}
		while($do);
	}
	$db->query("UPDATE `{$_pre}gather_rule` SET show_morepage='$show_morepage',show_firstpage='$show_firstpage',show_spe2page='$show_spe2page' WHERE id='$id'");

	jump("���óɹ�","$admin_path&job=list",1);
}
elseif($job=="add_title")
{
	$link_noinclude_word="<";
	$page_step=1;
	$webname="���ɼ�����վ����";
	$rulepage='0';
	$charset_typedb[0]=' checked ';

	get_admin_html('edit_title',true);
}
elseif($action=="add_title")
{
	if($rulepage==0&&!$listmoreurl){
		showmsg("Ҫ�ɼ�����ַ����Ϊ��");
	}elseif($rulepage&&!$listurl){
		showmsg("Ҫ�ɼ���ͨ����ַ����Ϊ��");
	}
	if(!$title_rule){
		showmsg("�Զ��������﷨������Ϊ��");
	}elseif(!strstr($title_rule,'{url=')||!strstr($title_rule,'{title=')){
		showmsg("��������д�Զ��������﷨");
	}
	if( !$db->get_one("SELECT * FROM `{$_pre}gather_rule` WHERE posttime='$posttime' ") ){
		$db->query("INSERT INTO `{$_pre}gather_rule` ( `type` , `filetype` , `webname` , `listurl` , `firstpage` , `page_begin` , `page_end` , `page_step` , `listmoreurl` , `link_include_word` , `link_noinclude_word` , `link_replace_word` , `title_replace_word` , `list_begin_code` , `list_end_code` , `list_begin_preg` , `list_end_preg` , `gatherthesame` , `title_minleng` , `show_end_preg` , `show_begin_code` , `show_end_code` , `show_replace_word` , `show_morepage` , `posttime` , `list`,title_rule,charset_type,fid ) 
		VALUES (
		'$type','$filetype','$webname','$listurl','$firstpage','$page_begin','$page_end','$page_step','$listmoreurl','$link_include_word','$link_noinclude_word','$link_replace_word','$title_replace_word','$list_begin_code','$list_end_code','$list_begin_preg','$list_end_preg','$gatherthesame','$title_minleng','$show_end_preg','$show_begin_code','$show_end_code','$show_replace_word','$show_morepage','$posttime','$timestamp','$title_rule','$charset_type','$fid'
		)");
	}else{
		$db->query("UPDATE `{$_pre}gather_rule` SET webname='$webname',listurl='$listurl',firstpage='$firstpage',page_begin='$page_begin',page_end='$page_end',page_step='$page_step',listmoreurl='$listmoreurl',link_include_word='$link_include_word',link_noinclude_word='$link_noinclude_word',link_replace_word='$link_replace_word',title_replace_word='$title_replace_word',list_begin_code='$list_begin_code',list_end_code='$list_end_code',list_begin_preg='$list_begin_preg',list_end_preg='$list_end_preg',title_minleng='$title_minleng',title_rule='$title_rule',charset_type='$charset_type',fid='$fid' WHERE posttime='$posttime'");
	}
	$rs=$db->get_one("SELECT id FROM {$_pre}gather_rule WHERE posttime='$posttime' ");
	if($testgather){
		jump("���ڲ��Բɼ�����,�����ĵȴ�","$admin_path&action=gather_title&id=$rs[id]&showurl=1",1);
	}
	jump("������һ��","$admin_path&job=edit_content&id=$rs[id]",1);
}
elseif($job=="edit_title")
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");


	foreach($rsdb AS $key=>$value){
		$rsdb[$key] = editor_replace($rsdb[$key]);
	}

	@extract($rsdb);
	if($listurl){
		$rulepage='1';
	}else{
		$rulepage='0';
	}
	$charset_typedb[intval($rsdb[charset_type])]=' checked ';

	get_admin_html('edit_title',true);
}
elseif($action=="edit_title")
{
	$db->query("UPDATE `{$_pre}gather_rule` SET webname='$webname',listurl='$listurl',firstpage='$firstpage',page_begin='$page_begin',page_end='$page_end',page_step='$page_step',listmoreurl='$listmoreurl',link_include_word='$link_include_word',link_noinclude_word='$link_noinclude_word',link_replace_word='$link_replace_word',title_replace_word='$title_replace_word',list_begin_code='$list_begin_code',list_end_code='$list_end_code',list_begin_preg='$list_begin_preg',list_end_preg='$list_end_preg',title_minleng='$title_minleng',title_rule='$title_rule',charset_type='$charset_type',fid='$fid' WHERE id='$id'");
	if($testgather){
		jump("���ڲ��Բɼ�����,�����ĵȴ�","$admin_path&action=gather_title&id=$id&showurl=1",1);
	}
	jump("������һ��������ϸ����","$admin_path&job=edit_content&id=$id",1);
}
elseif($job=="edit_content")
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");
	
	foreach($rsdb AS $key=>$value){
		$rsdb[$key] = editor_replace($rsdb[$key]);
	}

	@extract($rsdb);
	
	$type || $type='article';
	$typedb[$type]=" checked ";
	$gatherthesame=intval($gatherthesame);
	$gatherthesamedb[$gatherthesame]=" checked ";
	$show_spe2page=intval($show_spe2page);
	$show_spe2pagedb[$show_spe2page]=" checked ";

	get_admin_html('edit_content',true);
}
elseif($action=="edit_content")
{
	if($content_rule){
		if( strstr($content_rule,"*}{*}")||strstr($content_rule,"{*}{") ){
			showmsg("���������ͨ������ֶ�ͨ���֮��,����������ͨ���֮��,����Ҫ��HTML�������");
		}
	}
	$fixsystem || $fixsystem='article';
	$db->query("UPDATE {$_pre}gather_rule SET  type='$type',gatherthesame='$gatherthesame',show_begin_preg='$show_begin_preg',show_end_preg='$show_end_preg',show_endfile_preg='$show_endfile_preg',show_begin_code='$show_begin_code',show_end_code='$show_end_code',show_replace_word='$show_replace_word',copypic='$copypic',sort='$sort',file_includeword='$file_includeword',file_noincludeword='$file_noincludeword',file_picwidth='$file_picwidth',fixsystem='$fixsystem',file_star_string='$file_star_string',content_rule='$content_rule',file_rule='$file_rule' WHERE id='$id'");
	if($testgather){
		jump("�����ĵȴ�,�Ȳɼ�����,���ٵ��ѡ����Բɼ�","$admin_path&action=gather_title&id=$id&testgather=$testgather",1);
	}
	if($content_rule){
		preg_match_all("/\{([a-z\*=]+)\}/is",$content_rule,$array);
		foreach($array[1] AS $key=>$value){
			if($value!='*'){
				$v0=$array[1][$key-1];
				$v1=$array[1][$key+1];
				if( ($v0&&$v0!='*')||($v1&&$v1!='*') ){
					if( ($v0&&$v0!='*') ){
						$MSG="��{{$value}}���롰{{$v0}}��";
					}else{
						$MSG="��{{$value}}���롰{{$v1}}��";
					}
					jump("<font color=red>����::�������ύ,���п��ܲɼ����ɹ�,��Ϊ��������ֶ�ͨ���{$MSG}֮��,û��ʹ�ò��������ͨ���{*},��������Ǳ���Ҫʹ�õ�</font>","$admin_path&job=list",60);
				}
			}
		}
	}
	jump("�޸ĳɹ�,��һ������Խ���ÿƪ����ҳ�Ķ�ҳ�ɼ�����","$admin_path&job=edit_page&id=$id",3);
}
elseif($action=="gather_title")
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");
	$page=intval($page);
	if(!$page){
		if($rsdb[listmoreurl]){
			$detail=explode("\r\n",$rsdb[listmoreurl]);
			foreach( $detail AS $key=>$value){
				$allurldb[]="\$urldb[]='$value';";
			}
			$allurl=implode("\r\n",$allurldb);
		}else{
			$rsdb[page_step] || $rsdb[page_step]=1;
			
			for($i=$rsdb[page_begin];$i<=$rsdb[page_end];$i++ ){
				if($rsdb[page_begin]==0){
					$II=($i-1)*$rsdb[page_step];
				}else{
					$II=($i-1)*$rsdb[page_step]+1;
				}
				
				$value=str_replace("[page]","$II",$rsdb[listurl]);
				if($i==1&&$rsdb[firstpage]){
					$value=$rsdb[firstpage];
				}
				$allurldb[]="\$urldb[]='$value';";
			}//print_R($allurldb);  die($allurldb);
			$allurl=implode("\r\n",$allurldb);
		}
		write_file(Mpath."cache/gather_morepage.php","<?php\r\n".$allurl);
		write_file(Mpath."cache/gather_title.php","<?php\r\n");
		if($rsdb[list_begin_preg]){
			write_file(Mpath."cache/gather_list.begin_preg.php","<?php\r\n$rsdb[list_begin_preg]");
		}
		if($rsdb[list_end_preg]){
			write_file(Mpath."cache/gather_list.end_preg.php","<?php\r\n$rsdb[list_end_preg]");
		}
		if($rsdb[show_begin_preg]){
			write_file(Mpath."cache/gather_show.begin_preg.php","<?php\r\n$rsdb[show_begin_preg]");
		}
		if($rsdb[show_end_preg]){
			write_file(Mpath."cache/gather_show.end_preg.php","<?php\r\n$rsdb[show_end_preg]");
		}
		if($rsdb[show_endfile_preg]){
			write_file(Mpath."cache/gather_show.endfile_preg.php","<?php\r\n$rsdb[show_endfile_preg]");
		}
	}
	@include(Mpath."cache/gather_morepage.php");
	$listurl=$urldb[$page];
	if($code=sockOpenUrl($listurl))
	{
	}
	elseif($code=file($listurl))
	{
		$code=implode("",$code);
	}
	elseif(copy($listurl,Mpath."cache/gather_cache.php"))
	{
		$code=read_file(Mpath."cache/gather_cache.php");
	}
	elseif($code=file_get_contents($listurl))
	{
	}
	else
	{
		echo("�ɼ�ʧ��<br><br><br><br><br><br><br><br><br><br>");
	}

	//Ҫ�ɼ�����վ���Լ�����վ���벻һ�µ�ʱ��.
	if($rsdb[charset_type]==1){
		if(WEB_LANG=='utf-8'){
			require_once(ROOT_PATH."inc/class.chinese.php");
			$cnvert = new Chinese("GB2312","UTF8",$code,ROOT_PATH."./inc/gbkcode/");
			$code = $cnvert->ConvertIT();
		}else{
			require_once(ROOT_PATH."inc/class.chinese.php");
			$cnvert = new Chinese("UTF8","GB2312",$code,ROOT_PATH."./inc/gbkcode/");
			$code = $cnvert->ConvertIT();
		}
	}

	//��ͷ����
	if($rsdb[list_begin_preg]){
		$htmlcode=$code;	//�����ⲿ�������ı����Ƚ�ͳһ
		include(Mpath."cache/gather_list.begin_preg.php");
		$code=$htmlcode;
	}
	
	//��ȡ��ĳ���ַ���ʼ����β������
	if($rsdb[list_begin_code]){
		$code=strstr($code,$rsdb[list_begin_code]);
	}

	//ȥ��ĳ���ַ����������
	if($rsdb[list_end_code]){
		$end_content=strstr($code,$rsdb[list_end_code]);
		$code=str_replace($end_content,"",$code);
	}

	//�滻һЩ�ַ�
	if($rsdb[title_replace_word]){
		$detail=explode("\r\n",$rsdb[title_replace_word]);
		foreach($detail AS $key=>$value){
			list($oldword,$newword)=explode("|",$value);
			$code=str_replace($oldword,$newword,$code);
		}
	}

	//�û��Զ�������
	if($rsdb[title_rule])
	{
		//�ѿհ׶�ȥ��,���㴦��
		$rsdb[title_rule]=clean_blank($rsdb[title_rule]);
		$code=clean_blank($code);

		//��ȡ������Ĺ�������
		preg_match_all("/\{(.*?)\}/is",$rsdb[title_rule],$array);
		
		//��ȡ����
		foreach( $array[1] AS $key=>$value){
			if( !ereg("^NO",$value)&&!ereg("^\*",$value) ){
				$detail=explode("=",$value);
				$ruledb[++$key]=$detail[0];
			}
		}
		
		//��ȡ�������ʹ�õĹ���
		$rule = get_rule($rsdb[title_rule]);

		//�Բɼ������ݸ����������У��
		preg_match_all("/$rule/is",$code,$array2);

		//��ȡ���õ�����
		foreach( $ruledb AS $key=>$value){
			foreach( $array2[$key] AS $key2=>$value2){
				$listdb[$value][]=$value2;
			}
		}
		
		//url��ַ����Ҫ�е�
		$detail_content=$listdb[url];
	}

	else
	{
		$code=str_replace("HREF=","href=",$code);
		$code=str_replace("</A>","</a>",$code);
		$code=str_replace("href='","href=",$code);
		$code=str_replace('href="','href=',$code);
		$detail_content=explode("href=",$code);	
	}


	unset($i,$_url,$_title);
	foreach($detail_content AS $key_content=>$value_content){
		if($rsdb[title_rule])
		{
			$url=$value_content;
			$title=$listdb[title][$key_content];
			$picurl=$listdb[picurl][$key_content];
		}
		else
		{
			if($key_content==0){
				continue;
			}
			$url=preg_replace("/([^'\" >]+)(.*)/is","\\1",$value_content);//echo $url; die();
			$s1_title=strstr($value_content,">");
			$s2_title=strstr($value_content,"</a>");
			$s3_title=str_replace($s2_title,"",$s1_title);
			$title=str_replace(">","",$s3_title);
			$title=substr($s3_title,1,strlen($s3_title)-1);
			$title=preg_replace("/<([^<>]+)>(.*)<([^<>]+)>/is","\\2",$title);
		}


		//������URL�в��ܰ����е��ַ�
		if($rsdb[link_noinclude_word]){
			$detail=explode("\r\n",$rsdb[link_noinclude_word]);
			foreach($detail AS $key=>$value){
				if(!$value){
					continue;
				}
				if(strstr($title,$value)||strstr($url,$value)){
					unset($url,$title);
				}
			}
		}

		//URL�б�������е��ַ�
		if($rsdb[link_include_word]){
			$detail=explode("\r\n",$rsdb[link_include_word]);
			foreach($detail AS $key=>$value){
				if(!$value){
					continue;
				}
				if(!strstr($url,$value)){
					unset($url,$title);
				}
			}
		}

		//���ⲻ��С�ڶ�����
		if($rsdb[title_minleng]){
			if(strlen($title)<$rsdb[title_minleng]+1){
				unset($url,$title);
			}
		}

		//�����еĵ�ַҪ�滻
		if($rsdb[link_replace_word]){
			$__detail=explode("\r\n",$rsdb[link_replace_word]);
			foreach( $__detail AS $__key=>$__value){
				$__de=explode("|",$__value);
				$url=str_replace($__de[0],$__de[1],$url);
			}
		}

		//�Ե�ַ�������Խ��д���
		if($url&&$title){
			if(!ereg("://",$url)){
				if(ereg("^/",$url)){
					$url=preg_replace("/http:\/\/([^\/]+)(.*)/is","http://\\1",$listurl).$url;
				}else{
					$url=(ereg("\/$",$listurl)?$listurl:str_replace(basename($listurl),"",$listurl)).$url;
				}
				
			}
			if($picurl&&!ereg("://",$picurl)){
				if(ereg("^/",$picurl)){
					$picurl=preg_replace("/http:\/\/([^\/]+)(.*)/is","http://\\1",$listurl).$picurl;
				}else{
					$picurl=str_replace(basename($listurl),"",$listurl).$picurl;
				}
				
			}

			$url=str_replace("'","&#39;",$url);
			$picurl=str_replace("'","&#39;",$picurl);
			$title=str_replace("'","&#39;",$title);
			$_url[]=$url;
			$_title[]=$title;
			if($picurl)
			{
				$UT[]="\$urldb[]='$url\t$title@@$picurl';";
			}
			else
			{
				$UT[]="\$urldb[]='$url\t$title';";
			}
		}
	}
	$writefile=implode("\r\n",$UT);

	//��β����
	if($rsdb[list_end_preg])
	{
		$htmlcode=$writefile;	//�����ⲿ�������ı����Ƚ�ͳһ
		include(Mpath."cache/gather_list.end_preg.php");
		$writefile=$htmlcode;	//�����ⲿ�������ı����Ƚ�ͳһ
	}

	write_file(Mpath."cache/gather_title.php","\r\n".$writefile,'a');
	$page++;
	
	if($urldb[$page]){
		unset($urldb);
		include(Mpath."cache/gather_title.php");
		echo "$listurl<br>���ڲɼ���[{$page}]ҳ�ı�����������ַ,���Ժ�...<hr>";
		foreach( $urldb AS $key=>$value){
			if($key>50){
				break;
			}
			echo "$value<br>";
		}
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$admin_path&action=$action&id=$id&showurl=$showurl&testgather=$testgather&page=$page'>";
		exit;
	}else{
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$admin_path&showurl=$showurl&testgather=$testgather&job=list_title&id=$id'>";
		exit;
	}
}
elseif($job=="list_title")
{
	$rs=$ruledb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");
	if($rs[type]=="jump"){
		$msg="ע��:��ǰ�����ļ����õĲ���:����������ת���ⲿ��ַ,ʹ������󲿷���Ч";
	}elseif($rs[type]=="iframe"){
		$msg="ע��:��ǰ�����ļ����õĲ���:�����������ⲿ��ַ,���ƴ��졢�滢,ʹ������󲿷���Ч";
	}
	if($testgather){
		$autosub="autosub();";
	}
	include(Mpath."cache/gather_title.php");

	$sort_fid=$Guidedb->Select("{$_pre}sort","fid",$fid);

	get_admin_html('list_title',true);
}
elseif($action=="list_title")
{
	include(Mpath."cache/gather_title.php");
	/*
	foreach( $urldb AS $key=>$value){
		if($postdb[$key]){
			$UT[]="\$urldb[]='$value';";
		}
	}
	*/
	//������
	$num=count($urldb)-1;
	for($i=$num;$i>=0;$i--){
		if($postdb[$i]){
			$UT[]="\$urldb[]='{$urldb[$i]}';";
		}
	}
	
	$writefile=implode("\r\n",$UT);
	write_file(Mpath."cache/gather_title.php","<?php\r\n".$writefile);
	$action='gather_content';
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=$admin_path&action=$action&id=$id&system_type=$system_type&GetFile=$GetFile&file_dir=$file_dir&makesmallpic=$makesmallpic&showpic=$showpic&username=$username&fid=$fid&testgather=$testgather&page=$page'>";
	exit;
}
elseif($action=="gather_content")
{
	unset($urldb);
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");
	@include(Mpath."cache/gather_title.php");
	$page=intval($page);
	//$morepage����0ʱ.�����ҳ
	list($curl,$title,$morepage)=explode("\t",$urldb[$page]);

	if($show_content=sockOpenUrl($curl))
	{
	}
	elseif($show_content=file($curl))
	{
		$show_content=implode("",$show_content);
	}
	elseif(copy($curl,Mpath."cache/gather_cache.php"))
	{
		$show_content=read_file(Mpath."cache/gather_cache.php");
	}
	elseif($show_content=file_get_contents($curl))
	{
	}
	else
	{
		echo("��������ȡ����Զ���ļ���Ϣ,����ɼ�ʧ��$curl<br><br><br><br><br><br><br><br><br><br>");
	}
	
	//UTF8->GBK
	if($rsdb[charset_type]==1){
		if(WEB_LANG=='utf-8'){
			require_once(ROOT_PATH."inc/class.chinese.php");
			$cnvert = new Chinese("GB2312","UTF8",$show_content,ROOT_PATH."./inc/gbkcode/");
			$show_content = $cnvert->ConvertIT();
		}else{
			require_once(ROOT_PATH."inc/class.chinese.php");
			$cnvert = new Chinese("UTF8","GB2312",$show_content,ROOT_PATH."./inc/gbkcode/");
			$show_content = $cnvert->ConvertIT();
		}
	}

	//��һƪ��ҳ�Ĵ���,ֻ���ڵ�һҳ��ʱ����.�ڶ�ҳ�Ͳ���Ҫ��
	if($rsdb[show_morepage]&&!$morepage){
		$i=1;
		unset($moreurl_db);
		do{
			$i++;
			//����ҳ���һҳ�Ĳ�֮ͬ�����滻�õ���ҳ����ʵ��ַ
			
			if($rsdb[show_firstpage]){
				$nexturl=str_replace($rsdb[show_firstpage],str_replace("[page]",$i,$rsdb[show_morepage]),$curl);
			}else{
				$nexturl=preg_replace("/(.*)([^\d]+)([\d]*)$/is","\\1\\2",$curl).str_replace("[page]",$i,$rsdb[show_morepage]);
			}
			
			
			//��һЩ�������վ����.�����һҳ��index.htm�ڶ�ҳ��Ȼ��index_1.htm
			if($i==2&&$rsdb[show_spe2page]){
				$tsurl=str_replace($rsdb[show_firstpage],str_replace("[page]",1,$rsdb[show_morepage]),$curl);
				if( strstr($show_content,basename($tsurl)) ){
					$moreurl_db[$page][]="$tsurl\t$title\t1";
				}
			}
			if(strstr($show_content,basename($nexturl))){
				$moreurl_db[$page][]="$nexturl\t$title\t$i";
			}elseif($i<5&&file_get_contents($nexturl)){	//����һЩ��������ҳ���г��������
				$moreurl_db[$page][]="$nexturl\t$title\t$i";
			}else{
				$i=0;
			}
		}
		while($i!=0);
		if(is_array($moreurl_db[$page])){
			//��ԭҪ�ɼ��������´���,��Ϊ�����˷�ҳ
			foreach($urldb AS $key=>$value){
				$_urlDB[]="\$urldb[]='$value';";
				if($page==$key&&is_array($moreurl_db[$key])){
					foreach($moreurl_db[$key] AS $key2=>$value2){
						$_urlDB[]="\$urldb[]='$value2';";
					}
				}
				
			}
			$write_file=implode("\r\n",$_urlDB);
			write_file(Mpath."cache/gather_title.php","<?php\r\n$write_file");
			unset($urldb);
			include(Mpath."cache/gather_title.php");
		}
	}

	//����ǰ�����Ч����
	if($rsdb[show_begin_code]){
		$show_content=substr(strstr($show_content,$rsdb[show_begin_code]),strlen($rsdb[show_begin_code]));
	}
	//���˺������Ч����
	if($rsdb[show_end_code]){
		$show_content=str_replace(strstr($show_content,$rsdb[show_end_code]),'',$show_content);
	}

	//��ͷ��������
	if($rsdb[show_begin_preg]){
		$htmlcode=$show_content;
		include(Mpath."cache/gather_show.begin_preg.php");
		$show_content=$htmlcode;
	}

	//�������岿��,�û��Զ�������
	if($rsdb[content_rule])
	{

		//�ѿհ׶�ȥ��,���㴦��
		$rsdb[content_rule]=clean_blank($rsdb[content_rule]);
		$show_content=clean_blank($show_content);

		//��ȡ������Ĺ�������
		preg_match_all("/\{(.*?)\}/is",$rsdb[content_rule],$array);
	
		//��ȡ����
		foreach( $array[1] AS $key=>$value){
			if( !ereg("^NO",$value)&&!ereg("^\*",$value) ){
				$detail=explode("=",$value);
				$ruledb[++$key]=$detail[0];
			}
		}
	
		//��ȡ�������ʹ�õĹ���
		$rule = get_rule($rsdb[content_rule]);

		//�Բɼ������ݸ����������У��
		preg_match_all("/$rule/is",$show_content,$array2);
		
	
		//��ȡ���õ�����
		foreach( $ruledb AS $key=>$value){
			foreach( $array2[$key] AS $key2=>$value2){
				$listdb[$value][]=$value2;
			}
		}
		
		//���û��Զ���ı�����ȡ����
		foreach( $listdb AS $key=>$value){
			$$key=$value[0];
			//$gather_module_valeDB[$key]=$value[0];	//Ϊ����ģ���ֶβɼ�������
		}

		$show_content=$content;
	}


	//�û��Զ�������,��ȡͼƬ
	if($rsdb[file_rule])
	{
		$show_content=clean_blank($show_content);

		//�ѿհ׶�ȥ��,���㴦��
		$rsdb[file_rule]=clean_blank($rsdb[file_rule]);

		//��ȡ������Ĺ�������
		preg_match_all("/\{(.*?)\}/is",$rsdb[file_rule],$array);
	
		//��ȡ����
		unset($ruledb);
		foreach( $array[1] AS $key=>$value){
			if( !ereg("^NO",$value)&&!ereg("^\*",$value) ){
				$detail=explode("=",$value);
				$ruledb[++$key]=$detail[0];
			}
		}
	
		//��ȡ�������ʹ�õĹ���
		$rule = get_rule($rsdb[file_rule]);

		//�Բɼ������ݸ����������У��
		preg_match_all("/$rule/is",$show_content,$array2);
	
		unset($listdb);
		//��ȡ���õ�����
		foreach( $ruledb AS $key=>$value){
			foreach( $array2[$key] AS $key2=>$value2){
				$listdb[$value][]=$value2;
			}
		}
		
		//���û��Զ���ı�����ȡ����
		foreach( $listdb AS $key=>$value){
			//$$key=implode('',$value);
			//$$key=$value[0];
			//$gather_module_valeDB[$key]=$value[0];	//Ϊ����ģ���ֶβɼ�������
		}

		$picDB=$listdb[photourl];	//��ȡ��ͼƬ����
	}

	//����ͼƬURL�в���Ҫ������
	if($rsdb[show_replace_word]){
		$detail=explode("\r\n",$rsdb[show_replace_word]);
		foreach($detail AS $key=>$value){
			list($oldword,$newword)=explode("|",$value);
			foreach($picDB AS $_key=>$_value){
				$picDB[$_key]=str_replace($oldword,$newword,$picDB[$_key]);
			}				
		}
	}

	
	//��β��������
	if($rsdb[show_end_preg]){
		$htmlcode=$show_content;
		include(Mpath."cache/gather_show.end_preg.php");
		$show_content=$htmlcode;
	}

	foreach($picDB AS $key=>$value){
		
		//URL��ͷ����������ַ�
		if($rsdb[file_star_string]&&strstr($value,$rsdb[file_star_string])!=$value){
			unset($picDB[$key]);
			continue;
		}
		
		//URL���б���������ַ�
		if($rsdb[file_includeword]&&!strstr($value,$rsdb[file_includeword])){
			unset($picDB[$key]);
			continue;
		}
		
		//URL���в��ܰ������ַ�
		if($rsdb[file_noincludeword]&&strstr($value,$rsdb[file_noincludeword])){
			unset($picDB[$key]);
			continue;
		}

		//���ļ���ַ�����Ե�ַ����
		if(!ereg("^http://",$value)){
			if(ereg("^/",$value)){
				$picDB[$key]=$value=preg_replace("/http:\/\/([^\/]+)(.*)/is","http://\\1",$curl).$value;
			}else{
				$picDB[$key]=$value=str_replace(basename($curl),'',$curl).$value;
			}	
		}
	}

	
	//��β����,����ֱ��ͨ�������ȡ�ļ���ַ
	if($rsdb[show_endfile_preg]){
		$htmlcode=$show_content;
		include(Mpath."cache/gather_show.endfile_preg.php");
		$show_content=$htmlcode;
	}



	//�ɼ������
	foreach((array)$picDB AS $key2=>$fileurl){
		echo "<A HREF='$fileurl' target=_blank>$fileurl</A><hr>";
	}

	$content=$show_content;

	//�����Ե�ʱ��.���,����Ҫ��ͼƬ�����
	if(!$testgather && $picDB){
		include(dirname(__FILE__)."/gather.inc.php");
	}
	
	$page++;
	if($urldb[$page]){
		$p=$page-1;
		//ֻ��ʾ���ַ����û��鿴�ɼ����
		$testgather || $content=get_word($content,1000);
		$content=filtrate($content);
		echo "��Դ:<A HREF='{$curl}' target='_blank'>{$curl}</A><hr>";
		echo "���ڲɼ���[$page]ҳ,�����ĵȴ�...<A HREF={$urldb[$p]} target=_blank>{$urldb[$p]}</A><hr>$content";
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=$admin_path&action=$action&id=$id&system_type=$system_type&GetFile=$GetFile&file_dir=$file_dir&makesmallpic=$makesmallpic&showpic=$showpic&username=$username&fid=$fid&testgather=$testgather&page=$page'>";
		exit;
	}else{
		$num=count($urldb);
		if($testgather){
			jump("���Բɼ����,ģ���ܹ��ɼ���{$num}ƪ,��ʵû�������ݿ�","$admin_path&job=list",20);
		}else{
			jump("�ɼ����,�ܹ��ɼ���{$num}ƪ","$admin_path&job=list",10);
		}
	}
	
}
elseif($job=="addrulesql")
{

	get_admin_html('addrulesql',true);

}
elseif($action=='addrulesql')
{	
	if(strstr($sqlcode,"'")){
		$sqlcode=StripSlashes($sqlcode);
	}else{
		$sqlcode=urldecode($sqlcode);
	}
	$sqlcode=str_replace('p8_gather_rule',"{$_pre}gather_rule",$sqlcode);	//���ݾɰ�
	$sqlcode=str_replace('qb_gather_rule',"{$_pre}gather_rule",$sqlcode);
	$db->query($sqlcode);
	jump("����ղ�ҳ��û�б���,�ǹ�ϲ��,����ɹ�","$admin_path&job=list",1);
}
elseif($job=='sharerulesql')
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}gather_rule WHERE id='$id'");
	foreach($rsdb AS $key=>$value){
		$rsdb[$key]=mysql_escape_string($value);
	}
	extract($rsdb);
	$SQL="INSERT INTO `{$_pre}gather_rule` ( `fid` , `type` , `fixsystem` , `filetype` , `webname` , `listurl` , `firstpage` , `page_begin` , `page_end` , `page_step` , `title_minleng` , `listmoreurl` , `link_include_word` , `link_noinclude_word` , `link_replace_word` , `title_replace_word` , `list_begin_code` , `list_end_code` , `list_begin_preg` , `list_end_preg` , `gatherthesame` , `show_begin_preg` , `show_end_preg` , `show_endfile_preg` , `show_begin_code` , `show_end_code` , `show_replace_word` , `show_morepage` , `show_firstpage` , `show_spe2page` , `posttime` , `list` , `copypic` , `sort` , `file_includeword` , `file_noincludeword` , `file_picwidth` , `file_star_string` , `title_rule` , `content_rule` , `title_morepage_rull` , `content_morepage_rull` , `charset_type` , `file_rule` ) VALUES ('$fid','$type','$fixsystem','$filetype','$webname','$listurl','$firstpage','$page_begin','$page_end','$page_step','$title_minleng','$listmoreurl','$link_include_word','$link_noinclude_word','$link_replace_word','$title_replace_word','$list_begin_code','$list_end_code','$list_begin_preg','$list_end_preg','$gatherthesame','$show_begin_preg','$show_end_preg','$show_endfile_preg','$show_begin_code','$show_end_code','$show_replace_word','$show_morepage','$show_firstpage','$show_spe2page','$posttime','$list','$copypic','$sort','$file_includeword','$file_noincludeword','$file_picwidth','$file_star_string','$title_rule','$content_rule','$title_morepage_rull','$content_morepage_rull','$charset_type','$file_rule');";
	$SQL=urlencode($SQL);

	get_admin_html('sharerulesql',true);
}
elseif($action=="deleterule")
{
	$db->query("DELETE FROM {$_pre}gather_rule WHERE id='$id'");
	jump("ɾ���ɹ�","$admin_path&job=list",1);
}



 


function get_rule($string){
	$string=str_replace('\\','\\\\',$string);
	$string=str_replace("(","\(",$string);
	$string=str_replace(")","\)",$string);
	$string=str_replace("[","\[",$string);
	$string=str_replace("]","\]",$string);
	$string=str_replace('"','\"',$string);
	$string=str_replace('.','\.',$string);
	$string=str_replace('?','\?',$string);
	$string=str_replace('$','\$',$string);
	$string=str_replace('^','\^',$string);
	$string=str_replace('/','\/',$string);
	$string=str_replace('+','\+',$string);
	$string=preg_replace("/\{(.*?)\}/eis","replace_preg('\\1')",$string);
	return $string;
}

function replace_preg($string){
	$string=str_replace('\"','"',$string);
	$rule=$string;
	
	if(ereg("^NO",$rule)){
		$detail=explode("NO",$rule);
		return "([^{$detail[1]}]*)";
	}elseif($rule=='*'){
		return "(.*?)";
	}elseif($rule=='**'){
		return "(.*)";
	}else{
		$detail=explode("=",$string);
		$rule=$detail[1];
		if(ereg("^NO",$rule)){
			$detail=explode("NO",$rule);
			return "([^{$detail[1]}]*)";
		}elseif($rule=='*'){
			return "(.*?)";
		}elseif($rule=='**'){
			return "(.*)";
		}
	}
}

function clean_blank($str){
	$str=preg_replace("/([\r\n]*)/is","",$str);
	$str=preg_replace("/>([ \t]*)</is","><",$str);
	$str=preg_replace("/^([ ]*)/is","",$str);
	$str=preg_replace("/([ ]*)$/is","",$str);
	return $str;
}


function get_time($time){
	global $timestamp;
	preg_match_all("/([\d]+)/is",$time,$array);

	//ȱ������ʱ�����ֵĻ�,�ͷ��ص�ǰʱ��
	if( !$array[0][0] || !$array[0][1] || !$array[0][2] ){
		return $timestamp;
	}

	$y=intval($array[0][0]);
	$m=intval($array[0][1]);
	$d=intval($array[0][2]);
	$h=intval($array[0][3]?$array[0][3]:'00');
	$i=intval($array[0][4]?$array[0][4]:'00');
	$s=intval($array[0][5]?$array[0][5]:'00');

	$time=preg_replace("/([\d]+)-([\d]+)-([\d]+) ([\d]+):([\d]+):([\d]+)/eis","mk_time('\\4','\\5', '\\6', '\\2', '\\3', '\\1')","$y-$m-$d $h:$i:$s");

	return $time;
}

?>