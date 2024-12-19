-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Haz 2019, 13:19:13
-- Sunucu sürümü: 10.1.40-MariaDB
-- PHP Sürümü: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `emlibrar_kutuphane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayit`
--

CREATE TABLE `kayit` (
  `id` int(11) NOT NULL,
  `ogr_ad` varchar(25) NOT NULL COMMENT 'Öğrenci Adı',
  `kitap_ad` varchar(25) NOT NULL COMMENT 'Kitap Adı',
  `alis_tarih` varchar(10) NOT NULL COMMENT 'Kitap Alınış Tarihi',
  `veris_tarih` varchar(10) NOT NULL COMMENT 'Kitap Teslim Tarihi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kayit`
--

INSERT INTO `kayit` (`id`, `ogr_ad`, `kitap_ad`, `alis_tarih`, `veris_tarih`) VALUES
(7, 'Ali Baran Bayrambey', 'Şeker Portakalı', '2019-06-10', '2019-06-13'),
(8, 'Jean Michel', 'Fahrenheit 451', '2019-06-10', ''),
(9, 'Deneme1', 'Fahrenheit 451', '2019-06-12', ''),
(12, 'Ali Baran Bayrambey', 'Deneme123', '2019-06-11', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap`
--

CREATE TABLE `kitap` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) NOT NULL,
  `yazar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kitap`
--

INSERT INTO `kitap` (`id`, `ad`, `yazar`) VALUES
(23, 'Gör Beni-İki Devrin Hikayesi', 'Akilah Azra Kohen'),
(24, 'Fahrenheit 451', 'Ray Bradbury'),
(26, 'Deneme123', 'Test Test');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` int(5) NOT NULL,
  `ad_soyad` varchar(25) NOT NULL,
  `telefon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`id`, `ad_soyad`, `telefon`) VALUES
(144, 'Deneme1', '1231231321'),
(165, 'Musa Çetin', '5554432211'),
(364, 'Jean Michel', '5456234256'),
(494, 'Ali Baran Bayrambey', '5365869290');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye`
--

CREATE TABLE `uye` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uye`
--

INSERT INTO `uye` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kayit`
--
ALTER TABLE `kayit`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kitap`
--
ALTER TABLE `kitap`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uye`
--
ALTER TABLE `uye`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kayit`
--
ALTER TABLE `kayit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `kitap`
--
ALTER TABLE `kitap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `uye`
--
ALTER TABLE `uye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
