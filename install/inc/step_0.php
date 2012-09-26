<?
$set['title']='AGREEMENT';
include_once 'inc/head.php'; // ?px???c? ?? o?p?e??
if(isset($_GET['step']) && $_GET['step']=='1')
{
$_SESSION['install_step']++;
header("Location: index.php?$passgen&".SID);
exit;
}
?>
1) Because this program is free software, then no claim for the author is not accepted. Also, this paragraph applies to cases of hackin, spam, etc.<br />
2) All queations about installing and configuring the engine to send only at the official forum site.<br />
3) User agrees to keep all mention of the author, and name the engine in the code and in the pages of the engine, except for image.<br />
4) At the mention of the engine at the Forum, please refer to the website address (<a href="http://dcms.su">http://dcms.su</a>).<br />
5) The use custom functions engine, as well as a separate package engine for sale.<br />
6) .<br />
<hr />
Mod by Revan/Evan<br />
Special thanks to the authors, translator, and creator of mods themes for the engine:<br />
<b>NetFront, Siegiett, Aperoul, smarttel, dleif, RebelBK, Coder, Dimazzz</b> (sorry if anyone forgot)<br />
Also many thanks <b>Katrin</b> and <b>jEk</b> for assistance in supporting users<br />
<?
echo "<hr />\n";


echo "<form method='get' action='index.php'>\n";
echo "<input name='step' value='".($_SESSION['install_step']+1)."' type='hidden' />\n";
echo "<input name='gen' value='$passgen' type='hidden' />\n";
echo "<input value='Agree' type='submit' />\n";
echo "</form>\n";

echo "<hr />\n";
echo "<b>Step: $_SESSION[install_step]</b>\n";
include_once 'inc/foot.php'; // ??? ?c? ?? o?p?e??
?>