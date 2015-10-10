INSERT INTO `qb_module` (`id`, `type`, `name`, `pre`, `dirname`, `domain`, `admindir`, `config`, `list`, `admingroup`, `adminmember`, `ifclose`) VALUES (31, 2, 'CMS图库', 'photo_', 'photo', '', '', 'a:7:{s:12:"list_PhpName";s:18:"list.php?&fid=$fid";s:12:"show_PhpName";s:29:"bencandy.php?&fid=$fid&id=$id";s:8:"MakeHtml";s:1:"0";s:14:"list_HtmlName1";s:23:"html/{$fid}/{$page}.htm";s:14:"show_HtmlName1";s:38:"html/{$fid}/{$dirid}/{$id}/{$page}.htm";s:14:"list_HtmlName2";s:36:"list.php?fid-{$fid}-page-{$page}.htm";s:14:"show_HtmlName2";s:49:"bencandy.php?fid-{$fid}-id-{$id}-page-{$page}.htm";}', 0, '', '', 0);



INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_rollpic', 'rollpic', 0, 'a:6:{s:8:"rolltype";s:1:"0";s:5:"width";s:3:"298";s:6:"height";s:3:"238";s:6:"picurl";a:2:{i:1;s:32:"label/1_20101110141134_yuvgy.jpg";i:2;s:32:"label/1_20101110141112_eb6bm.jpg";}s:7:"piclink";a:2:{i:1;s:1:"#";i:2;s:1:"#";}s:6:"picalt";a:2:{i:1;s:0:"";i:2;s:0:"";}}', 'a:3:{s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t1', 'Info_photo_', 1, 'a:35:{s:13:"tplpart_1code";s:313:"	<div class="listpic">\r\n                	<div class="img"><a href="$url" target="_blank"><img src="$picurl" onerror="this.src=\'$webdb[www_url]/images/default/nopic.jpg\'" width="125" height="90"/></a></div>\r\n                    <div class="t"><a href="$url" target="_blank">$title</a></div>\r\n                </div>";s:13:"tplpart_2code";s:0:"";s:3:"SYS";s:3:"CMS";s:3:"PRE";s:6:"photo_";s:5:"ctype";s:7:"article";s:13:"RollStyleType";s:0:"";s:7:"fidtype";s:1:"0";s:8:"rolltype";s:10:"scrollLeft";s:8:"rolltime";s:1:"3";s:11:"roll_height";s:2:"50";s:5:"width";s:3:"250";s:6:"height";s:3:"187";s:7:"newhour";s:2:"24";s:7:"hothits";s:3:"100";s:7:"amodule";N;s:7:"tplpath";s:0:"";s:6:"DivTpl";i:1;s:5:"fiddb";N;s:5:"stype";s:1:"p";s:2:"yz";s:1:"1";s:7:"hidefid";N;s:10:"timeformat";s:11:"Y-m-d H:i:s";s:5:"order";s:6:"A.list";s:3:"asc";s:4:"DESC";s:6:"levels";s:3:"all";s:7:"rowspan";s:1:"6";s:3:"sql";s:123:" SELECT A.*,A.aid AS id FROM qb_photo_article A  WHERE A.yz=1  AND A.ispic=1   AND A.ispic=1  ORDER BY A.list DESC LIMIT 6 ";s:4:"sql2";N;s:7:"colspan";s:1:"1";s:11:"content_num";s:2:"80";s:12:"content_num2";s:3:"120";s:8:"titlenum";s:2:"30";s:9:"titlenum2";s:2:"40";s:10:"titleflood";s:1:"0";s:10:"c_rolltype";s:1:"0";}', 'a:3:{s:5:"div_w";s:3:"442";s:5:"div_h";s:3:"263";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 1299829615, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t10', 'code', 0, '<a href="#">更多...</a>', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t11', 'code', 0, '<a href="#" class="sort choose"><span>国内</span></a>\r\n                <a href="#" class="sort"><span>国际</span></a>\r\n                <a href="#" class="sort"><span>女性</span></a>\r\n                <a href="#" class="sort"><span>娱乐时尚</span></a>\r\n                <a href="#" class="sort"><span>军事</span></a>\r\n                <a href="#" class="sort"><span>社会</span></a>\r\n                <a href="#" class="sort"><span>文化</span></a>\r\n                <a href="#" class="sort"><span>奇趣</span></a>', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t2', 'Info_photo_', 1, 'a:35:{s:13:"tplpart_1code";s:312:"<div class="listpic">\r\n                	<div class="img"><a href="$url" target="_blank"><img src="$picurl" onerror="this.src=\'$webdb[www_url]/images/default/nopic.jpg\'" width="120" height="90"/></a></div>\r\n                    <div class="t"><a href="$url" target="_blank">$title</a></div>\r\n                </div>";s:13:"tplpart_2code";s:0:"";s:3:"SYS";s:3:"CMS";s:3:"PRE";s:6:"photo_";s:5:"ctype";s:7:"article";s:13:"RollStyleType";s:0:"";s:7:"fidtype";s:1:"0";s:8:"rolltype";s:10:"scrollLeft";s:8:"rolltime";s:1:"3";s:11:"roll_height";s:2:"50";s:5:"width";s:3:"250";s:6:"height";s:3:"187";s:7:"newhour";s:2:"24";s:7:"hothits";s:3:"100";s:7:"amodule";N;s:7:"tplpath";s:0:"";s:6:"DivTpl";i:1;s:5:"fiddb";N;s:5:"stype";s:1:"p";s:2:"yz";s:1:"1";s:7:"hidefid";N;s:10:"timeformat";s:11:"Y-m-d H:i:s";s:5:"order";s:6:"A.list";s:3:"asc";s:4:"DESC";s:6:"levels";s:3:"all";s:7:"rowspan";s:2:"15";s:3:"sql";s:124:" SELECT A.*,A.aid AS id FROM qb_photo_article A  WHERE A.yz=1  AND A.ispic=1   AND A.ispic=1  ORDER BY A.list DESC LIMIT 15 ";s:4:"sql2";N;s:7:"colspan";s:1:"1";s:11:"content_num";s:2:"80";s:12:"content_num2";s:3:"120";s:8:"titlenum";s:2:"30";s:9:"titlenum2";s:2:"40";s:10:"titleflood";s:1:"0";s:10:"c_rolltype";s:1:"0";}', 'a:3:{s:5:"div_w";s:3:"738";s:5:"div_h";s:3:"386";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 1299829650, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t3', 'Info_photo_', 1, 'a:35:{s:13:"tplpart_1code";s:68:"<div class="lista$i"><a href="$url" target="_blank">$title</a></div>";s:13:"tplpart_2code";s:0:"";s:3:"SYS";s:3:"CMS";s:3:"PRE";s:6:"photo_";s:5:"ctype";s:7:"article";s:13:"RollStyleType";s:0:"";s:7:"fidtype";s:1:"0";s:8:"rolltype";s:10:"scrollLeft";s:8:"rolltime";s:1:"3";s:11:"roll_height";s:2:"50";s:5:"width";s:3:"250";s:6:"height";s:3:"187";s:7:"newhour";s:2:"24";s:7:"hothits";s:3:"100";s:7:"amodule";N;s:7:"tplpath";s:0:"";s:6:"DivTpl";i:1;s:5:"fiddb";N;s:5:"stype";s:1:"4";s:2:"yz";s:1:"1";s:7:"hidefid";N;s:10:"timeformat";s:11:"Y-m-d H:i:s";s:5:"order";s:6:"A.list";s:3:"asc";s:4:"DESC";s:6:"levels";s:3:"all";s:7:"rowspan";s:2:"10";s:3:"sql";s:94:" SELECT A.*,A.aid AS id FROM qb_photo_article A  WHERE A.yz=1   ORDER BY A.list DESC LIMIT 10 ";s:4:"sql2";N;s:7:"colspan";s:1:"1";s:11:"content_num";s:2:"80";s:12:"content_num2";s:3:"120";s:8:"titlenum";s:2:"30";s:9:"titlenum2";s:2:"40";s:10:"titleflood";s:1:"0";s:10:"c_rolltype";s:1:"0";}', 'a:3:{s:5:"div_w";s:3:"192";s:5:"div_h";s:3:"292";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 1299829633, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t4', 'Info_photo_', 1, 'a:35:{s:13:"tplpart_1code";s:68:"<div class="listb$i"><a href="$url" target="_blank">$title</a></div>";s:13:"tplpart_2code";s:0:"";s:3:"SYS";s:3:"CMS";s:3:"PRE";s:6:"photo_";s:5:"ctype";s:7:"article";s:13:"RollStyleType";s:0:"";s:7:"fidtype";s:1:"0";s:8:"rolltype";s:10:"scrollLeft";s:8:"rolltime";s:1:"3";s:11:"roll_height";s:2:"50";s:5:"width";s:3:"250";s:6:"height";s:3:"187";s:7:"newhour";s:2:"24";s:7:"hothits";s:3:"100";s:7:"amodule";N;s:7:"tplpath";s:0:"";s:6:"DivTpl";i:1;s:5:"fiddb";N;s:5:"stype";s:1:"4";s:2:"yz";s:1:"1";s:7:"hidefid";N;s:10:"timeformat";s:11:"Y-m-d H:i:s";s:5:"order";s:6:"A.list";s:3:"asc";s:3:"ASC";s:6:"levels";s:3:"all";s:7:"rowspan";s:2:"11";s:3:"sql";s:93:" SELECT A.*,A.aid AS id FROM qb_photo_article A  WHERE A.yz=1   ORDER BY A.list ASC LIMIT 11 ";s:4:"sql2";N;s:7:"colspan";s:1:"1";s:11:"content_num";s:2:"80";s:12:"content_num2";s:3:"120";s:8:"titlenum";s:2:"30";s:9:"titlenum2";s:2:"40";s:10:"titleflood";s:1:"0";s:10:"c_rolltype";s:1:"0";}', 'a:3:{s:5:"div_w";s:3:"187";s:5:"div_h";s:3:"317";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 1299829668, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t5', 'code', 0, '<a href="#">更多...</a>', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t6', 'code', 0, '<a href="#">更多...</a>', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t7', 'code', 0, '热门图片', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t8', 'code', 0, '最近更新', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');
INSERT INTO `qb_label` (`lid`, `name`, `ch`, `chtype`, `tag`, `type`, `typesystem`, `code`, `divcode`, `hide`, `js_time`, `uid`, `username`, `posttime`, `pagetype`, `module`, `fid`, `if_js`, `style`) VALUES ('', '', 0, 0, 'photo_t9', 'code', 0, '推荐图片', 'a:4:{s:9:"html_edit";N;s:5:"div_w";s:0:"";s:5:"div_h";s:0:"";s:11:"div_bgcolor";s:0:"";}', 0, 0, 1, 'admin', 0, 0, 31, 0, 0, 'default');


# --------------------------------------------------------

#
# 表的结构 `qb_photo_collection`
#

DROP TABLE IF EXISTS `qb_photo_collection`;
CREATE TABLE `qb_photo_collection` (
  `id` mediumint(7) NOT NULL auto_increment,
  `aid` int(10) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_collection`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_comment`
#

DROP TABLE IF EXISTS `qb_photo_comment`;
CREATE TABLE `qb_photo_comment` (
  `cid` mediumint(7) unsigned NOT NULL auto_increment,
  `aid` int(10) unsigned NOT NULL default '0',
  `fid` mediumint(7) unsigned NOT NULL default '0',
  `authorid` mediumint(7) NOT NULL default '0',
  `uid` mediumint(7) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `posttime` int(10) NOT NULL default '0',
  `content` text NOT NULL,
  `ip` varchar(15) NOT NULL default '',
  `icon` tinyint(3) NOT NULL default '0',
  `yz` tinyint(1) NOT NULL default '0',
  `ifcom` tinyint(1) NOT NULL default '0',
  `agree` mediumint(5) NOT NULL default '0',
  `disagree` mediumint(5) NOT NULL default '0',
  PRIMARY KEY  (`cid`),
  KEY `aid` (`aid`),
  KEY `fid` (`fid`),
  KEY `uid` (`uid`),
  KEY `ifcom` (`ifcom`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_comment`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_config`
#

DROP TABLE IF EXISTS `qb_photo_config`;
CREATE TABLE `qb_photo_config` (
  `c_key` varchar(50) NOT NULL default '',
  `c_value` text NOT NULL,
  `c_descrip` text NOT NULL,
  PRIMARY KEY  (`c_key`)
) TYPE=MyISAM;

#
# 导出表中的数据 `qb_photo_config`
#

INSERT INTO `qb_photo_config` VALUES ('Info_webOpen', '1', '');
INSERT INTO `qb_photo_config` VALUES ('showsortlogo', '0', '');
INSERT INTO `qb_photo_config` VALUES ('SPbencandy_filename', 'html/5special{$fid}/show{$id}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('Html_Type', '0', '');
INSERT INTO `qb_photo_config` VALUES ('ListLeng', '70', '');
INSERT INTO `qb_photo_config` VALUES ('Listsortnameline', '2', '');
INSERT INTO `qb_photo_config` VALUES ('ListSonLeng', '34', '');
INSERT INTO `qb_photo_config` VALUES ('SPlist_filename', 'html/4special{$fid}/list{$page}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('bencandy_filename', 'html/{$fid}-{$dirid}/{$id}-{$page}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('list_filename', 'html/{$fid}/{$page}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('showNoPassComment', '1', '');
INSERT INTO `qb_photo_config` VALUES ('DefaultIndexHtml', '1', '');
INSERT INTO `qb_photo_config` VALUES ('ListSonRows', '9', '');
INSERT INTO `qb_photo_config` VALUES ('Info_html_list', 'html/{$fid}/{$page}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('JsListLeng', '36', '');
INSERT INTO `qb_photo_config` VALUES ('JsListRows', '5', '');
INSERT INTO `qb_photo_config` VALUES ('CommentOrderType', '0', '');
INSERT INTO `qb_photo_config` VALUES ('allowMemberCommentPass', '1', '');
INSERT INTO `qb_photo_config` VALUES ('allowGuestCommentPass', '1', '');
INSERT INTO `qb_photo_config` VALUES ('allowGuestComment', '1', '');
INSERT INTO `qb_photo_config` VALUES ('CommentTime', '5', '');
INSERT INTO `qb_photo_config` VALUES ('showCommentRows', '8', '');
INSERT INTO `qb_photo_config` VALUES ('forbidComment', '0', '');
INSERT INTO `qb_photo_config` VALUES ('showComment', '1', '');
INSERT INTO `qb_photo_config` VALUES ('SideTitleStyle', 'side_tpl/2', '');
INSERT INTO `qb_photo_config` VALUES ('SideSortStyle', 'side_sort/2', '');
INSERT INTO `qb_photo_config` VALUES ('heart_time', '30', '');
INSERT INTO `qb_photo_config` VALUES ('ArticleHeart', '欠扁|1.gif\r\n支持|2.gif\r\n很棒|3.gif\r\n找骂|4.gif\r\n搞笑|5.gif\r\n软文|6.gif\r\n不解|7.gif\r\n吃惊|8.gif', '');
INSERT INTO `qb_photo_config` VALUES ('heart_noRecord', '1', '');
INSERT INTO `qb_photo_config` VALUES ('UseArticleHeart', '1', '');
INSERT INTO `qb_photo_config` VALUES ('UseArticleDigg', '0', '');
INSERT INTO `qb_photo_config` VALUES ('ForceDel', '0', '');
INSERT INTO `qb_photo_config` VALUES ('AutoTitleNum', '1', '');
INSERT INTO `qb_photo_config` VALUES ('deleteArticleMoney', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('comArticleMoney', '3', '');
INSERT INTO `qb_photo_config` VALUES ('postArticleMoney', '1', '');
INSERT INTO `qb_photo_config` VALUES ('hotArticleNum', '100', '');
INSERT INTO `qb_photo_config` VALUES ('newArticleTime', '24', '');
INSERT INTO `qb_photo_config` VALUES ('ListShowIcon', '0', '');
INSERT INTO `qb_photo_config` VALUES ('autoGetKeyword', '0', '');
INSERT INTO `qb_photo_config` VALUES ('autoGetSmallPic', '1', '');
INSERT INTO `qb_photo_config` VALUES ('autoCutSmallPic', '1', '');
INSERT INTO `qb_photo_config` VALUES ('ForbidRepeatTitle', '1', '');
INSERT INTO `qb_photo_config` VALUES ('viewNoPassArticle', '0', '');
INSERT INTO `qb_photo_config` VALUES ('ArticlePicHeight', '600', '');
INSERT INTO `qb_photo_config` VALUES ('ArticlePicWidth', '800', '');
INSERT INTO `qb_photo_config` VALUES ('ArticleDownloadDirTime', '0', '');
INSERT INTO `qb_photo_config` VALUES ('ArticleDownloadUseFtp', '0', '');
INSERT INTO `qb_photo_config` VALUES ('SortUseOtherModule', '0', '');
INSERT INTO `qb_photo_config` VALUES ('Info_html_show', 'html/{$fid}-{$dirid}/{$id}-{$page}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('Info_titleName', '', '');
INSERT INTO `qb_photo_config` VALUES ('Limit_postOne', '0', '');
INSERT INTO `qb_photo_config` VALUES ('cache_time_like', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('cache_time_com', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('cache_time_hot', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('cache_time_new', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('showsp_cache_time', '0', '');
INSERT INTO `qb_photo_config` VALUES ('bencandy_cache_time', '0', '');
INSERT INTO `qb_photo_config` VALUES ('list_cache_time', '0', '');
INSERT INTO `qb_photo_config` VALUES ('index_cache_time', '0', '');
INSERT INTO `qb_photo_config` VALUES ('cache_time_pic', '-1', '');
INSERT INTO `qb_photo_config` VALUES ('fulist_cache_time', '0', '');
INSERT INTO `qb_photo_config` VALUES ('module_pre', 'photo_', '');
INSERT INTO `qb_photo_config` VALUES ('module_id', '31', '');
INSERT INTO `qb_photo_config` VALUES ('module_close', '0', '');
INSERT INTO `qb_photo_config` VALUES ('Info_webname', '图库模块', '');
INSERT INTO `qb_photo_config` VALUES ('PostNotice', '<font face=SimSun>\r\n<p><font face=SimSun>1、如果是转载内容，请务必填写稿件来源网址及出处。<br />2、所引起的版权纠纷与法律责任由发布者承担。</font></p></font>', '');
INSERT INTO `qb_photo_config` VALUES ('photoShowType', '0', '');
INSERT INTO `qb_photo_config` VALUES ('allowDownMv', '0', '');
INSERT INTO `qb_photo_config` VALUES ('autoPlayFirstMv', '1', '');
INSERT INTO `qb_photo_config` VALUES ('EditSystem', '2', '');
INSERT INTO `qb_photo_config` VALUES ('XunLei_ID', '08311', '');
INSERT INTO `qb_photo_config` VALUES ('FlashGet_ID', '6370', '');
INSERT INTO `qb_photo_config` VALUES ('ListPageTitle_nojs', '0', '');
INSERT INTO `qb_photo_config` VALUES ('view_sell_article', '0', '');
INSERT INTO `qb_photo_config` VALUES ('IF_Private_tpl', '0', '');
INSERT INTO `qb_photo_config` VALUES ('Private_tpl_head', '', '');
INSERT INTO `qb_photo_config` VALUES ('Private_tpl_foot', '', '');
INSERT INTO `qb_photo_config` VALUES ('ForbidShowPhpPage', '0', '');
INSERT INTO `qb_photo_config` VALUES ('special_show_html', 'html/special{$fid}/show{$id}.htm', '');
INSERT INTO `qb_photo_config` VALUES ('special_list_html', 'html/special{$fid}/list{$page}.htm', '');

# --------------------------------------------------------

#
# 表的结构 `qb_photo_fu_article`
#

DROP TABLE IF EXISTS `qb_photo_fu_article`;
CREATE TABLE `qb_photo_fu_article` (
  `fid` int(7) NOT NULL default '0',
  `aid` int(10) NOT NULL default '0',
  KEY `fid` (`fid`),
  KEY `aid` (`aid`)
) TYPE=MyISAM;

#
# 导出表中的数据 `qb_photo_fu_article`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_fu_sort`
#

DROP TABLE IF EXISTS `qb_photo_fu_sort`;
CREATE TABLE `qb_photo_fu_sort` (
  `fid` mediumint(7) unsigned NOT NULL auto_increment,
  `fup` mediumint(7) unsigned NOT NULL default '0',
  `fmid` mediumint(5) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `class` smallint(4) NOT NULL default '0',
  `sons` smallint(4) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `admin` varchar(100) NOT NULL default '',
  `list` int(10) NOT NULL default '0',
  `listorder` tinyint(2) NOT NULL default '0',
  `passwd` varchar(32) NOT NULL default '',
  `logo` varchar(150) NOT NULL default '',
  `descrip` text NOT NULL,
  `style` varchar(50) NOT NULL default '',
  `template` text NOT NULL,
  `jumpurl` varchar(150) NOT NULL default '',
  `maxperpage` tinyint(3) NOT NULL default '0',
  `metakeywords` varchar(255) NOT NULL default '',
  `metadescription` varchar(255) NOT NULL default '',
  `allowcomment` tinyint(1) NOT NULL default '0',
  `allowpost` varchar(150) NOT NULL default '',
  `allowviewtitle` varchar(150) NOT NULL default '',
  `allowviewcontent` varchar(150) NOT NULL default '',
  `allowdownload` varchar(150) NOT NULL default '',
  `forbidshow` tinyint(1) NOT NULL default '0',
  `config` text NOT NULL,
  `list_html` varchar(255) NOT NULL default '',
  `bencandy_html` varchar(255) NOT NULL default '',
  `domain` varchar(150) NOT NULL default '',
  `domain_dir` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `fup` (`fup`),
  KEY `fmid` (`fmid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_fu_sort`
#


#
# 表的结构 `qb_photo_gather_rule`
#

DROP TABLE IF EXISTS `qb_photo_gather_rule`;
CREATE TABLE `qb_photo_gather_rule` (
  `id` mediumint(7) NOT NULL auto_increment,
  `fid` mediumint(7) NOT NULL default '0',
  `type` varchar(15) NOT NULL default '0',
  `fixsystem` varchar(30) NOT NULL default '',
  `filetype` varchar(50) NOT NULL default '',
  `webname` varchar(150) NOT NULL default '',
  `listurl` varchar(150) NOT NULL default '',
  `firstpage` varchar(150) NOT NULL default '',
  `page_begin` int(10) NOT NULL default '0',
  `page_end` int(10) NOT NULL default '0',
  `page_step` int(10) NOT NULL default '0',
  `title_minleng` smallint(5) NOT NULL default '0',
  `listmoreurl` text NOT NULL,
  `link_include_word` text NOT NULL,
  `link_noinclude_word` text NOT NULL,
  `link_replace_word` text NOT NULL,
  `title_replace_word` text NOT NULL,
  `list_begin_code` text NOT NULL,
  `list_end_code` text NOT NULL,
  `list_begin_preg` text NOT NULL,
  `list_end_preg` text NOT NULL,
  `gatherthesame` tinyint(1) NOT NULL default '0',
  `show_begin_preg` text NOT NULL,
  `show_end_preg` text NOT NULL,
  `show_endfile_preg` text NOT NULL,
  `show_begin_code` text NOT NULL,
  `show_end_code` text NOT NULL,
  `show_replace_word` text NOT NULL,
  `show_morepage` varchar(100) NOT NULL default '',
  `show_firstpage` varchar(100) NOT NULL default '',
  `show_spe2page` tinyint(1) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  `copypic` tinyint(1) NOT NULL default '0',
  `sort` smallint(4) NOT NULL default '0',
  `file_includeword` text NOT NULL,
  `file_noincludeword` text NOT NULL,
  `file_picwidth` int(8) NOT NULL default '0',
  `file_star_string` varchar(150) NOT NULL default '',
  `title_rule` text NOT NULL,
  `content_rule` text NOT NULL,
  `title_morepage_rull` text NOT NULL,
  `content_morepage_rull` text NOT NULL,
  `charset_type` tinyint(1) NOT NULL default '0',
  `file_rule` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=25 ;

#
# 导出表中的数据 `qb_photo_gather_rule`
#

INSERT INTO `qb_photo_gather_rule` VALUES (21, 0, 'article', 'article', '', '清纯美女', '', '', 0, 0, 1, 0, 'http://www.22mm.cc/mm/qingliang/', '', '<', '', '', '', '', '', '', 0, '', '', '', '<script>var arrayImg=new Array();', 'getImgString()</script>', 'com/big|com/pic', '-[page].html', '.html', 0, 1305858986, 1305859160, 0, 0, '', '', 0, '', '<LI><a href="{url=*}" title="{*}" target="_blank"><img border=0 src={*} width=140 height=105>{title=*}</a></LI>', '', '', '', 0, ']="{photourl=*}";');
INSERT INTO `qb_photo_gather_rule` VALUES (23, 0, 'article', 'article', '', '明星写真', '', '', 0, 0, 1, 0, 'http://ent.tpzj.com/star/xiezhen/index_1.html', '', '<', '', '', '<!-- 如果缩略图是160*120，则这个ul定义为li_160，如果为120*160，则定义为li_120 -->', '<div class=" clear"></div>', '', '', 0, '', '', '', '<ul class="pic-list" id="ISL_Cont_1" >', '<div id="RightArr" class="RightBotton fl" onclick="listNext();"></div>', '', '', '', 0, 1305883642, 1305883721, 0, 0, '', '', 0, '', '<li><a href="{url=*}"><img src="{*}" alt="{title=*}"/>', '', '', '', 1, 'original="{photourl=*}" title=');
INSERT INTO `qb_photo_gather_rule` VALUES (24, 0, 'article', 'article', '', '靓丽模特', '', '', 0, 0, 1, 0, 'http://tuku.83mei.com/mt/', '', '<', '', '', '<span class="color">您现在的位置</span> ', '<span id="lblPageNavigator2"><div class=\'yema\'>', '', '', 0, '', '', '', '', '', '', '_[page].html', '.html', 0, 1305885195, 1305885397, 0, 0, '', '', 0, '', '<li class="heng01_pbor"><a href="{url=*}"><img src=\'{*}\' border=\'0\' width=\'150\' height=\'194\' alt=\'{title=*}\'></a></li> ', '', '', '', 0, '<a href=\' javascript:dPlayNext();\' >\r\n                  <img src=\'{photourl=*}\' id=\'bigimg\'  width=\'{*}\'  alt=\'\' border=\'0\' />\r\n                </a>\r\n                <a href=\' javascript:dPlayNext();\' >');
    

# --------------------------------------------------------

#
# 表的结构 `qb_photo_keyword`
#

DROP TABLE IF EXISTS `qb_photo_keyword`;
CREATE TABLE `qb_photo_keyword` (
  `id` mediumint(5) NOT NULL auto_increment,
  `keywords` varchar(30) NOT NULL default '',
  `list` int(10) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `ifhide` tinyint(1) NOT NULL default '0',
  `url` varchar(150) NOT NULL default '',
  `num` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `keywords` (`keywords`),
  KEY `num` (`num`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_keyword`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_keywordid`
#

DROP TABLE IF EXISTS `qb_photo_keywordid`;
CREATE TABLE `qb_photo_keywordid` (
  `id` mediumint(7) NOT NULL default '0',
  `aid` mediumint(7) NOT NULL default '0',
  KEY `id` (`id`),
  KEY `aid` (`aid`)
) TYPE=MyISAM;

#
# 导出表中的数据 `qb_photo_keywordid`
#




# --------------------------------------------------------

#
# 表的结构 `qb_photo_report`
#

DROP TABLE IF EXISTS `qb_photo_report`;
CREATE TABLE `qb_photo_report` (
  `id` mediumint(7) NOT NULL auto_increment,
  `aid` int(10) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '',
  `uid` mediumint(7) NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `yz` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_report`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_special`
#

DROP TABLE IF EXISTS `qb_photo_special`;
CREATE TABLE `qb_photo_special` (
  `id` mediumint(7) NOT NULL auto_increment,
  `fid` mediumint(7) NOT NULL default '0',
  `title` varchar(150) NOT NULL default '',
  `titlecolor` varchar(15) NOT NULL default '',
  `keywords` varchar(100) NOT NULL default '',
  `style` varchar(25) NOT NULL default '',
  `template` varchar(255) NOT NULL default '',
  `picurl` varchar(150) NOT NULL default '',
  `content` mediumtext NOT NULL,
  `aids` text NOT NULL,
  `tids` text NOT NULL,
  `jumpurl` varchar(150) NOT NULL default '',
  `target` tinyint(1) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `posttime` int(10) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  `hits` mediumint(7) NOT NULL default '0',
  `lastview` int(10) NOT NULL default '0',
  `levels` tinyint(1) NOT NULL default '0',
  `levelstime` int(10) NOT NULL default '0',
  `htmlfile` varchar(50) NOT NULL default '',
  `banner` varchar(150) NOT NULL default '',
  `allowpost` varchar(255) NOT NULL default '',
  `ifbase` tinyint(1) NOT NULL default '0',
  `htmlname` varchar(80) NOT NULL default '',
  `yz` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `fid` (`fid`),
  KEY `ifbase` (`ifbase`),
  KEY `yz` (`yz`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_special`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_special_comment`
#

DROP TABLE IF EXISTS `qb_photo_special_comment`;
CREATE TABLE `qb_photo_special_comment` (
  `id` mediumint(7) unsigned NOT NULL auto_increment,
  `cid` mediumint(7) unsigned NOT NULL default '0',
  `vid` mediumint(7) NOT NULL default '0',
  `uid` mediumint(7) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `posttime` int(10) NOT NULL default '0',
  `content` text NOT NULL,
  `ip` varchar(15) NOT NULL default '',
  `icon` tinyint(3) NOT NULL default '0',
  `yz` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `aid` (`cid`),
  KEY `uid` (`uid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# 导出表中的数据 `qb_photo_special_comment`
#


# --------------------------------------------------------

#
# 表的结构 `qb_photo_spsort`
#

DROP TABLE IF EXISTS `qb_photo_spsort`;
CREATE TABLE `qb_photo_spsort` (
  `fid` mediumint(7) unsigned NOT NULL auto_increment,
  `fup` mediumint(7) unsigned NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `class` smallint(4) NOT NULL default '0',
  `sons` smallint(4) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `admin` varchar(100) NOT NULL default '',
  `list` int(10) NOT NULL default '0',
  `listorder` tinyint(2) NOT NULL default '0',
  `passwd` varchar(32) NOT NULL default '',
  `logo` varchar(150) NOT NULL default '',
  `descrip` text NOT NULL,
  `style` varchar(50) NOT NULL default '',
  `template` text NOT NULL,
  `jumpurl` varchar(150) NOT NULL default '',
  `maxperpage` tinyint(3) NOT NULL default '0',
  `metakeywords` varchar(255) NOT NULL default '',
  `metadescription` varchar(255) NOT NULL default '',
  `allowcomment` tinyint(1) NOT NULL default '0',
  `allowpost` varchar(150) NOT NULL default '',
  `allowviewtitle` varchar(150) NOT NULL default '',
  `allowviewcontent` varchar(150) NOT NULL default '',
  `allowdownload` varchar(150) NOT NULL default '',
  `forbidshow` tinyint(1) NOT NULL default '0',
  `config` text NOT NULL,
  `list_html` varchar(255) NOT NULL default '',
  `bencandy_html` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `fup` (`fup`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `qb_copyfrom` (
`id` mediumint( 5 ) NOT NULL AUTO_INCREMENT ,
`name` varchar( 40 ) NOT NULL default '',
`list` int( 10 ) NOT NULL default '0',
`uid` mediumint( 7 ) NOT NULL default '0',
PRIMARY KEY ( `id` ) ,
KEY `keywords` ( `name` ) 
) TYPE = MYISAM AUTO_INCREMENT =3 ;





# --------------------------------------------------------

#
# 表的结构 `qb_photo_article`
#

DROP TABLE IF EXISTS `qb_photo_article`;
CREATE TABLE `qb_photo_article` (
  `aid` mediumint(7) unsigned NOT NULL auto_increment,
  `title` varchar(150) NOT NULL default '',
  `smalltitle` varchar(100) NOT NULL default '',
  `fid` mediumint(7) unsigned NOT NULL default '0',
  `mid` mediumint(5) NOT NULL default '0',
  `fname` varchar(50) NOT NULL default '',
  `hits` mediumint(7) NOT NULL default '0',
  `pages` smallint(4) NOT NULL default '0',
  `comments` mediumint(7) NOT NULL default '0',
  `posttime` int(10) NOT NULL default '0',
  `list` int(10) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `author` varchar(30) NOT NULL default '',
  `copyfrom` varchar(100) NOT NULL default '',
  `copyfromurl` varchar(150) NOT NULL default '',
  `titlecolor` varchar(15) NOT NULL default '',
  `fonttype` tinyint(1) NOT NULL default '0',
  `picurl` varchar(150) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `yz` tinyint(1) NOT NULL default '0',
  `yzer` varchar(30) NOT NULL default '',
  `yztime` int(10) NOT NULL default '0',
  `levels` tinyint(2) NOT NULL default '0',
  `levelstime` int(10) NOT NULL default '0',
  `keywords` varchar(100) NOT NULL default '',
  `jumpurl` varchar(150) NOT NULL default '',
  `iframeurl` varchar(150) NOT NULL default '',
  `style` varchar(15) NOT NULL default '',
  `template` varchar(255) NOT NULL default '',
  `target` tinyint(1) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `lastfid` mediumint(7) NOT NULL default '0',
  `money` mediumint(7) NOT NULL default '0',
  `buyuser` text NOT NULL,
  `passwd` varchar(32) NOT NULL default '',
  `allowdown` varchar(150) NOT NULL default '',
  `allowview` varchar(150) NOT NULL default '',
  `editer` varchar(30) NOT NULL default '',
  `edittime` int(10) NOT NULL default '0',
  `begintime` int(10) NOT NULL default '0',
  `endtime` int(10) NOT NULL default '0',
  `description` text NOT NULL,
  `lastview` int(10) NOT NULL default '0',
  `digg_num` mediumint(7) NOT NULL default '0',
  `digg_time` int(10) NOT NULL default '0',
  `forbidcomment` tinyint(1) NOT NULL default '0',
  `ifvote` tinyint(1) NOT NULL default '0',
  `heart` varchar(255) NOT NULL default '',
  `htmlname` varchar(100) NOT NULL default '',
  `photourl` text NOT NULL,
  PRIMARY KEY  (`aid`),
  KEY `fid` (`fid`),
  KEY `hits` (`hits`,`yz`,`fid`,`ispic`),
  KEY `lastview` (`yz`,`lastview`,`fid`,`ispic`),
  KEY `list` (`list`,`yz`,`fid`,`ispic`),
  KEY `ispic` (`ispic`),
  KEY `uid` (`uid`),
  KEY `levels` (`levels`),
  KEY `digg_num` (`digg_num`),
  KEY `digg_time` (`digg_time`),
  KEY `mid` (`mid`)
) TYPE=MyISAM AUTO_INCREMENT=621 ;

#
# 导出表中的数据 `qb_photo_article`
#

INSERT INTO `qb_photo_article` VALUES (532, '很漂亮的女人再来两张', '', 2, 100, '美女图片', 20, 1, 0, 1239786083, 1239786083, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallzagr5nn97g.jpg', 1, 1, '', 0, 0, 0, '漂亮 女人', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373266, 0, 0, '', 1306398458, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090543_N2NiNzVlYWExMzliMmVhMmRhODRkYzJkNDRmMThiODI=.jpg@@@7cb75eaa139b2ea2da84dc2d44f18b82@@@\nqb_photo_/2/1_20110526090543_OTVlZTRjNDRmYWZhNTM0ZDczY2YwMTMyMzgzN2NhMWM=.jpg@@@95ee4c44fafa534d73cf01323837ca1c@@@');
INSERT INTO `qb_photo_article` VALUES (531, '人间极品美女2两张供大家测试浏览', '', 5, 100, '风景图片', 20, 1, 0, 1239785963, 1239785963, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_small47tmqr0obw.jpg', 1, 1, '', 0, 0, 0, '人间 极品美女 张供 大家 测试 浏览', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306391312, 0, 0, '', 1306400527, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090545_MkM2Q0JDRDI3MDgxNEE1NDg0RTBGQzA2MzM1QTgwNTcyMDA2MDgwMjE3NTM=.jpg@@@2C6CBCD270814A5484E0FC06335A8057200608021753@@@\nqb_photo_/2/1_20110526090545_MERCRjcwRkQxMTI2NEI0NDg3NDY3MENDRkU0QzZCNEQyMDA2MDgwMjE3NTQ=.jpg@@@0DBF70FD11264B44874670CCFE4C6B4D200608021754@@@');
INSERT INTO `qb_photo_article` VALUES (605, '中华顶级模特表演艺术', '', 2, 100, '美女图片', 6, 1, 0, 1289371004, 1289371004, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smalleiwzfe1thg.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373390, 0, 0, '', 1306400251, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090548_MjAwODExMTkxNjMwMjE0ODQ3MjY5OTY=.jpg@@@20081119163021484726996@@@\nqb_photo_/2/1_20110526090548_MjAwODExMTkxNjMwMjA1NDYwNTU5OTQ=.jpg@@@20081119163020546055994@@@');
INSERT INTO `qb_photo_article` VALUES (606, '广东全运会美女集中营', '', 2, 100, '美女图片', 5, 1, 0, 1289371066, 1289371066, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallsufj58bi1r.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373502, 0, 0, '', 1306400508, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090519_MjAwNTA4MTgxNjA4NTI5NjA=.jpg@@@20050818160852960@@@\nqb_photo_/2/1_20110526090519_MjAwNTA4MTgxNjA5MDA1NTI=.jpg@@@20050818160900552@@@');
INSERT INTO `qb_photo_article` VALUES (607, '除了美丽还是美丽的人', '', 2, 100, '美女图片', 2, 1, 0, 1289371116, 1289371116, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallbmj7xjhpqg.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373610, 0, 0, '', 1306400606, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090527_MTAyMzI2MTEyNTg5NDgxNTJfeDNQR1hiZXpiQmh4X3hrSnJqTFJKSHJhaA==.jpg@@@10232611258948152_x3PGXbezbBhx_xkJrjLRJHrah@@@\nqb_photo_/2/1_20110526090527_MmU1NzQwYTg1MGQyYjkw.jpg@@@2e5740a850d2b90@@@');
INSERT INTO `qb_photo_article` VALUES (608, '续发美女图片集', '', 2, 100, '美女图片', 2, 1, 0, 1289371162, 1289371162, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smalldgphusgi8l.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373724, 0, 0, '', 1306400804, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090520_MjAwMzgxMDEyMTM0X2JSS3hXc1ZnWFd4bQ==.jpg@@@200381012134_bRKxWsVgXWxm@@@\nqb_photo_/2/1_20110526090520_MjAwMzgxMDEyMTU1X0dtQUpEblpjeXVaYg==.jpg@@@200381012155_GmAJDnZcyuZb@@@');
INSERT INTO `qb_photo_article` VALUES (609, '校园清纯少女写真集', '', 2, 100, '美女图片', 5, 1, 0, 1289371211, 1289371211, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallt8cb26o8kn.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373840, 0, 0, '', 1306400663, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090516_MjAwNl8xMV8wNl8yMl8zNF8xMV8yMjc4.jpg@@@2006_11_06_22_34_11_2278@@@\nqb_photo_/2/1_20110526090516_MjAwNl8xMV8wNl8yMl8zNV8xMV81MTI3.jpg@@@2006_11_06_22_35_11_5127@@@');
INSERT INTO `qb_photo_article` VALUES (610, '某某艺术学校的校花展', '', 2, 100, '美女图片', 4, 1, 0, 1289371256, 1289371256, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallpcvtpibsdx.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373901, 0, 0, '', 1306382526, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090520_MTQ5MzM5Mjc5XzE4ODU4.jpg@@@149339279_18858@@@\nqb_photo_/2/1_20110526090520_MTQ5MzM5MjgwXzE3MzU3.jpg@@@149339280_17357@@@');
INSERT INTO `qb_photo_article` VALUES (611, '清水出芙蓉之美女篇', '', 2, 100, '美女图片', 2, 1, 0, 1289371328, 1289371328, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallrelqqrdtwg.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306373966, 0, 0, '', 1306400327, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090525_NGFiN2ZkY2ZnNjU2MjkyNzQ5OGI0.jpg@@@4ab7fdcfg6562927498b4@@@\nqb_photo_/2/1_20110526090525_NGFiN2ZkY2ZnNjU2ZmE4MjdmN2U0.jpg@@@4ab7fdcfg656fa827f7e4@@@');
INSERT INTO `qb_photo_article` VALUES (612, '时尚开放的中国女性', '', 2, 100, '美女图片', 12, 1, 0, 1289371376, 1289371376, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallz57qrlgoef.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374055, 0, 0, '', 1306398433, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090553_MTI1MTk1Mjg0NjI1MV9tdGh1bWI=.jpg@@@1251952846251_mthumb@@@\nqb_photo_/2/1_20110526090553_MTI1MTk1Mjg0NjQ4Ml9tdGh1bWI=.jpg@@@1251952846482_mthumb@@@');
INSERT INTO `qb_photo_article` VALUES (613, '国产美女大集合', '', 2, 100, '美女图片', 4, 1, 0, 1289372452, 1289372452, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_small8nwfuzxqhr.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374125, 0, 0, '', 1306319042, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090503_MjU0MjU2MzQ2NDYyNzM2MzE0MQ==.jpg@@@2542563464627363141@@@\nqb_photo_/2/1_20110526090503_MjY0MDUxNjc1NjUyMjY4MzIyOA==.jpg@@@2640516756522683228@@@');
INSERT INTO `qb_photo_article` VALUES (614, '北京大学校花是这样的哦', '', 2, 100, '美女图片', 10, 1, 0, 1289372494, 1289372494, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_small0qc8nhqw33.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374183, 0, 0, '', 1306400550, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090502_ZWVlZg==.jpg@@@eeef@@@\nqb_photo_/2/1_20110526090502_ZWZl.jpg@@@efe@@@');
INSERT INTO `qb_photo_article` VALUES (615, '夏天里的美女是这样的哦', '', 2, 100, '美女图片', 10, 1, 0, 1289372531, 1289372531, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smalljl43bsfwbb.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374294, 0, 0, '', 1306400640, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090549_NTk1NTEzMQ==.jpg@@@5955131@@@\nqb_photo_/2/1_20110526090549_MzQ=.jpg@@@34@@@');
INSERT INTO `qb_photo_article` VALUES (616, '清水出芙蓉之少妇篇', '', 2, 100, '美女图片', 10, 1, 0, 1289372572, 1289372572, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallfxd41ca591.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374366, 0, 0, '', 1306319040, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090505_aW1nMzQwNTIwMzU1.jpg@@@img340520355@@@\nqb_photo_/2/1_20110526090505_aW1nMzQxMDY0NTc1.jpg@@@img341064575@@@');
INSERT INTO `qb_photo_article` VALUES (617, '超级性感的校园美女就在眼前', '', 2, 100, '美女图片', 34, 1, 0, 1289372655, 1289372655, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smalla9k8bsmndx.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374447, 0, 0, '', 1306400653, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090526_MjM5MDk1.jpg@@@239095@@@\nqb_photo_/2/1_20110526090526_NTk1NTEzMA==.jpg@@@5955130@@@');
INSERT INTO `qb_photo_article` VALUES (618, '她就是你一生之中苦苦寻找的美女吗?', '', 2, 100, '美女图片', 19, 1, 0, 1289372720, 1289372720, 1, 'admin', '', '', '', '', 0, 'qb_photo_/2/1_smallz4yne8nb9r.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 1306374561, 0, 0, '', 1306400295, 0, 0, 0, 0, '', '', 'qb_photo_/2/1_20110526090520_dmdtaGdmag==.jpg@@@vgmhgfj@@@\nqb_photo_/2/1_20110526090520_dmlldw==.jpg@@@view@@@');
INSERT INTO `qb_photo_article` VALUES (619, '这里的风景独好', '', 5, 0, '风景图片', 3, 1, 0, 1306374868, 1306374868, 1, 'admin', '', '', '', '', 0, 'qb_photo_/5/1_smallkiohbfmqsr.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 0, 0, 0, '', 1306384305, 0, 0, 0, 0, '', '', 'qb_photo_/5/1_20110526090515_aGdkaGdm.jpg@@@hgdhgf@@@\nqb_photo_/5/1_20110526090515_VUYyMDA1MTAxOTEwNTE0MA==.jpg@@@UF20051019105140@@@');
INSERT INTO `qb_photo_article` VALUES (620, '车模美女大展厅', '', 4, 0, '热点图片', 9, 1, 0, 1306374992, 1306374992, 1, 'admin', '', '', '', '', 0, 'qb_photo_/4/1_smallxxk3jbqfmy.jpg', 1, 1, '', 0, 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:8:"bencandy";s:0:"";}', 0, '', 0, 0, '', '', '', '', '', 0, 0, 0, '', 1306400452, 0, 0, 0, 0, '', '', 'qb_photo_/4/1_20110526090515_MjAwODExMjAxMjIwNDg4NDc2Nzg5OTEz.jpg@@@200811201220488476789913@@@\nqb_photo_/4/1_20110526090515_MjAwODExMTkxMzMyMDc1OTYzNDM5OTE2.jpg@@@200811191332075963439916@@@');

# --------------------------------------------------------

#
# 表的结构 `qb_photo_reply`
#

DROP TABLE IF EXISTS `qb_photo_reply`;
CREATE TABLE `qb_photo_reply` (
  `rid` mediumint(7) NOT NULL auto_increment,
  `subhead` varchar(150) NOT NULL default '',
  `postdate` int(10) NOT NULL default '0',
  `aid` mediumint(7) NOT NULL default '0',
  `fid` mediumint(7) NOT NULL default '0',
  `uid` mediumint(7) NOT NULL default '0',
  `topic` tinyint(1) NOT NULL default '0',
  `content` mediumtext NOT NULL,
  `orderid` mediumint(7) NOT NULL default '0',
  PRIMARY KEY  (`rid`),
  KEY `aid` (`aid`,`topic`)
) TYPE=MyISAM AUTO_INCREMENT=19 ;

#
# 导出表中的数据 `qb_photo_reply`
#

INSERT INTO `qb_photo_reply` VALUES (1, '', 0, 531, 5, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (2, '', 0, 532, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (3, '', 0, 605, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (4, '', 0, 606, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (5, '', 0, 607, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (6, '', 0, 608, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (7, '', 0, 609, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (8, '', 0, 610, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (9, '', 0, 611, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (10, '', 0, 612, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (11, '', 0, 613, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (12, '', 0, 614, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (13, '', 0, 615, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (14, '', 0, 616, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (15, '', 0, 617, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (16, '', 0, 618, 2, 1, 1, '暂无介绍', 0);
INSERT INTO `qb_photo_reply` VALUES (17, '', 0, 619, 5, 1, 1, '', 0);
INSERT INTO `qb_photo_reply` VALUES (18, '', 0, 620, 4, 1, 1, '暂无', 0);

# --------------------------------------------------------

#
# 表的结构 `qb_photo_sort`
#

DROP TABLE IF EXISTS `qb_photo_sort`;
CREATE TABLE `qb_photo_sort` (
  `fid` mediumint(7) unsigned NOT NULL auto_increment,
  `fup` mediumint(7) unsigned NOT NULL default '0',
  `fmid` mediumint(5) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `class` smallint(4) NOT NULL default '0',
  `sons` smallint(4) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `admin` varchar(100) NOT NULL default '',
  `list` int(10) NOT NULL default '0',
  `listorder` tinyint(2) NOT NULL default '0',
  `passwd` varchar(32) NOT NULL default '',
  `logo` varchar(150) NOT NULL default '',
  `descrip` text NOT NULL,
  `style` varchar(50) NOT NULL default '',
  `template` text NOT NULL,
  `jumpurl` varchar(150) NOT NULL default '',
  `maxperpage` tinyint(3) NOT NULL default '0',
  `metakeywords` varchar(255) NOT NULL default '',
  `metadescription` varchar(255) NOT NULL default '',
  `allowcomment` tinyint(1) NOT NULL default '0',
  `allowpost` varchar(150) NOT NULL default '',
  `allowviewtitle` varchar(150) NOT NULL default '',
  `allowviewcontent` varchar(150) NOT NULL default '',
  `allowdownload` varchar(150) NOT NULL default '',
  `forbidshow` tinyint(1) NOT NULL default '0',
  `config` text NOT NULL,
  `list_html` varchar(255) NOT NULL default '',
  `bencandy_html` varchar(255) NOT NULL default '',
  `domain` varchar(150) NOT NULL default '',
  `domain_dir` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`fid`),
  KEY `fup` (`fup`),
  KEY `fmid` (`fmid`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# 导出表中的数据 `qb_photo_sort`
#

INSERT INTO `qb_photo_sort` VALUES (1, 0, 0, '图库中心', 1, 3, 1, '', 0, 0, '', '', '', '', 'a:3:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:4:"list";s:0:"";}', '', 0, '', '', 0, '', '', '', '', 0, 'a:7:{s:11:"sonTitleRow";s:0:"";s:12:"sonTitleLeng";s:0:"";s:9:"cachetime";N;s:12:"sonListorder";s:1:"0";s:14:"listContentNum";N;s:12:"ListShowType";N;s:15:"ListShowBigType";s:0:"";}', 'TuKuZhongXin/list-{$page}.html', '', '', '');
INSERT INTO `qb_photo_sort` VALUES (2, 1, 0, '美女图片', 2, 0, 0, '', 1, 0, '', '', '', '', 'a:4:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:4:"list";s:0:"";s:8:"bencandy";s:0:"";}', '', 0, '', '', 1, '', '', '', '', 0, 'a:7:{s:11:"sonTitleRow";N;s:12:"sonTitleLeng";N;s:9:"cachetime";N;s:12:"sonListorder";N;s:14:"listContentNum";s:0:"";s:12:"ListShowType";s:0:"";s:15:"ListShowBigType";N;}', 'MeiNvTuPian/{$page}.html', 'MeiNvTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html', '', '');
INSERT INTO `qb_photo_sort` VALUES (4, 1, 0, '热点图片', 2, 0, 0, '', 0, 0, '', '', '', '', 'a:4:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:4:"list";s:0:"";s:8:"bencandy";s:0:"";}', '', 31, '', '', 1, '3', '', '', '', 0, 'a:7:{s:11:"sonTitleRow";N;s:12:"sonTitleLeng";N;s:9:"cachetime";N;s:12:"sonListorder";N;s:14:"listContentNum";s:0:"";s:12:"ListShowType";s:0:"";s:15:"ListShowBigType";N;}', 'ReDianTuPian/{$page}.html', 'ReDianTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html', '', '');
INSERT INTO `qb_photo_sort` VALUES (5, 1, 0, '风景图片', 2, 0, 0, '', 0, 0, '', '', '', '', 'a:4:{s:4:"head";s:0:"";s:4:"foot";s:0:"";s:4:"list";s:0:"";s:8:"bencandy";s:0:"";}', '', 0, '', '', 1, '', '', '', '', 0, 'a:7:{s:11:"sonTitleRow";N;s:12:"sonTitleLeng";N;s:9:"cachetime";N;s:12:"sonListorder";N;s:14:"listContentNum";s:0:"";s:12:"ListShowType";s:0:"";s:15:"ListShowBigType";N;}', 'FengJingTuPian/{$page}.html', 'FengJingTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html', '', '');
