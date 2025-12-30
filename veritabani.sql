-- İMECE Projesi Veritabanı Yapısı
-- Geliştirici: Ayşen Duran

CREATE DATABASE IF NOT EXISTS imece_db;
USE imece_db;

-- Kullanıcılar Tablosu
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    role ENUM('land_owner', 'producer')
);

-- Araziler Tablosu
CREATE TABLE lands (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    owner_id BIGINT,
    city VARCHAR(50),
    district VARCHAR(50),
    size_m2 INT,
    has_water BOOLEAN,
    FOREIGN KEY (owner_id) REFERENCES users(id)
);

-- İlanlar Tablosu
CREATE TABLE listings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    land_id BIGINT,
    title VARCHAR(150),
    description TEXT,
    price_requested DECIMAL(10,2),
    revenue_share_percent INT,
    status ENUM('active', 'passive') DEFAULT 'active',
    FOREIGN KEY (land_id) REFERENCES lands(id)
);

-- Örnek Veri Girişi
INSERT INTO users (first_name, last_name, role) VALUES ('Ahmet', 'Yılmaz', 'land_owner');
INSERT INTO lands (owner_id, city, district, size_m2, has_water) VALUES (1, 'Balıkesir', 'Gönen', 5000, 1);
INSERT INTO listings (land_id, title, description, revenue_share_percent) VALUES (1, 'Gönen Ovasında Verimli Çeltik Tarlası', 'Suyu boldur.', 30);