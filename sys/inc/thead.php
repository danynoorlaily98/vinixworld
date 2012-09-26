<?php
$set['meta_keywords']=(isset($set['meta_keywords']))?$set['meta_keywords']:null;
$set['meta_description']=(isset($set['meta_description']))?$set['meta_description']:null;


if ($set['meta_keywords']!=NULL)
{
function meta_keywords($str)
{
global $set;
return str_replace('</head>', '<meta name="keywords" content="'.$set['meta_keywords'].'" />'."\n</head>", $str);
}
ob_start('meta_keywords');
}


if ($set['meta_description']!=NULL)
{
function meta_description($str)
{
global $set;
return str_replace('</head>', '<meta name="description" content="'.$set['meta_description'].'" />'."\n</head>", $str);
}
ob_start('meta_description');
}

if (file_exists(H."style/themes/$set[set_them]/head.php")){


include_once H."style/themes/$set[set_them]/head.php";
}
else
{
$set['web']=false;
//header("Content-type: application/vnd.wap.xhtml+xml");
//header("Content-type: application/xhtml+xml");
header("Content-type: text/html");
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<title><?echo $set['title'];?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/<?echo $set['set_them'];?>/style.css" type="text/css" />
<link rel="alternate" title="RSS News" href="/news/rss.php" type="application/rss+xml" />
</head>
<body>
<?php
echo"<div class='rekl_main'>";
$ad = $set['mobiads_id'];
echo "</div>";
if ($set['mobiads_middle']==1)
{
}
}
?>
