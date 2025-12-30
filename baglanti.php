<?php
// Veritabanı Ayarları
$host = 'localhost';
$dbname = 'imece_db';
$username = 'root';
$password = ''; // XAMPP'te varsayılan şifre boştur

try {
    // Bağlantıyı oluşturuyoruz (PDO kullanarak - en güvenli yöntemdir)
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Hata modunu açalım (Hata olursa bize söylesin)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Eğer buraya kadar geldiyse çalışmış demektir
    // echo "Veritabanı bağlantısı başarılı! 🚀"; 
    // (Bu satırı test ettikten sonra silebilirsin, ekranda sürekli yazmasın)

} catch (PDOException $e) {
    // Hata olursa ekrana bunu yaz
    echo "Bağlantı Hatası: " . $e->getMessage();
    die();
}
?>