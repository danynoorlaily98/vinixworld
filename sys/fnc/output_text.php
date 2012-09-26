<?
// функция обрабатывает текстовые строки перед выводом в браузер
// настоятельно не рекомундуется тут что-либо менять
function output_text($str,$br=true,$html=true,$smiles=true,$links=true,$bbcode=true)
{
if ($html==true)
$str=htmlentities($str, ENT_QUOTES, 'UTF-8'); // преобразуем все к нормальному перевариванию браузером

if ($links==true)
$str=links($str); // обработка ссылок

if ($bbcode==true)
{
$tmp_str=$str;
$str=bbcode($str); // обработка bbcode
}

if ($smiles==true && $tmp_str==$str)
$str=smiles($str); // вставка смайлов

if ($br==true){
$str=br($str); // переносы строк
$str=esc($str); // вырезаем все нечитаемые символы, которые могут нам подпортить разметку :)
}
else
{
//$str=br($str, ' '); // пробелы вместо переносов
$str=esc($str); // вырезаем все нечитаемые символы, которые могут нам подпортить разметку :)
}
return $str; // возвращаем обработанную строку
}
?>