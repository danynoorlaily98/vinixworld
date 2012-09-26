<?


// авторизация на сервере базы
if(!($db=@mysql_connect($set['mysql_host'], $set['mysql_user'],$set['mysql_pass'])))

{
//echo $set['mysql_host'], $set['mysql_user'],$set['mysql_pass'];
echo "No connection to the database server<br />*Check the connection settings";
exit;
}

// подключение к базе
if (!@mysql_select_db($set['mysql_db_name'],$db))
{
echo "Database not found<br />*Check the database";
exit;
}

mysql_query('set charset utf8',$db);
mysql_query('SET names utf8',$db);
mysql_query('set character_set_client="utf8"',$db);
mysql_query('set character_set_connection="utf8"',$db);
mysql_query('set character_set_result="utf8"',$db);

?>