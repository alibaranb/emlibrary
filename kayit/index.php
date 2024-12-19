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
    <title>Kayıt - Kütüphane takip sistemi</title>

    <!-- META -->
    <meta charset="UTF-8">
    <meta name="author" content="Ali Baran Bayrambey, Musa Çetin">
    <meta name="Description" content="Manavgat Teknik ve Endüstri Meslek Lisesi kütüphane sistemi."/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/pushy.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css">

    <!-- Icon Set -->
    <link rel="stylesheet" href="../css/font-endustri-manavgat.css" type="text/css">

    <!-- JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                <li class="pushy-link"><a href="../kayit/"><i class="icon-entry"></i>&nbsp;Kayıt Yap</a></li>
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

            
            <!-- Content -->
            <div class="container my-5">
                <form action="" method="post">
                <table class="table text-nowrap" style="font-size:20px">
                <thead class="thead-dark">
                <tr>
                <th style="text-align:center" colspan="2">Kayıt Yap</th>
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
                <td><input type="date" data-date-format="DD-MM-YYYY" name="alis_tarih" class="form-control" autocomplete="off"></td>
                </tr>

                <tr>
                <td>Teslim Tarihi :</td>
                <td><input type="date" data-date-format="DD-MM-YYYY" name="veris_tarih" class="form-control" autocomplete="off"></td>
                </tr>

                <tr>
                <td colspan="2"><input class="btn btn-primary w-100"  type="submit" value="Ekle"></td>
                </tr>
                <tr>
                <!-- KİTAP EKLE -->
                <?php
                if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                    $ogr_ad = $_POST['ogr_ad'];
                    $kitap_ad = $_POST['kitap_ad'];
                    $alis_tarih = $_POST['alis_tarih'];
                    $veris_tarih = $_POST['veris_tarih'];

                    if ($ogr_ad<>"" && $kitap_ad<>"" && $alis_tarih<>"") {
                    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
                    
                        // Veri ekleme sorgumuzu yazıyoruz.
                        if ($baglanti->query("INSERT INTO kayit (ogr_ad, kitap_ad, alis_tarih, veris_tarih) VALUES ('$ogr_ad','$kitap_ad','$alis_tarih','$veris_tarih')"))
                        {
                            echo "<div class='alert alert-success' role='alert'>
                            Kayıt eklendi.
                        </div>"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                        }
                        else
                        {
                            echo "<div class='alert alert-danger' role='alert'>
                            Kayıt eklenirken bir sorun oluştu.
                          </div>";
                        }
                    }
                }
                ?>
                <!-- KİTAP EKLE SON -->
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


<!-- LİSTELEME -->
<div class="container">
<table class="table table-responsive-sm table-striped text-center">
<thead class="thead-dark">
    <tr>
        <th>No</th>
        <th>Öğrenci Adı</th>
        <th>Kitap Adı</th>
        <th>Alış Tarihi</th>
        <th>Teslim Tarihi</th>
        <th></th>
        <th></th>
        <th><input class="form-control aramakutu" type="text" id="cubukara" placeholder="Ara.."></th>
    </tr>
</thead>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->
<?php 
$sorgu = $baglanti->query("SELECT * FROM kayit"); // Kayit tablosundaki tüm verileri çekiyoruz.

echo "<tbody id='tabloicerik' class='bg-white'>";

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$ogr_ad = $sonuc['ogr_ad'];
$kitap_ad = $sonuc['kitap_ad'];
$alis_tarih = $sonuc['alis_tarih'];
$veris_tarih = $sonuc['veris_tarih'];

// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $ogr_ad; ?></td>
        <td><?php echo $kitap_ad; ?></td>
        <td><?php echo $alis_tarih; ?></td>
        <td><?php echo $veris_tarih; ?></td>
        <td></td>
        <td></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="far fa-edit"></i></a>
        <a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
    </tr>
<?php 
} 
echo "</tbody>";
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
            <!-- Content Bitiş -->
        </div>
        </div>
        
<script src="../js/pushy.min.js"></script>

<script>
$(document).ready(function(){
  $("#cubukara").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabloicerik tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>