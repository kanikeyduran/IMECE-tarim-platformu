<?php
// Hataları gizle (Production modu)
error_reporting(0);
require_once 'baglanti.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İMECE - Tarım Platformu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="header">
        <div class="header-content">
            <a href="index.php" class="logo">🌱 İMECE</a>
            <div class="nav">
                <a href="index.php">Ana Sayfa</a>
                <a href="ilan-ver.php">📢 İlan Ver</a>
                <a href="#">Giriş Yap</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1 style="border-bottom: 3px solid #27ae60; display: inline-block; padding-bottom: 5px;">
            Güncel Tarım Arazileri
        </h1>
        <p style="margin-bottom: 30px; color: #666;">Bölgenizdeki en verimli tarım arazilerini inceleyin.</p>

        <?php
        // Veritabanı bağlantısı kontrolü
        if(isset($db)) {
            // İlanları listeleme sorgusu (JOIN işlemi ile tabloları birleştiriyoruz)
            $sorgu = "SELECT 
                        listings.*, 
                        lands.city, 
                        lands.district, 
                        lands.size_m2, 
                        users.first_name, 
                        users.last_name 
                      FROM listings 
                      JOIN lands ON listings.land_id = lands.id 
                      JOIN users ON lands.owner_id = users.id 
                      WHERE listings.status = 'active' 
                      ORDER BY listings.id DESC";
            
            $stmt = $db->query($sorgu);

            // Döngü ile ilanları kart olarak basıyoruz
            while ($ilan = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="ilan-kutu">
                <div class="ilan-bilgi">
                    <div class="ilan-baslik"><?php echo $ilan['title']; ?></div>
                    <div class="konum">
                        📍 <?php echo $ilan['city'] . " / " . $ilan['district']; ?> 
                        &nbsp;|&nbsp; 
                        📐 <?php echo number_format($ilan['size_m2']); ?> m²
                    </div>
                    <div class="ilan-sahibi">
                        👨‍🌾 İlan Sahibi: <?php echo $ilan['first_name'] . " " . $ilan['last_name']; ?>
                    </div>
                </div>
                
                <div class="fiyat-alani">
                    <span class="fiyat">
                        <?php 
                            // Gelir paylaşımı mı yoksa nakit mi?
                            echo $ilan['revenue_share_percent'] 
                                ? "%" . $ilan['revenue_share_percent'] . " Ortaklık" 
                                : number_format($ilan['price_requested']) . " TL"; 
                        ?>
                    </span>
                    <a href="detay.php?id=<?php echo $ilan['id']; ?>" class="btn">İncele</a>
                </div>
            </div>
        <?php 
            } // While döngüsü bitişi
        } else {
            // Veritabanı dosyası import edilmemişse uyarı
            echo "<div style='padding:20px; background:white; color:red;'>⚠️ Veritabanı bağlantısı kurulamadı. Lütfen baglanti.php ayarlarını kontrol edin.</div>";
        }
        ?>

    </div>

</body>
</html>