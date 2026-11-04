## Instrukcja uruchomienia
Aby uruchomić stronę należy pobrać folder `lab3`, rozpakować go i otworzyć plik `index.html`. Można też uruchomić serwer poleceniem `py -m http.server 8000`, a następnie wejść w przeglądarce na `http://localhost:8000/`. Można również uruchomić Apache, po rozpakowaniu przenieść katalog `lab3` do `htdocs` w katalogu instalacji XAMPP i otworzyć `http://localhost/lab3/`.
## Wersja jQuery
jQuery 4.0.0
## Pseudokody animacji 

### Animacja A 
1. Ustaw zmienną logiczną `powiekszonyA = false`
2. Po kliknięciu przycisku `#btn-a`:
   - Zatrzymaj trwającą animację i wyczyść kolejkę wywołując `.stop(true, false)`
   - JEŚLI `powiekszonyA` jest prawdą (`true`):
     - Animuj wymiary przycisku do rozmiaru bazowego `160x90 px` w czasie `300 ms`
     - Ustaw `powiekszonyA = false` oraz atrybut `aria-pressed="false"`
   - W PRZECIWNYM RAZIE (`false`):
     - Animuj wymiary przycisku do `240x130 px` w czasie `300 ms`
     - Ustaw `powiekszonyA = true` oraz atrybut `aria-pressed="true"`

### Animacja B 
1. Ustaw zmienne logiczne `myszNaB = false` oraz `fokusNaB = false`
2. Zdefiniuj funkcję `aktualizujB()`:
   - Zatrzymaj bieżącą animację `#btn-b` i wyczyść kolejkę przez `.stop(true, false)`
   - JEŚLI `myszNaB` LUB `fokusNaB` jest prawdą (`true`):
     - Animuj wymiary przycisku do `220x120 px` w czasie `300 ms`
   - W PRZECIWNYM RAZIE (oba stany to `false`):
     - Animuj wymiary przycisku do rozmiaru bazowego `160x90 px` w czasie `300 ms`
3. Obsłuż zdarzenia na przycisku `#btn-b`:
   - `mouseenter`: ustaw `myszNaB = true`, wywołaj `aktualizujB()`
   - `mouseleave`: ustaw `myszNaB = false`, wywołaj `aktualizujB()`
   - `focus`: sprawdź widoczność fokusu (`.is(":focus-visible")`), przypisz do `fokusNaB` i wywołaj `aktualizujB()`
   - `blur`: ustaw `fokusNaB = false`, wywołaj `aktualizujB()`

### Animacja C
1. Ustaw licznik kroków `krokiC = 0`
2. Po kliknięciu przycisku `#btn-c`:
   - JEŚLI przycisk jest w trakcie animacji (`.is(":animated")`) LUB `krokiC >= 5`:
     - Zakończ działanie funkcji (zignoruj kliknięcie)
   - Zwiększ `krokiC` o `1`
   - Oblicz nową szerokość ze wzoru `160 + (krokiC * 20)` oraz wysokość ze wzoru `90 + (krokiC * 10)`
   - Animuj wymiary przycisku do wyliczonych wartości w czasie `300 ms`
   - Wyświetl aktualną wartość `krokiC` w elemencie `#kroki-c` (`role="status"`)

## Testy

**Szybkie kliknięcia A** 
 - **kroki**: kliknięcie przycisku `Resetuj A i C`; kliknięcie przycisku `Animacja A` 10 razy
 - **wynik oczekiwany**: Po resecie i 10 kliknięciach stan bazowy; po zakończeniu klikania animacje nie
odtwarzają zaległej kolejki.
 - **wynik rzeczywisty**: animacja nie odtwarza zaległej kolejki, animacja działa poprawnie w trakcie klikania

**Kursor i fokus B**
- **kroki**: naciskanie `Tab` aż przycisk `Animacja B` złapie fokus; najechanie kursorem na `Animacja B`; utrata fokusu
 - **wynik oczekiwany**: Wyjście kursora przy zachowanym fokusie nie zmniejsza obiektu. Utrata obu
