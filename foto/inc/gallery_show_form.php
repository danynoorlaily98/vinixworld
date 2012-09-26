<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


if ((user_access('foto_alb_del') || isset($user) && $user['id']==$ank['id']) && isset($_GET['act']) && $_GET['act']=='delete')
{
echo "<form class='foot' action='?act=delete&amp;ok&amp;page=$page' method=\"post\">";
echo "<div class='err'>Confirm to delete albums</div>\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Delete\" /><br />\n";
echo "&nbsp;<a href='?'>Cancel</a><br />\n";
echo "</form>";
}

if (isset($user) && $user['id']==$ank['id'] && isset($_GET['act']) && $_GET['act']=='upload')
{
echo "<form class='foot' enctype=\"multipart/form-data\" action='?act=upload&amp;ok&amp;page=$page' method=\"post\">";
echo "Title:<br />\n";
echo "<input name='name' type='text' /><br />\n";
echo "File:<br />\n";
echo "<input name='file' type='file' accept='image/*,image/jpeg' /><br />\n";
echo "Description:<br />\n";
echo "<textarea name='opis'></textarea><br />\n";

echo "<b>Upload photos on the site shall not:</b><br />\n";
echo "* Violate any law, honot and dignity, rights and legitimate interests of third persons who incite religious, racial or ethnic hatred, contain scene of vilolence or inhuman treatment of animals, etc;<br />\n";
echo "* Be obsence or offensive nature;<br />\n";
echo "* Contain advertising of drugs;<br />\n";
echo "* Violate the rights of minors;<br />\n";
echo "* Violate the copyright and related rights of third parties;<br />\n";
echo "* Wear a pornographic nature;<br />\n";
echo "* Contain commercial advertising in any form.<br />\n";

echo "<input class=\"submit\" type=\"submit\" value=\"Upload\" /><br />\n";
echo "&nbsp;<a href='?'>Cancel</a><br />\n";
echo "</form>";
}

if (isset($user) && $user['id']==$ank['id'] || user_access('foto_alb_del')){
echo "<div class=\"foot\">\n";
if (isset($user) && $user['id']==$ank['id'])
echo "&nbsp;<a href='?act=upload'>Upload Photo</a><br />\n";
if (user_access('foto_alb_del') || isset($user) && $user['id']==$ank['id'])
echo "&nbsp;<a href='?act=delete'>Delete</a><br />\n";
echo "</div>\n";

}


?>
