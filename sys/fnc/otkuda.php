<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang



if (isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && !ereg('(rules)|(smiles)|(secure)|(aut)|(reg)|(umenu)|(zakl)|(mail)|(anketa)|(settings)|(avatar)|(info)\.php',$_SERVER['SCRIPT_NAME']))

$_SESSION['refer']=NULL;



function otkuda($ref)

{
if (eregi('^/opera_maker/',$ref))
$mesto='Forum';

if (eregi('^/opera/',$ref))

$mesto='Forum';

elseif (eregi('^/chat/',$ref))

$mesto='(Chatroom)';

elseif (eregi('^/lib/',$ref))

$mesto='Library';

elseif (eregi('^/news/',$ref))
$mesto='(News)';

elseif (eregi('^/group/',$ref))

$mesto='(Group)';

elseif (eregi('^/votes/',$ref))

$mesto='(Votes)';

elseif (eregi('^/guest/',$ref))

$mesto='(Guestbook)';

elseif (eregi('^/blog/',$ref))
$mesto='(Notes)';

elseif (eregi('^/foto/',$ref))

$mesto='(Album)';

elseif (eregi('^/loads/',$ref))

$mesto='(Download)';

elseif (eregi('^/users\.php',$ref))

$mesto='(All Users)';

elseif (eregi('^/online\.php',$ref))
$mesto='(Online)';

elseif (eregi('^/jurnal\.php',$ref))

$mesto='(Notification)';

elseif (eregi('^/info\.php',$ref))

$mesto='(Profile)';

elseif (eregi('^/frend\.php',$ref))

$mesto='(Friends)';

elseif (eregi('^/gifts\.php',$ref))

$mesto='(Gifts)';
elseif (eregi('^/avatar\.php',$ref))

$mesto='(Photo Profile)';

elseif (eregi('^/rules\.php',$ref))

$mesto='(Site Rules)';

elseif (eregi('^/bantuan\.php',$ref))

$mesto='(Helps Center)';

elseif (eregi('^/about\.php',$ref))

$mesto='(About LoeGue)';
elseif (eregi('^/terms\.php',$ref))

$mesto='(Terms of Service)';

elseif (eregi('^/online_g\.php',$ref))

$mesto='(Guest Online)';

elseif (eregi('^/reg\.php',$ref))

$mesto='(Registration)';

elseif (eregi('^/shout/',$ref))

$mesto='(Shoutbox)';

elseif (eregi('^/new/games/',$ref))

$mesto='Downloads Games';

elseif (eregi('^/loads\.php',$ref))

$mesto='Downloads fank';

elseif (eregi('^/youtube/',$ref))

$mesto='You tube';

elseif (eregi('^/xxx/',$ref))

$mesto='Downloads adult';

elseif (eregi('^/aut\.php',$ref))

$mesto='Login Site';

elseif (eregi('^/menu\.php',$ref))

$mesto='(Other menu)';

elseif (eregi('^/index\.php',$ref))

$mesto='(Home)';

elseif (eregi('^/list\.php',$ref))
$mesto='(Status)';

elseif (eregi('^/\??$',$ref))

$mesto='(Home)';

else

$mesto=false;

return $mesto;
}

?>
