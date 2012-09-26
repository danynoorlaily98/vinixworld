<?

// created by noe
// http://nnetwork.tk
// loegue.info@gmail.com

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';
only_reg();
$set['title']='Personal Menu';
include_once 'sys/inc/thead.php';



if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('menu.user\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));

echo "<div class='menu'>\n";

// сделано специально для интеграции в web темы
include_once H.'sys/inc/menu.user.php';
echo "</div>\n";

include_once 'sys/inc/tfoot.php';

?>