stanów przywraca rozmiar bazowy.
 - **wynik rzeczywisty**: wyjście kursora z przycisku nie zmniejsza go, utrata fokusu bez najechanego kursora przywraca rozmiar bazowy

**Limit i reset C**
 - **kroki**: kliknięcie przycisku `Anmiacja C` 5 razy; nacisnięcie przycisku `Resetuj A i C`
 - **wynik oczekiwany**: Pięć kroków daje 260 × 140 px. Dalsze kliknięcia nie powiększają obiektu;
reset podczas animacji zeruje stan.
 - **wynik rzeczywisty**: przycisk po 5 kliknięciach ma rozmiar `260 x 140 px`, kolejne kliknięcia nie zmieniają jego rozmiaru, naciśnięcie `Resetuj A i C` przywraca stan przycisku sprzed kliknięć

**Klawiatura i ruch**
 - **kroki**: naciskanie `Tab` do dotarcia do przycisków; naciśnięcie `Enter` lub `Spacja` mając fokus na przyciskach; wyłączenie animacji w ustawieniach Windows
 - **wynik oczekiwany**: Tab dociera do przycisków; Enter i Spacja obsługują A, C i reset. Ograniczenie
ruchu wyłącza przejścia, zachowując funkcje.
 - **wynik rzeczywisty**: `Tab` doprowadza fokus do przycisków, `Enter` i `Spacja` obsługują przyciski, wyłączenie animacji w ustawieniach Windows wyłącza płynne przejścia, ale zachowuje prawidłowe funkcje

**Tryb ciemny, zegar, formularz**

Przycisk `Tryb ciemny` działa poprawnie wyświetlając czarny motyw strony po naciśnięciu oraz zapamiętując obecny tryb po odświeżeniu strony. **Zegar** poprawnie wyświetla aktualną godzinę wraz z minutami i sekundami, po naciśnięciu `Stop zegara` zatrzymuje się, a po naciśnięciu `Start zegara` pokazuje aktualny czas. **Formularz** działa zgodnie z założeniami.

### Testy AJAX

 **Metoda GET, kod 200 i odpowiedź**
  - **kroki**: otwarcie DevTools, zakładka Network, kliknięcie przycisku `Sprawdź serwer`
 - **wynik oczekiwany**: żądanie do `status.php` ma metodę GET, status 200 i zwraca tekst "PHP działa"
 - **wynik rzeczywisty**: w zakładce Network widoczna jest metoda `GET`, kod statusu `200 OK`, a w zakładce Response widnieje napis "PHP działa"

**Symulacja błędu 404**
 - **kroki**: tymczasowa zmiana nazwy pliku `status.php`, kliknięcie przycisku `Sprawdź serwer`, przywrócenie poprawnej nazwy pliku i ponowna próba
 - **wynik oczekiwany**: wystąpienie błędu 404, wyświetlenie komunikatu o błędzie na stronie, po przywróceniu pliku żądanie kończy się sukcesem
 - **wynik rzeczywisty**: przy zmienionej nazwie pliku w Network pojawił się błąd `404 Not Found`, a na stronie komunikat o błędzie, po przywróceniu nazwy `status.php` żądanie ponownie zwróciło kod 200 i tekst "PHP działa"

**Ładowanie przy ograniczonej prędkości sieci**
 - **kroki**: ustawienie w DevTools (zakładka Network) profilu prędkości na `Slow 3G`, kliknięcie przycisku `Sprawdź serwer`
 - **wynik oczekiwany**: ze względu na wolniejsze łącze, stan ładowania (komunikat "Ładowanie..." i zablokowany przycisk) utrzymuje się dłużej przed wyświetleniem odpowiedzi
 - **wynik rzeczywisty**: po włączeniu opcji Slow 3G napis "Ładowanie..." był widoczny na ekranie przez kilka sekund, po czym pojawił się właściwy wynik

