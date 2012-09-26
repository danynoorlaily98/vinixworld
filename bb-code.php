<?
//Kode BB-untuk DCMS //
//Pengarang: BespredeL //
//Website: www.wsmart.ru //
//Translite: ade //
//Website: www.seupangku.co.cc//
//Ini adalah script gratis //
//Anda tidak memiliki hak//
//mendistribusikan script ini!//
//Versi : 3.1 //
include_once './sys/inc/start.php';
include_once './sys/inc/compress.php';
include_once './sys/inc/sess.php';
include_once './sys/inc/home.php';
include_once './sys/inc/settings.php';
include_once './sys/inc/db_connect.php';
include_once './sys/inc/ipua.php';
include_once './sys/inc/fnc.php';
include_once './sys/inc/user.php';
$set['title']='BB-Code';
include_once './sys/inc/thead.php';
title();
err();

echo "<div class='menu'>\n";
echo 'Style Text:<br />';
echo "<input type='text' value='[b]Your Text[/b]'/></a><strong>Bold</strong><br />\n";
echo "<input type='text' value='[i]Your Text[/i]' /></a><em>Italic</em><br />\n";
echo "<input type='text' value='[das]Your Text[/das]' /></a><span style='border:1px dashed;'>box appears</span><br />\n";
echo "<input type='text' value='[marq]Your Text[/marq]' /></a><marquee>Text Moves</marquee><br />\n";
echo "<input type='text' value='[c]Your Text[/c]' /></a><center>Message Center</center><br/>\n";
echo "<input type='text' value='[sol]Your Text/sol]' /></a><span style='border:1px solid;'>Box appears</span><br/>\n";
echo "<input type='text' value='[ex]Your Text[/ex]' /></a><span style='text-decoration:line-through;'>Strikethrough Text</span><br />\n";
echo "<input type='text' value='[up]Your Text[/up]' /></a><span style='text-decoration:overline;'>Page Breaks</span><br />\n";
echo "<input type='text' value='[bl]Your Text[/bl]' /></a><span style='text-decoration:blink;'>Blink</span><br />\n";
echo "<input type='text' value='[dot]Your Text[/dot]' /></a><span style='border:1px dotted;'>dotted</span><br />\n";
echo "<input type='text' value='[scr-w]Your Text[/scr-w]' /></a><span style='background-color:#ffffff;'><span style='color:#ffffff;'><span style='border:1px dashed;'>Hidden Text</span></span></span>[/scr-w]<br />\n";
echo "<input type='text' value='[scr-b]Your Text[/scr-b]' /></a><span style='background-color:#000000;'><span style='color:#000000;'><span style='border:1px dashed;'>Hidden Text</span></span></span><br />\n";
echo "<input type='text' value='[dou]Your Text[/dou]' /></a><span style='border:3px double #E1E1E4;'>box</span><br />\n";
echo "<input type='text' value='[in]Your Text[/in]' /></a>Input Text<br />\n";
echo '<hr/>';
echo 'Color Text:<br />';
echo "<input type='text' value='[red]Your Text[/red]'/></a><font color='red'>Red Text</font><br />\n";
echo "<input type='text' value='[green]Your Text[/green]' /></a><font color='green'>Text green</font><br />\n";
echo "<input type='text' value='[blue]Your Text[/blue]' /></a><font color='blue'>Text blue</font><br />\n";
echo "<input type='text' value='[yellow]Your Text[/yellow]' /></a><font color='yellow'>Yellow Text</font><br />\n";
echo "<input type='text' value='[white]Your Text[/white]' /></a><font color='white'>White Text</font><br />\n";
echo '<hr />';
echo 'Ref<br />';
echo "<input type='text' value='[u=id User]Nickname[/u]'/></a><a href='/info.php?id=4'>Nickname</a><br />\n";
echo "</div></div>\n";
$rid = $_SESSION["rid"];
if($rid>0)echo "<br/><a href='/chat/room/$rid/".rand(1000,9999)."/'>Volver a la Sala</a><br />\n";
include_once './sys/inc/tfoot.php';
?>
