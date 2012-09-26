<?


function title($title=NULL)
{
global $set;
if ($set['web']==false)
{
if ($title==NULL)$title=$set['title'];
echo "<div class='title'>$title</div>\n";

echo "<div class='rekl'>\n";
rekl(1);
echo "</div>\n";
}
}

?>