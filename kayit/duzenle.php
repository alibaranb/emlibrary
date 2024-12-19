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
    <title>Kayıt düzenle - Kütüphane takip sistemi</title>

    <!-- META -->
    <meta charset="UTF-8">
    <meta name="author" content="Ali Baran Bayrambey, Musa Çetin">
    <meta name="Description" content="Manavgat Teknik ve Endüstri Meslek Lisesi kütüphane sistemi."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/pushy.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css">
    
    <!-- Icon Set -->
    <link rel="stylesheet" href="../css/font-endustri-manavgat.css" type="text/css">
	
	<!-- Script -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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

$sorgu = $baglanti->query("SELECT * FROM kayit WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>
            <div class="container my-5">
<form action="" method="post">
    <table class="table" style="font-size:20px">
    <thead class="thead-dark">
        <tr>
        <th style="text-align:center" colspan="2">Kayıt Düzenle</th>
        </tr>
    </thead>
    <tbody class="bg-white">
    <tr>
                <td>Öğrenci Adı Soyadı :</td>
                <td><input type="text" name="ogr_ad" id="ogr_ad" class="form-control" autocomplete="off" maxlength="100"></td>
                </tr>
                
                <tr>
                <td>Kitabın Adı :</td>
                <td><input type="text" name="kitap_ad" id="kitap_ad" class="form-control" autocomplete="off" maxlength="100"></td>
                </tr>

                <tr>
                <td>Alış Tarihi :</td>
                <td><input type="date" data-date-format="YYYY-MM-DD" name="alis_tarih" class="form-control" autocomplete="off"></td>
                </tr>

                <tr>
                <td>Teslim Tarihi :</td>
                <td><input type="date" data-date-format="YYYY-MM-DD" name="veris_tarih" class="form-control" autocomplete="off"></td>
                </tr>

        <tr>
            <td colspan="2"><input type="submit" class="btn btn-primary w-100" value="Kaydet"></td>
        </tr>
    </tbody>
    </table>
	<!-- Script -->
                <script type='text/javascript' >
                    $( function() {
                        $( "#ogr_ad" ).autocomplete({
                            source: function( request, response ) {
                                $.ajax({
                                    url: "vericekogr.php",
                                    type: 'post',
                                    dataType: "json",
									minLength: 0,
									minChars:0,
                                    data: {
                                        search: request.term
                                    },
                                    success: function( data ) {
                                        response( data );
                                    }
                                });
                            },
                            select: function (event, ui) {
                                $('#ogr_ad').val(ui.item.label); // Seçilen yazıyı gösterir
                                return false;
                            }
                        });
                    });
                </script>
                <!-- Script -->
                <script type='text/javascript' >
                    $( function() {
                        $( "#kitap_ad" ).autocomplete({
                            source: function( request, response ) {
                                $.ajax({
                                    url: "vericekitap.php",
                                    type: 'post',
									minLength: 0,
									minChars:0,
                                    dataType: "json",
                                    data: {
                                        search: request.term
                                    },
                                    success: function( data ) {
                                        response( data );
                                    }
                                });
                            },
                            select: function (event, ui) {
                                $('#kitap_ad').val(ui.item.label); // Seçilen yazıyı gösterir
                                return false;
                            }
                        });
                    });
                </script>
</form>
</div>
<div>

<?php 
if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $ogr_ad = $_POST['ogr_ad']; // Post edilen değerleri değişkenlere aktarıyoruz
    $kitap_ad = $_POST['kitap_ad'];
    $alis_tarih = $_POST['alis_tarih'];
    $veris_tarih = $_POST['veris_tarih'];


    if ($ogr_ad<>"" && $kitap_ad<>"" && $alis_tarih<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if ($baglanti->query("UPDATE kayit SET ogr_ad = '$ogr_ad', kitap_ad = '$kitap_ad', alis_tarih = '$alis_tarih', veris_tarih = '$veris_tarih' WHERE id =".$_GET['id'])) 
        {
            header("location:index.php"); 
            // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Kayıt güncellenirken bir hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}
?>
            </div> <!-- Content Bitiş -->
<script src="../js/pushy.min.js"></script>
            </body>
</html>