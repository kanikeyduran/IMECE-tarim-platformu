<?php
require_once 'baglanti.php';
// Form submit işlemleri burada yapılacak (Demo için basitleştirildi)
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni İlan Ver - İMECE</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="header">
    <div class="header-content">
        <a href="index.php" class="logo">🌱 İMECE</a>
        <div class="nav">
            <a href="index.php">Ana Sayfa</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="form-kutu">
        <h2 style="text-align:center; border-bottom: 2px solid #eee; padding-bottom: 20px;">
            📝 Yeni İlan Oluştur
        </h2>
        
        <form method="POST">
            <label><b>İlan Başlığı</b></label>
            <input type="text" name="baslik" placeholder="Örn: Gönen Ovası'nda Verimli Tarla" required>
            
            <div style="display:flex; gap:15px;">
                <div style="flex:1;">
                    <label><b>Şehir</b></label>
                    <input type="text" name="sehir" placeholder="Örn: Balıkesir" required>
                </div>
                <div style="flex:1;">
                    <label><b>İlçe</b></label>
                    <input type="text" name="ilce" placeholder="Örn: Gönen" required>
                </div>
            </div>
            
            <label><b>Arazi Büyüklüğü (m²)</b></label>
            <input type="number" name="m2" placeholder="5000" required>
            
            <label><b>Açıklama</b></label>
            <textarea name="aciklama" rows="4" placeholder="Arazinin konumu, su durumu ve toprak yapısı hakkında bilgi verin..."></textarea>
            
            <button type="button" class="btn" style="width:100%; margin-top:10px;" 
                onclick="alert('Tebrikler! İlanınız sisteme eklendi (Simülasyon).'); window.location.href='index.php';">
                🚀 İlanı Yayınla
            </button>
        </form>
    </div>
</div>

</body>
</html>