## Instrukcja uruchomienia

Aby uruchomić stronę należy pobrać folder lab2, rozpakować go i otworzyć plik index.html. Można też uruchomić serwer poleceniem `py -m http.server 8000`, a następnie wejść w przeglądarce na `http://localhost:8000/`.

### 1\. Zmiana motywu

* **Zdarzenie:** Kliknięcie przycisku (event `click`)
* **Dane:** Odczyt aktualnego motywu z tagu `<html>` oraz `localStorage`
* **Obliczenie:** Ustalenie nowego motywu (dark/light) i zapisanie go do `localStorage`
* **Zmiana DOM:** Zmiana atrybutu `data-theme` na tagu `<html>` i aktualizacja `aria-pressed` na przycisku

### 2\. Wyszukiwarka produktów

* **Zdarzenie:** Wpisywanie tekstu w pole (event `input`)
* **Dane:** Tekst pobrany z pola (oczyszczony przez `trim()` i `toLowerCase()`)
* **Obliczenie:** Pętla po kartach i sprawdzenie, czy tytuł zawiera szukaną frazę (`includes()`)
* **Zmiana DOM:** Ukrycie/pokazanie kart (atrybut `hidden`) i zmiana tekstu w liczniku wyników

### 3\. Formularz kontaktowy

* **Zdarzenie:** Wysłanie formularza (event `submit` + `preventDefault()`)
* **Dane:** Wybrany produkt, ilość sztuk i treść wiadomości.
* **Obliczenie:** Walidacja (ilość 1-5, wiadomość min. 10 znaków), wyliczenie ceny funkcją `obliczWartosc()` i formatowanie waluty
* **Zmiana DOM:** Wypisanie błędu (z przeniesieniem fokusu przez `focus()`) lub podsumowania przez bezpieczny `textContent`

### 4\. Zegar

* **Zdarzenie:** Uruchomienie `setInterval` co 1000 ms przyciskiem "Start" lub przy starcie strony
* **Dane:** Pobranie aktualnego czasu przez `new Date()`
* **Obliczenie:** Formatowanie daty i godziny za pomocą `Intl.DateTimeFormat`
* **Zmiana DOM:** Podmiana tekstu (`textContent`) w elementach zegara na ekranie

