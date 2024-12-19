<?php 

if ($_GET) 
{

include("../baglan.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($baglanti->query("DELETE FROM kayit WHERE id =".(int)$_GET['id'])) 
{
    header("location:index.php"); // Eğer sorgu çalışırsa index.php sayfasına gönderiyoruz.
}
}

?>