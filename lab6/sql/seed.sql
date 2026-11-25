-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 25, 2026 at 06:43 PM
-- Wersja serwera: 10.11.16-MariaDB
-- Wersja PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(20) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `page_list`
--

INSERT INTO `page_list` (`id`, `alias`, `page_title`, `page_content`, `status`) VALUES
(1, 'glowna', 'Katalog produktów', '<div class=\"produkty\">\r\n<section id=\"sekcja-zegara\">\r\n    <div>\r\n        <p>Data: <strong id=\"data-zegar\"></strong></p>\r\n        <p>Czas: <strong id=\"czas-zegar\"></strong></p>\r\n    </div>\r\n    <div>\r\n        <button type=\"button\" id=\"btn-start\">Start zegara</button>\r\n        <button type=\"button\" id=\"btn-stop\">Stop zegara</button>\r\n    </div>\r\n</section>\r\n<section id=\"sekcja-wyszukiwania\">\r\n    <label for=\"szukaj\">Szukaj produktu:</label>\r\n    <input type=\"search\" id=\"szukaj\" placeholder=\"Wpisz nazwę (np. 15kg)\">\r\n    <p id=\"licznik\" aria-live=\"polite\">Znaleziono: 3</p>\r\n</section>\r\n<article class=\"karta\">\r\n    <h2><a href=\"index.php?idp=produkt\">Stalowy talerz do sztangi 10kg</a></h2>\r\n    <a href=\"index.php?idp=produkt\"><img src=\"img/10kgtalerz.jpg\" alt=\"zielony 10kg talerz\" width=\"400\" height=\"400\">\r\n        <p>Precyzyjnie skalibrowany stalowy olimpijski talerz o wadze 10kg</p>\r\n        <p>Cena: 200 zł</p></a>\r\n</article>\r\n<article class=\"karta\">\r\n    <h2>Stalowy talerz do sztangi 15kg</h2>\r\n    <img src=\"img/15kgtalerz.jpg\" alt=\"zolty 15kg talerz\" width=\"400\" height=\"400\">\r\n    <p>Precyzyjnie skalibrowany stalowy olimpijski talerz o wadze 15kg</p>\r\n    <p>Cena: 300 zł</p>\r\n</article>\r\n<article class=\"karta\">\r\n    <h2>Stalowy talerz do sztangi 20kg</h2>\r\n    <img src=\"img/20kgtalerz.jpg\" alt=\"niebieski 20kg talerz\" width=\"400\" height=\"400\">\r\n    <p>Precyzyjnie skalibrowany stalowy olimpijski talerz o wadze 20kg</p>\r\n    <p>Cena: 400 zł</p>\r\n</article>\r\n<section id=\"sekcja-demonstracyjna\">\r\n    <h2>Sekcja demonstracyjna</h2>\r\n\r\n    <div id=\"przyciski-animacji\">\r\n        <button type=\"button\" id=\"btn-a\" class=\"animacja-box\" aria-pressed=\"false\">Animacja A</button>\r\n        <button type=\"button\" id=\"btn-b\" class=\"animacja-box\">Animacja B</button>\r\n        <button type=\"button\" id=\"btn-c\" class=\"animacja-box\">Animacja C</button>\r\n    </div>\r\n    <p>Liczba kroków C: <strong id=\"kroki-c\" role=\"status\">0</strong></p>\r\n    <button type=\"button\" id=\"btn-reset\">Resetuj A i C</button>\r\n    <hr>\r\n    <button type=\"button\" id=\"btn-ajax\">Sprawdź serwer</button>\r\n    <p id=\"wynik-ajax\" role=\"status\"></p>\r\n</section>\r\n</div>', 1),
(2, 'produkt', 'Produkt', '\r\n    <h2>Stalowy talerz do sztangi 10kg</h2>\r\n    <img src=\"img/10kgtalerz.jpg\" alt=\"zielony 10kg talerz\" width=\"400\" height=\"400\">\r\n\r\n    <p>Cena: 200 zł</p>\r\n    <p>Precyzyjnie skalibrowany talerz olimpijski o wadze <strong>10kg</strong>.\r\n    Świetnie nada się do intensywnych treningów siłowych.</p>\r\n\r\n    <h2>Cechy produktu:</h2>\r\n    <ul>\r\n        <li>Wytrzymały</li>\r\n        <li>Precyzyjnie skalibrowany co do grama</li>\r\n        <li>Kolorystyka spełniająca standardy</li>\r\n    </ul>\r\n    <p><a href=\"index.php?idp=kontakt\">Zapytaj o produkt</a></p>\r\n    <table>\r\n        <caption>Parametry produktu</caption>\r\n        <thead>\r\n        <tr>\r\n            <th scope=\"col\">Parametr</th>\r\n            <th scope=\"col\">Wartość</th>\r\n        </tr>\r\n        </thead>\r\n        <tbody>\r\n        <tr>\r\n            <td>Waga</td>\r\n            <td>10 kg</td>\r\n        </tr>\r\n\r\n        <tr>\r\n            <td>Średnica otworu</td>\r\n            <td>50 mm</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Materiał wykonania</td>\r\n            <td>Stal nierdzewna</td>\r\n        </tr>\r\n        </tbody>\r\n    </table>\r\n', 1),
(3, 'kontakt', 'Kontakt', '\r\n    <p>Podgląd lokalny. Formularz nie wysyła wiadomości.</p>\r\n    <form method=\"get\" action=\"index.php?idp=kontakt\">\r\n\r\n        <div>\r\n            <label for=\"email\">Adres e-mail (wymagane):</label>\r\n            <input type=\"email\" id=\"email\" name=\"email\" required>\r\n        </div>\r\n\r\n        <div>\r\n            <label for=\"produkt\">Wybierz produkt (wymagane):</label>\r\n            <select id=\"produkt\" name=\"produkt\" required>\r\n                <option value=\"\">Wybierz produkt</option>\r\n                <option value=\"talerz-10kg\">Stalowy talerz do sztangi 10kg</option>\r\n                <option value=\"talerz-15kg\">Stalowy talerz do sztangi 15kg</option>\r\n                <option value=\"talerz-20kg\">Stalowy talerz do sztangi 20kg</option>\r\n            </select>\r\n        </div>\r\n\r\n        <div>\r\n            <label for=\"ilosc\">Liczba sztuk (1-5, wymagane):</label>\r\n            <input type=\"number\" id=\"ilosc\" name=\"ilosc\" required min=\"1\" max=\"5\" step=\"1\">\r\n        </div>\r\n\r\n        <div>\r\n            <label for=\"wiadomosc\">Wiadomość (od 10 do 500 znaków, wymagane):</label>\r\n            <textarea id=\"wiadomosc\" name=\"wiadomosc\" required minlength=\"10\" maxlength=\"500\"></textarea>\r\n        </div>\r\n        <div>\r\n            <button type=\"submit\">Sprawdź zapytanie</button>\r\n        </div>\r\n\r\n    </form>\r\n    <p id=\"blad-wiadomosc\"></p>\r\n    <div id=\"podsumowanie\" aria-live=\"polite\"></div>\r\n', 1),
(4, 'filmy', 'Filmy', '<section class=\"film-sekcja\">\r\n    <h3>Test martwego ciągu sumo, czy jest prostszy od klasycznego?</h3>\r\n    <div class=\"ramka-wideo\">\r\n        <iframe src=\"https://www.youtube.com/embed/Xl2HsklUVeo\"\r\n                title=\"Test martwego ciągu sumo\"\r\n                allowfullscreen></iframe>\r\n    </div>\r\n    <p><a href=\"https://www.youtube.com/watch?v=Xl2HsklUVeo\" target=\"_blank\" rel=\"noopener\">Link do filmu</a></p>\r\n</section>\r\n\r\n<section class=\"film-sekcja\">\r\n    <h3>Eddie Hall wyciska 265kg na ławce płaskiej</h3>\r\n    <div class=\"ramka-wideo\">\r\n        <iframe src=\"https://www.youtube.com/embed/74nhtcP1Ur0\"\r\n                title=\"Eddie Hall wyciska 265kg\"\r\n                allowfullscreen></iframe>\r\n    </div>\r\n    <p><a href=\"https://www.youtube.com/watch?v=74nhtcP1Ur0\" target=\"_blank\" rel=\"noopener\">Link do filmu</a></p>\r\n</section>\r\n\r\n<section class=\"film-sekcja\">\r\n    <h3>Jak wykonuje się talerze ciężarowe</h3>\r\n    <div class=\"ramka-wideo\">\r\n        <iframe src=\"https://www.youtube.com/embed/vCOCzaQoKjs\"\r\n                title=\"Jak wykonuje się talerze\"\r\n                allowfullscreen></iframe>\r\n    </div>\r\n    <p><a href=\"https://www.youtube.com/watch?v=vCOCzaQoKjs\" target=\"_blank\" rel=\"noopener\">Link do filmu</a></p>\r\n</section>', 1),
(5, 'o-nas', 'O nas', '<h2>O nas (Szkic)</h2>', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
