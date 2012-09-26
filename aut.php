<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
$show_all=true; // show all
include_once 'sys/inc/user.php';
only_unreg();
$set['title']='Log In';
include_once 'sys/inc/thead.php';
//title();
if (isset($_GET['pass']) && $_GET['pass']='ok')
msg('Password has been sent to your email!');
//aut();

echo "<div class='login'>\n";
if ($set['guest_select']=='1')msg("<b>Welcome</b><br/>
");

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('mail\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));
echo "<form method='post' action='/?$passgen'>\n";
echo "<font color='#A9A9A9'>Nickname:</font><br /><input type='text' name='nick' maxlength='32' /><br/>\n";
echo "<font color='#A9A9A9'>Password:</font><br /><input type='password' name='pass' maxlength='32' /><br/>\n";
echo "<label><input type='checkbox' name='aut_save' value='1' /> Remember me?<br /></label>\n";
echo "<input class='button' type='submit' value='Login' />\n";
echo "</form>";
echo "<a href='/pass.php'>Forgot Password?</a><br/>";
echo "<a href='/reg.php'>Register</a><br />\n";
echo "</div>\n";
include_once 'sys/inc/tfoot.php';
?>
