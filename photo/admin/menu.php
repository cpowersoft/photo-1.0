<?php

return array(

	'更新首页标签'=>array('power'=>'center_label','link'=>'file=center&job=label'),
	'参数设置'=>array('power'=>'center_config','link'=>'file=center&job=config'),

	'图片管理'=>array('power'=>'listartic','link'=>'file=artic&job=listartic','sort'=>'图片管理'),	
	'分类管理'=>array('power'=>'sort_listsort','link'=>'file=sort&job=listsort','sort'=>'图片管理'),
	'发布图片'=>array('power'=>'postArticle','link'=>'file=post&job=postnew','sort'=>'图片管理'),
	'图片评论管理'=>array('power'=>'comment','link'=>'file=comment&job=list','sort'=>'图片管理'),
	

	'图片静态'=>array('power'=>'sort_html','link'=>'file=html&job=list','sort'=>'静态管理'),
	'专题静态'=>array('power'=>'listsp_html','link'=>'file=html&job=listsp','sort'=>'静态管理'),


	'专题内容管理'=>array('power'=>'special','link'=>'file=special&job=list','sort'=>'专题管理'),
	'专题分类管理'=>array('power'=>'spsort','link'=>'file=spsort&job=listsort','sort'=>'专题管理'),

	
	'辅栏目内容管理'=>array('power'=>'fu_artic','link'=>'file=fu_artic&job=listartic','sort'=>'辅栏目管理'),
	'辅栏目分类管理'=>array('power'=>'fu_sort','link'=>'file=fu_sort&job=listsort','sort'=>'辅栏目管理'),

	'权限设置'=>array('power'=>'group_power','link'=>'file=group&job=list','sort'=>'其它功能'),	
	'批量生成缩略图'=>array('power'=>'batch_cut','link'=>'file=batch_cut&job=set','sort'=>'其它功能'),
	'图片采集器'=>array('power'=>'gather','link'=>'file=gather&job=list','sort'=>'其它功能'),
	'关键字提取'=>array('power'=>'getkeyword','link'=>'file=getkeyword&job=get','sort'=>'其它功能'),
	

);

?>