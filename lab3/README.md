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