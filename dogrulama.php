<?php
session_start();
// Veritabanı bağlantı.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'emlibrar_kutuphane';
// Bilgilerle giriş.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// Eğer hata varsa scripti durdur ve hatayı göster.
	die ('Veritabanına bağlanırken sorun oluştu: ' . mysqli_connect_error());
}

// Giriş bilgileri paylaşılmış mı kontrol et, isset() veri var mı kontrol eder.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Paylaşılan veri alınamadıysa hata göster.
	die ('Lütfen iki alanıda doldurun!');
}

// SQL injectionı önlemek.
if ($stmt = $con->prepare('SELECT id, password FROM uye WHERE username = ?')) {
	// Parametre verme (s = string, i = int, b = blob, etc), username olduğu için "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Sonuçları sakla ki veritabanında var mı bakalım.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Kullanıcı adı var, şimdi şifreye bakalım.
        if ($_POST['password'] === $password) {
            // Onaylama başarulı! Kullanıcı girdi!
            // Session yarat ki giriş yapıldığını bilelim, Cookie gibi davranırlar ama veriler serverde saklanır.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: kitap');
        } else {
            echo 'Yanlış şifre!';
        }
    } else {
        echo 'Yanlış kullanıcı adı!';
    }
    $stmt->close();
}