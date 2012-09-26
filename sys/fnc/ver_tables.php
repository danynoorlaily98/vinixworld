<?
// данный скрипт добавяет отсутствующие таблицы в базу данных
// также он используется для установки движка


$tab=mysql_list_tables($set['mysql_db_name']);
for($i=0;$i<@mysql_num_rows($tab);$i++)
{
$table=mysql_tablename($tab,$i);
$_ver_table[$table]=true;
}
$k_sql=0;
$ok_sql=0;
$opdirtables=opendir(H.'sys/db_tables');
while ($filetables=readdir($opdirtables))
{
if (eregi('\.sql$',$filetables))
{
$table_name=eregi_replace('\.sql$',null,$filetables);
if (!isset($_ver_table[$table_name]))
{

include_once H.'sys/inc/sql_parser.php';
$sql=SQLParser::getQueriesFromFile(H.'sys/db_tables/'.$filetables);


for ($i=0;$i<count($sql);$i++)
{
$k_sql++; // счетчик запросов (для установщика)
if (@mysql_query($sql[$i])) {
$ok_sql++; // счетчик успешно выполненных запросов (для установщика)
}
}
}
}
}
closedir($opdirtables);





if (!isset($install)){

// выполнение одноразовых запросов
$opdirtables=opendir(H.'sys/update/');
while ($rd=readdir($opdirtables))
{
if (ereg('^\.',$rd))continue;
if (isset($set['update'][$rd]))continue;

if (eregi('\.sql$',$rd))
{
include_once H.'sys/inc/sql_parser.php';
$sql=SQLParser::getQueriesFromFile(H.'sys/update/'.$rd);
for ($i=0;$i<count($sql);$i++){mysql_query($sql[$i]);}
$set['update'][$rd]=true;
$save_settings=true;
}
elseif(eregi('\.php$',$rd))
{
include_once H.'sys/update/'.$rd;
$set['update'][$rd]=true;
$save_settings=true;
}


}

closedir($opdirtables);

if (isset($save_settings))save_settings($set);
}

?>