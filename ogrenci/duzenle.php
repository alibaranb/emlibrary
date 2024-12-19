<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

include("../baglan.php"); // Veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!DOCTYPE html>
<head>
    <title>Öğrenci düzenle - Kütüphane takip sistemi</title>

    <!-- META -->
    <meta charset="UTF-8">
    <meta name="author" content="Ali Baran Bayrambey, Musa Çetin">
    <meta name="Description" content="Manavgat Teknik ve Endüstri Meslek Lisesi kütüphane sistemi."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/pushy.css">
    
    <!-- Icon Set -->
    <link rel="stylesheet" href="../css/font-endustri-manavgat.css" type="text/css">
</head>

<body>
<!-- MENÜ -->
<nav class="pushy pushy-left">
        <div class="pushy-content">
            <ul>
                <li class="pushy-link"><a href="../kitap/"><i class="icon-book-list"></i>&nbsp;Kitap Listesi</a></li>
                <li class="pushy-link"><a href="../ogrenci/"><i class="icon-st-list"></i>&nbsp;Öğrenci Listesi</a></li>
                <li class="pushy-link"><a href="#"><i class="icon-entry"></i>&nbsp;Kayıt Yap</a></li>
                <li class="pushy-link"><a href="../cikis.php"><i style="font-size:25px" class="fas fa-sign-out-alt"></i>&nbsp;Çıkış Yap</a></li>
            </ul>
        </div>
    </nav>
    <!-- MENÜ Bitiş -->

        <div class="site-overlay"> </div>

        <div id="container" class="px-2">
            <!-- Menu Button -->
            <div class="menu-btn">
                <i style="font-size: 25px; cursor: pointer" class="icon-menu"></i>
            </div>
        </div>
            <!-- Content -->
            <?php 

$sorgu = $baglanti->query("SELECT * FROM ogrenci WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>
            <div class="container my-5">
<form action="" method="post">
    <table class="table" style="font-size:20px">
    <thead class="thead-dark">
                <tr>
                <th style="text-align:center" colspan="2">Öğrenci Düzenle</th>
                </tr>
                </thead>
                <tbody class="bg-white">
        <tr>
            <td>Öğrenci No :</td>
            <td><input type="text" name="ogrenci_no" autocomplete="off" maxlength="5" class="form-control" value="<?php echo $sonuc['id']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Ad Soyad :</td>
            <td><input type="text" name="ogrenci_ad" autocomplete="off"  maxlength="25" class="form-control" value="<?php echo $sonuc['ad_soyad'];?>"></td>
        </tr>

        <tr>
            <td>Telefon No :</td>
            <td><input type="text" name="ogrenci_tel" autocomplete="off"  maxlength="25" class="form-control" value="<?php echo $sonuc['telefon'];?>"></td>
        </tr>

        <tr>
            <td colspan="2"><input type="submit" class="btn btn-primary w-100" value="Kaydet"></td>
        </tr>
        </tbody>
    </table>
</form>
</div>
<div>

<?php 
if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $ogrenci_no = $_POST['ogrenci_no']; // Post edilen değerleri değişkenlere aktarıyoruz
    $ogrenci_ad = $_POST['ogrenci_ad'];
    $ogrenci_tel = $_POST['ogrenci_tel'];

    if ($ogrenci_no<>"" && $ogrenci_ad<>"" && $ogrenci_tel<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if ($baglanti->query("UPDATE ogrenci SET id = '$ogrenci_no', ad_soyad = '$ogrenci_ad', telefon = '$ogrenci_tel' WHERE id =".$_GET['id'])) 
        {
            header("location:index.php"); 
            // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Öğrenci güncellenirken bir hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}
?>
            </div> <!-- Content Bitiş -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="../js/pushy.min.js"></script>
            </body>
</html>