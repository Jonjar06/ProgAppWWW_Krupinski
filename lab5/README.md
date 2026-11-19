## Instrukcja uruchomienia
Należy zainstalować XAMPP, przenieść katalog `lab5` do `htdocs` w katalogu instalacji XAMPP, uruchomić Apache i wejść na `http://localhost/lab5/`.

## Pseudokod wyboru widoku

1. Odczytaj parametr `idp` z `$_GET` (domyślnie 'glowna')
2. Sprawdź czy parametr nie jest tablicą (`is_array`) i czy istnieje w mapie `$podstrony`
3. JEŚLI NIE istnieje -> ustaw kod HTTP 404 i wyświetl komunikat błędu
4. JEŚLI istnieje -> zbuduj ścieżkę przy użyciu `__DIR__`
5. Sprawdź `is_file()` i `is_readable()`. JEŚLI plik nie istnieje -> ustaw HTTP 500 i wyświetl komunikat
6. JEŚLI plik jest poprawny -> ustaw tytuł z mapy, wywołaj `http_response_code(200)` i dołącz plik przez `include` w tagu `<main>`

## Próby

### Adres domyślny i menu
 - **kroki**: wejście na `index.php` oraz `index.php?idp=`, kliknięcie w linki menu
 - **wynik oczekiwany**: `index.php` i `index.php?idp=` pokazują stronę główną. Odnośniki
otwierają właściwe treści ze wspólnym szablonem i poprawnym tytułem.
 - **wynik rzeczywisty**: wszystko działa poprawnie

### Nieznany lub tablicowy klucz
- **kroki**: dopisanie `?idp=nieznana` oraz `?idp[]=filmy` do linku
 - **wynik oczekiwany**: `?idp=nieznana` i `?idp[]=filmy` dają HTTP 404 i odnośnik
powrotny, bez ostrzeżeń PHP.
 - **wynik rzeczywisty**: w Network widać kod 404, a na stronie komunikat o błędzie

### Próba podania ścieżki 
 - **kroki**: dopisanie `?idp=..%2Fstatus.php` do linku
 - **wynik oczekiwany**: `?idp=..%2Fstatus.php` daje HTTP 404. Zawartość status.php
nie zostaje dołączona.
 - **wynik rzeczywisty**: kod 404, plik nie został dołączony

### Brak pliku widoku
 - **kroki**: zmiana nazwy `html/filmy.html` na `html/filmy2.html`, wejście na `?idp=filmy`
 - **wynik oczekiwany**: Zmień tymczasowo nazwę `html/filmy.html`. Adres `?idp=filmy`
zwraca HTTP 500 bez ujawnienia ścieżki systemowej.
 - **wynik rzeczywisty**: Kod 500 i odpowiedni komunikat

 ### Strona główna i AJAX
  - **kroki**: kliknięcie przycisku "Sprawdź serwer"
 - **wynik oczekiwany**: Na stronie głównej działają style, grafiki i animacje. W panelu Sieć
widać udane żądanie do status.php, a na stronie jego wynik.
 - **wynik rzeczywisty**: wszystko działa poprawnie

### Katalog i sesja po migracji
 - **kroki**: wybór produktu w katalogu PHP, zapis, powrót na stronę główną, wejście na Filmy i powrót do katalogu
 - **wynik oczekiwany**: Otwórz katalog z menu i użyj filtra. Zapisz poprawny wybór: POST 303,
potem GET 200. Wróć na stronę główną, otwórz Filmy i ponownie wejdź
do katalogu. Zapisany wybór nadal jest widoczny.
 - **wynik rzeczywisty**: sesja działa poprawnie, wybór nie znika

### Filmy i układ mobilny 
 - **kroki**: uruchomienie filmów, sprawdzenie linków, włączenie trybu responsywnego (360 px)
 - **wynik oczekiwany**: Trzy filmy można uruchomić, odnośniki działają, a przy szerokości 360
px strona nie przewija się w poziomie.
 - **wynik rzeczywisty**: wszystko działa, filmy ładnie dopasowują się do szerokości ekranu

