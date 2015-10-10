<?php
 return array (
  'IF_HTML' => '0',
  'list' => 
  array (
    0 => 'html/{$fid}/{$page}.htm',
    1 => 'TuKuZhongXin/list-{$page}.html',
    2 => 'MeiNvTuPian/{$page}.html',
    4 => 'ReDianTuPian/{$page}.html',
    5 => 'FengJingTuPian/{$page}.html',
  ),
  'bencandy' => 
  array (
    0 => 'html/{$fid}-{$dirid}/{$id}-{$page}.htm',
    2 => 'MeiNvTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html',
    4 => 'ReDianTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html',
    5 => 'FengJingTuPian/{$time_Y}{$time_m}{$time_d}/{$id}-{$page}.html',
  ),
  'SPlist' => 
  array (
    0 => 'html/special{$fid}/list{$page}.htm',
  ),
  'SPbencandy' => 
  array (
    0 => 'html/special{$fid}/show{$id}.htm',
  ),
);?>