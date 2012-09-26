<?

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
$set['title']='Menu';
include_once 'sys/inc/thead.php';
//title();
err();



include_once H.'sys/inc/main_menu.php';

include_once 'sys/inc/tfoot.php';

?>
