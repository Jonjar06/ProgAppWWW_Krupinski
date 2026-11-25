**Wersja projektu:** v1.5
## Instrukcja uruchomienia i odtworzenia bazy
1. **Pobranie katalogu**
   * Przenieś katalog `lab6` do `htdocs` w katalogu instalacji XAMPP
2. **Baza danych i import:**
   * Uruchom Apache i MySQL w XAMPP
   * W phpmyadmin utwórz nową bazę danych o nazwie `moja_strona` (kodowanie `utf8mb4_general_ci`)
   * Zaimportuj strukturę bazy z pliku `sql/schema.sql`
   * Zaimportuj dane z pliku `sql/seed.sql`

3. **Utworzenie lokalnego użytkownika:**
   * W phpmyadmin przejdź do zakładki "Konta użytkowników" i utwórz nowe konto
   * Nadaj temu użytkownikowi uprawnienia **tylko do odczytu (SELECT)** dla bazy `moja_strona`

4. **Konfiguracja połączenia:**
   * Zmień nazwę `cfg.example.php` na `cfg.php`
   * Uzupełnij w nim dane dostępowe: `$user` i `$pass` 

5. **Uruchomienie:**
   * Wejdź na: `http://localhost/lab6/index.php`

## Pseudokod odczytu strony

1. Pobierz identyfikator strony (`idp`) z parametrów adresu URL (`$_GET`)
2. Jeśli parametr jest pusty lub go nie ma, ustaw domyślnie `glowna`
3. Sprawdź, czy parametr jest tekstem o prawidłowym formacie (małe litery, cyfry, myślniki). Jeśli nie, ustaw kod HTTP 404 (Błąd klienta)
4. **Odczyt z bazy:** Spróbuj połączyć się z bazą danych. Użyj zapytania przygotowanego (prepare/execute), aby pobrać z tabeli `page_list` rekord, gdzie alias = `idp` ORAZ status = 1
5. **Obsługa braku rekordu:** Jeśli baza nie zwróciła żadnego wyniku (strona nie istnieje lub jest szkicem), ustaw kod HTTP 404 i wyświetl komunikat błędu
6. Jeśli rekord istnieje, pobierz z bazy tytuł strony i jej treść (HTML)
7. Pobierz z bazy dane do wygenerowania menu (wszystkie opublikowane strony)
8. Wygeneruj szablon HTML, wstawiając pobrany tytuł do zakładki `<title>`, linki do menu oraz treść strony do sekcji `<main>`
9. **Obsługa awarii bazy:** Cały proces (od kroku 4) umieść w bloku `try...catch`. Jeśli wystąpi błąd połączenia lub błąd zapytania SQL (np. baza jest wyłączona), zapisz szczegóły w lokalnym logu, ustaw kod HTTP 500 (Błąd serwera) i wyświetl użytkownikowi ogólny, bezpieczny komunikat zamiast treści strony

## Próby

### Odczyt i aktualizacja treści
 - **kroki**: wpisanie `index.php` i `?idp=` w adres, wejście na phpmyadmin i wpisanie `<h2>TEST</h2>` w miejsce `<h2>Sekcja demonstracyjna</h2>`
 - **wynik oczekiwany**: `index.php` i `?idp=` otwierają `glowna` z HTTP 200. Zmień treść w
phpMyAdmin: po odświeżeniu widać zmianę bez edycji plików PHP i HTML.
 - **wynik rzeczywisty**: `index.php` i `?idp=` otwierają `glowna` z HTTP 200, na stronie widnieje napis **TEST** zamiast **Sekcja demonstracyjna**

### Nowa strona i menu 
- **kroki**: dodanie nowego, opublikowanego rekordu w bazie, odświeżenie strony
 - **wynik oczekiwany**: Dodaj opublikowany rekord z nowym aliasem. Link pojawia się w menu i
otwiera stronę bez zmiany kodu PHP. Aktywny link jest oznaczony.
 - **wynik rzeczywisty**: nowa podstrona i link w menu generują się automatycznie z bazy

### Szkic i publikacja 
 - **kroki**: wejście na `?idp=o-nas`, zmiana statusu `o-nas` na 1, ponowne wejście na `?idp=o-nas`
 - **wynik oczekiwany**: Rekord ze statusem 0 znika z menu, a jego bezpośredni adres zwraca 404.
Po zmianie statusu na 1 jest widoczny. Próba dodania identycznego aliasu jest odrzucana przez bazę.
 - **wynik rzeczywisty**: po wejściu na `?idp=o-nas` wyświetla się błąd 404, po zmianie statusu na `1` podstrona `O nas` wyświetla się poprawnie

### Błędne dane w adresie
 - **kroki**: Testy adresów `?idp=nieznana`, `?idp[]=filmy`, `?idp=../cfg.php`, `?idp=' OR 1=1--`
 - **wynik oczekiwany**: `?idp=nieznana` i `?idp[]=filmy` dają 404. Jako idp sprawdź też
`../cfg.php` oraz tekst ' OR 1=1--. Każda próba daje 404 bez ostrzeżeń PHP.
 - **wynik rzeczywisty**: walidacja `preg_match` i sprawdzanie w bazie poprawnie blokują wszystkie nieprawidłowe żądania (błąd 404)

 ### Awaria bazy
  - **kroki**: tymczasowa zmiana portu w `cfg.php` na błędny, odświeżenie strony
 - **wynik oczekiwany**: Ustaw tymczasowo błędny port w konfiguracji. Strona zwraca 500 bez
szczegółów technicznych, a lokalny log pozwala ustalić przyczynę.
 - **wynik rzeczywisty**: wyświetla się ogólny komunikat HTTP 500

### Funkcje po migracji
 - **kroki**: test strony głównej (zegar, animacje, AJAX), filmów, test katalogu PHP, filtrów i sesji
 - **wynik oczekiwany**: Działają style, obrazy, animacje, AJAX i trzy filmy. Katalog filtruje produkty i zapisuje wybór: POST 303, potem GET 200. Wybór pozostaje po przejściu
między podstronami.
 - **wynik rzeczywisty**: wszystko działa poprawnie

### Odtworzenie środowiska
 - **kroki**: import plików `.sql` do nowej bazy, konfiguracja `cfg.php`
 - **wynik oczekiwany**: Utwórz pustą bazę testową. Zaimportuj schemat i dane, uzupełnij lokalną
konfigurację. Projekt uruchamia się zgodnie z README, także z polskimi
znakami.
 - **wynik rzeczywisty**: wszystko działa poprawnie

