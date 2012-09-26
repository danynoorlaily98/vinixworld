<?

echo "<a href='/info.php?info'>Mi Perfil</a><br/>";
echo "<a href='/anketa.php'>Editar Perfil</a><br/>";
echo "<a href='/addinfo.php'>Editar Info</a><br/>";
echo "<a href='/interest.php'>Editar Intereses</a><br/>";
echo "<a href='/educat.php'>Editar Educacion</a><br/>";

$opdirbase=@opendir(H.'sys/add/umenu');
while ($filebase=@readdir($opdirbase))
if (eregi('\.php$',$filebase))
include_once(H.'sys/add/umenu/'.$filebase);

echo "<a href='/avatar.php'>Cambiar Foto</a><br/>";
echo "<a href='/secure.php'>Cambiar Password</a><br/>";
echo "<a href='/settings.php'>Ajustes</a><br/>";
echo "<a href='/rules.php'>Reglas</a><br/>";

if (user_access('adm_panel_show'))echo "<a href='/adm_panel/'>Admin Panel</a><br/>";

if ($set['web']==false)
echo "<div class='penanda'>User</div><a href='/exit.php'>Salir</a><br/>";
?>
