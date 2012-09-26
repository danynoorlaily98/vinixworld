<?
function rekl($sel)
{
global $set;
if ($sel==3 && $_SERVER['PHP_SELF']!='/index.php')$sel=4; // для страниц, кроме главной, у нас другая позиция



$q=mysql_query("SELECT * FROM `rekl` WHERE `sel` = '$sel' AND `time_last` > '".time()."' ORDER BY id ASC");
while ($post = mysql_fetch_assoc($q))
{

if ($sel==2)echo icons('rekl.png','code');


if ($post['dop_str']==1)
echo "<a".($set['web']?" target='_blank'":null)." href='http://$_SERVER[SERVER_NAME]/go.php?go=$post[id]'>";
else
echo "<a".($set['web']?" target='_blank'":null)." href='$post[link]'>";

if ($post['img']==NULL)echo "$post[name]";
else echo "<img src='$post[img]' alt='$post[name]' />";
echo "</a><br />\n";
}

	if(($sel==3 || $sel==4) && is_file(H.'sys/dat/raiting.dat'))
	{
		$iss=file_get_contents(H.'sys/dat/raiting.dat');
		$iss=explode('{:}',$iss);
		$id=intval($iss[0]);
		if($id>0)
		{
			if($_SERVER['PHP_SELF']=='/index.php')
			{
				$small='';
			}else{
				$small='-small';
			}
			echo '<a href="http://o5top.ru/in.php?'.$id.'"><img src="http://o5top.ru/img.php?'.$id.$small.'" alt="o5top.ru" /></a><br />';
		}
	}

}

?>