<?
@session_name('SESS');
@session_start();
$sess=mysql_escape_string(session_id());
if (!eregi('[A-z0-9]{32}',$sess))$sess=md5(rand(09009,999999));
?>