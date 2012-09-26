<?

if (file_exists(H.'sys/dat/settings_6.2.dat'))
{
echo 'To continue installation, you must delete the file <b>sys/dat/settings_6.2.dat</b>';
exit;
}


if (!($set=@parse_ini_file(H.'sys/dat/default.ini',false)))
{
echo 'Can not find the configuration file';
exit;
}

$tmp_set=$set;
?>