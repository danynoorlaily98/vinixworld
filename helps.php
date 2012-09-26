<?

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';


//only_reg();
$set['title']='Bantuan Situs';
include_once 'sys/inc/thead.php';
title();
err();
aut();
echo "1. Untuk bisa berinteraksi dengan orang-orang yang
mungkin anda kenal anda harus Masuk atau Daftar dahulu<br/>";
echo "2. Setelah mendaftar silahkan melengkapi data diri anda supaya lebih mudah dikenal<br/>";
echo "3. Member dapat chating dalam ruang obrolan yang telah disediakan<br/>";
echo "4. Member dapat membuat sebuah tulisan yang disebut blog dari member yang dapat digunakan untuk pribadi atau di publikasikan untuk dibaca siapa saja<br/>";
echo "5. Sebagai member anda dapat menambahkan pengguna yang lain sebagai teman anda<br/>";
echo "6. Sesama pengguna anda dapat berkomunikasi dengan pesan pribadi dan atau pesan dinding<br/>";echo "7. Sebagai member anda dapat melakukan posting di chat dengan menggunakan emoticon atau kode senyuman yang sudah ada dengan melihat kodenya<br/>";echo "8. Untuk mengisi informasi profil, mengupload foto silahkan masuk pengaturan setelah anda login<br/>";echo "9. Informasi lebih lanjut dapat ditanyakan pada admin atau moderator. Semoga Anda enjoy...!<br/>";
include "new.php";
include_once 'sys/inc/tfoot.php';
?>
