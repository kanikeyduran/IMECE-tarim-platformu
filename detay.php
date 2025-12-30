<?php
error_reporting(0);
require_once 'baglanti.php';

// URL'den ID parametresini al (Güvenlik önlemi ile)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$ilan = null;

if(isset($db) && $id > 0) {
    // SQL Injection korumalı sorgu (Prepare/Execute)
    $sorgu = $db->prepare("SELECT listings.*, lands.city, lands.district, lands.size_m2, lands.has_water, users.first_name, users.last_name 
                           FROM listings 
                           JOIN lands ON listings.land_id = lands.id 
                           JOIN users ON lands.owner_id = users.id 
                           WHERE listings.id = :id");
    $sorgu->execute(['id' => $id]);
    $ilan = $sorgu->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $ilan ? $ilan['title'] : 'İlan Bulunamadı'; ?> - İMECE</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="header">
    <div class="header-content">
        <a href="index.php" class="logo">🌱 İMECE</a>
        <div class="nav">
            <a href="index.php">← Listeye Dön</a>
        </div>
    </div>
</div>

<div class="container">
    <?php if($ilan): ?>
    
    <div class="detay-grid">
        <div class="detay-sol">
            <h1><?php echo $ilan['title']; ?></h1>
            <div class="konum" style="font-size: 18px; margin-bottom: 20px;">
                📍 <?php echo $ilan['city'] . " / " . $ilan['district']; ?>
            </div>
            
            <h3>Arazi Özellikleri</h3>
            <ul class="ozellik-listesi">
                <li><b>📏 Büyüklük:</b> <?php echo number_format($ilan['size_m2']); ?> m²</li>
                <li><b>💧 Su Durumu:</b> <?php echo $ilan['has_water'] ? 'Mevcut (Sulak Arazi)' : 'Yok (Kuru Tarım)'; ?></li>
                <li><b>💰 Talep Edilen:</b> <?php echo $ilan['revenue_share_percent'] ? "%" . $ilan['revenue_share_percent'] . " Ürün Payı" : number_format($ilan['price_requested']) . " TL"; ?></li>
            </ul>

            <h3>Açıklama</h3>
            <p style="line-height: 1.6; color: #555;"><?php echo nl2br($ilan['description']); ?></p>
        </div>

        <div class="detay-sag">
            <div style="text-align:center; margin-bottom:20px;">
                <div style="font-size:50px; background:#f0f0f0; width:80px; height:80px; line-height:80px; border-radius:50%; margin:0 auto 10px;">👨‍🌾</div>
                <h3><?php echo $ilan['first_name'] . " " . $ilan['last_name']; ?></h3>
                <span class="ilan-sahibi">Arazi Sahibi</span>
            </div>
            
            <hr style="border:0; border-top:1px solid #eee; margin: 20px 0;">
            
            <h4 style="margin-top:0;">Teklif Gönder</h4>
            <textarea rows="4" placeholder="Merhaba, arazinizle ilgileniyorum. Detayları görüşebilir miyiz?"></textarea>
            <button class="btn" style="width:100%;" onclick="alert('Mesajınız başarıyla iletildi! (Demo)')">Mesajı Gönder</button>
        </div>
    </div>

    <?php else: ?>
        <div class="ilan-kutu" style="text-align:center; color:red;">
            <h2>🚫 İlan Bulunamadı</h2>
            <p>Aradığınız ilan yayından kaldırılmış veya bağlantı hatası var.</p>
            <a href="index.php" class="btn">Ana Sayfaya Dön</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>