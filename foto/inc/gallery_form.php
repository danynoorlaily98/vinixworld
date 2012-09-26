<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang



if (isset($user) && $user['id']==$ank['id']){



if (isset($_GET['act']) && $_GET['act']=='create')

{

echo "<form class=\"foot\" action='?act=create&amp;ok&amp;page=$page' method=\"post\">";

echo "Album Title:<br />\n";
echo "<input type='text' name='name' value='' /><br />\n";

if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit1\" value=\"1\" /> Translit</label><br />\n";

echo "Description:<br />\n";

echo "<textarea name='opis'></textarea><br />\n";

if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit2\" value=\"1\" /> Translit</label><br />\n";

echo "<input class='submit' type='submit' value='Create' /><br />\n";

echo "&nbsp;<a href='?'>Cancel</a><br />\n";
echo "</form>";

}





echo "<div class=\"foot\">\n";



echo "&nbsp;<a href='/foto/$ank[id]/?act=create'>Create Albums</a><br />\n";



echo "</div>\n";



}



?>
