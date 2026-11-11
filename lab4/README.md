## Instrukcja uruchomienia
Należy zainstalować XAMPP, przenieść katalog `lab4` do `htdocs` w katalogu instalacji XAMPP, uruchomić Apache i wejść na `http://localhost/lab4/`.
## Wersja jQuery
jQuery 4.0.0
## Pseudokody

### Poprawne żądanie
1. Sprawdź czy żądanie jest metodą POST
2. Pobierz z `$_POST` identyfikator produktu i ilość
3. Zwaliduj obie wartości za pomocą `FILTER_VALIDATE_INT`
4. Odnajdź produkt w tablicy na podstawie ID
5. Sprawdź czy ilość mieści się w przedziale 1-5 i nie przekracza stanu magazynowego
6. Jeśli dane są poprawne zapisz ID i ilość w `$_SESSION['ostatni_wybor']`
7. Wykonaj przekierowanie HTTP 303 na `lab4.php` i zakończ skrypt (`exit`)

### Błędne żądanie
1. Pobierz dane z `$_POST` 
2. Walidacja za pomocą `filter_var` zwraca `false` 
3. Sprawdź dodatkowe warunki (ilość poza zakresem 1-5, produkt nie istnieje, ilość > stan)
4. Ustaw kod odpowiedzi HTTP 400 (`http_response_code(400)`)
5. Przypisz komunikat błędu do zmiennej i wyświetl go przy formularzu
6. **Nie modyfikuj** danych w `$_SESSION` 

## Próby

### Filtr GET
 - **kroki**: dopisanie do linku `?kategoria=ksiazki`, następnie `?kategoria=nieznanakategoria`, następnie `?kategoria[]=ksiazki`
 - **wynik oczekiwany**: `?kategoria=ksiazki` pokazuje tylko książki. Nieznana kategoria lub
`?kategoria[]=ksiazki` pokazuje pełną listę i komunikat.
 - **wynik rzeczywisty**: `?kategoria=ksiazki` pokazuje karty książek, nieznana kategoria wyświetla napis "Nieznana kategoria. Pokazano wszystkie." i pokazuje wszystkie produkty, `?kategoria[]=ksiazki` wyświetla napis "Nieprawidłowy format filtra." i pokazuje wszystkie produkty

### Poprawny POST i odświeżenie
- **kroki**: kliknięcie `F12` będąc na stronie katalogu PHP, przejście do zakładki `Network`, zaznaczenie boxa `Keep log`, wybranie produktu "Magnezja w płynie" i wybranie 2 sztuk, odświeżenie strony
 - **wynik oczekiwany**: Wybierz dostępny produkt i poprawną ilość. W Network widać POST
303, potem GET 200. Po odświeżeniu i zmianie filtra zapisany wybór pozostaje widoczny.
 - **wynik rzeczywisty**: w Network widać POST 303 i GET 200, po odświeżeniu strony i zmianie filtra wybór pozostaje widoczny

### Błędne wartości POST
 - **kroki**: kliknięcie `F12` będąc na stronie katalogu PHP, edycja kodu HTML formularza przed wysłaniem: zmiana wartości opcji w `<select name="ilosc">` na `0`, `6`, `2.5` oraz `2abc`, usunięcie atrybutu `name` z pola, zmiana nazwy na `name="ilosc[]"` oraz zmiana wartości `value` w polu produktu na nieistniejące ID, kliknięcie "Zapisz" po każdej zmianie
 - **wynik oczekiwany**: Sprawdź ilość 0, 6, 2.5, 2abc, brak pola, tablicę i nieznany produkt.
Każda próba daje HTTP 400 i pozostawia poprzedni wybór.
 - **wynik rzeczywisty**: każda z prób została zatrzymana, w zakładce Network żądania POST kończyły się błędem 400, a na stronie pojawiał się odpowiedni komunikat błędu, poprzedni poprawny wybór z sesji pozostawał nienaruszony i widoczny na ekranie

### Stan magazynowy
 - **kroki**: wybranie z listy książki "Podstawy treningu siłowego" (która ma stan 1), ustawienie ilości na 2 i kliknięcie przycisku `Zapisz`
 - **wynik oczekiwany**: Dla produktu ze stanem 1 spróbuj wybrać 2 sztuki. Serwer odrzuca
wybór, mimo że 2 mieści się w przedziale 1–5.
 - **wynik rzeczywisty**: serwer odrzucił żądanie (kod 400), na stronie pojawił się napis "Błędne dane wejściowe lub przekroczony stan magazynowy.", ostatni wybór nie został zmieniony

 ### Odrębna sesja i tekst HTML
  - **kroki**: otworzenie strony w oknie incognito, zmiana nazwy produktu na `<b>Test</b>`, odświeżenie strony w normalnym oknie i przywrócenie pierwotnej nazwy w pliku
 - **wynik oczekiwany**: W nowej sesji, np. w osobnym oknie prywatnym, nie ma wyboru. Nazwa
testowa `<b>Test</b>` wyświetla się jako tekst; przywróć zwykłą nazwę.
 - **wynik rzeczywisty**: w oknie incognito wyświetlił się komunikat "Brak zapisanego wyboru", po zmianie nazwy na `<b>Test</b>` na stronie widoczny był dosłowny tekst `<b>Test</b>`

### Strona po zmianie ścieżek
 - **kroki**: otworzenie strony głównej i wszystkich podstron, kliknięcia w przyciski Animacji, Sprawdź Serwer, oraz Resetuj A i C
 - **wynik oczekiwany**: Otwórz stronę główną i podstrony. Działają style, obrazy, linki i funkcje z lab3, w tym animacje i żądanie do status.php.
 - **wynik rzeczywisty**: wszystkie podstrony animacje i przyciski działają prawidłowo


