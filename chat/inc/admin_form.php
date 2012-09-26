<?
if (user_access('chat_room') && isset($_GET['set']) && is_numeric($_GET['set']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_rooms` WHERE `id` = '".intval($_GET['set'])."'"),0)==1)
{

$room=mysql_fetch_assoc(mysql_query("SELECT * FROM `chat_rooms` WHERE `id` = '".intval($_GET['set'])."' LIMIT 1"));

echo "<form action='?set=$room[id]&amp;ok' method='post'>";
echo "Room name:<br />\n<input type='text' name='name' value='$room[name]' /><br />\n";
echo "Position:<br />\n<input type='text' name='pos' value='$room[pos]' /><br />\n";
echo "Description:<br />\n<input type='text' name='opis' value='$room[opis]' /><br />\n";

echo "Bots:<br />\n<select name=\"bots\">\n";
echo "<option value='0'".(($room['umnik']==0 && $room['shutnik']==0)?' selected="selected"':null).">No</option>\n";
echo "<option value='1'".(($room['umnik']==1 && $room['shutnik']==0)?' selected="selected"':null).">$set[chat_umnik]</option>\n";
echo "<option value='2'".(($room['umnik']==0 && $room['shutnik']==1)?' selected="selected"':null).">$set[chat_shutnik]</option>\n";
echo "<option value='3'".(($room['umnik']==1 && $room['shutnik']==1)?' selected="selected"':null).">$set[chat_umnik] and $set[chat_shutnik]</option>\n";
echo "</select><br />\n";

echo "<input class='submit' type='submit' value='Apply' /><br />\n";
echo "<a href='?delete=$room[id]'>Delete</a><br />\n";
echo "<a href='?cancel=$passgen'>Cancel</a><br />\n";
echo "</form>";
}

if (user_access('chat_clear') && isset($_GET['act']) && $_GET['act']=='clear')
{

echo "<div class=\"err\">";

echo "Clear Chat?<br />\n";
echo "<a href=\"?act=clear2\">Yes</a> \n";
echo "<a href=\"?\">No</a><br />\n";
echo "</div>";
}

if (user_access('chat_room') && (isset($_GET['act']) && $_GET['act']=='add_room' || mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_rooms`"),0)==0))
{
echo "<form class=\"foot\" action=\"?act=add_room&amp;ok\" method=\"post\">";
echo "Room name:<br />\n";
echo "<input type='text' name='name' value='' /><br />\n";

$pos=mysql_result(mysql_query("SELECT MAX(`pos`) FROM `chat_rooms`"), 0)+1;
echo "Position:<br />\n";
echo "<input type='text' name='pos' value='$pos' /><br />\n";


echo "Description:<br />\n";
echo "<input type='text' name='opis' value='' /><br />\n";

echo "Bots:<br />\n<select name=\"bots\">\n";

echo "<option value='0'>No</option>\n";
echo "<option value='1'>$set[chat_umnik]</option>\n";
echo "<option value='2'>$set[chat_shutnik]</option>\n";
echo "<option value='3'>$set[chat_umnik] and $set[chat_shutnik]</option>\n";
echo "</select><br />\n";

echo "<input class=\"submit\" type=\"submit\" value=\"New Room\" /><br />\n";
echo "&laquo;<a href=\"?\">Cancel</a><br />\n";
echo "</form>";
}

echo "<div class=\"foot\">\n";
if (user_access('chat_clear'))
echo "&raquo;<a href=\"?act=clear\">Clear Chat Messages</a><br />\n";
if (user_access('chat_room') && mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_rooms`"),0)>0)
echo "&raquo;<a href=\"?act=add_room\">New Room</a><br />\n";
echo "</div>\n";
?>