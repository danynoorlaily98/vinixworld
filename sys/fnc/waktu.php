<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function waktu($waktu){
global $set,$time;
static $users;
$lama=round(($time-$waktu)/60);
if($lama<1){$lama='Just now';}
if($lama>=1 && $lama<60){$lama="$lama minutes ago";}
if($lama>=60 && $lama<1440){$lama=round($lama/60); $lama="$lama hours ago";}
if($lama>=1440){$lama=round($lama/60/24); $lama="$lama days ago";}
return $lama;
}
?>
