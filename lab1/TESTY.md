Wersja przeglądarki: Google Chrome Wersja 155.0.8059.85 (Oficjalna wersja) (64-bitowa)



1. **Struktura:**



**oczekiwany wynik:** brak błędów w Nu HTML Checker oraz poprawne działanie strony po wyłączeniu CSS



**zaobserwowany wynik:**



Nu HTML Checker: 

* index.html: komunikat "Document checking completed. No errors or warnings to show."
* kontakt.html: komunikat "Document checking completed. No errors or warnings to show."
* produkt.html: komunikat "Document checking completed. No errors or warnings to show."



Po wyłączeniu CSS sprawdzono kolejność nagłówków oraz treści.



**2. Widoki:**



**oczekiwany wynik:** Brak poziomego przewijania. Katalog układający się w 1 kolumnę poniżej 768px i w 3 kolumny powyżej. Pola formularza nie są ucięte.



**zaobserwowany wynik:** Wszystko działa zgodnie z oczekiwanym wynikiem



**3. Klawiatura**



**oczekiwany wynik:** Kolejność fokusu logiczna. Wyraźna czerwona ramka fokusu. Kliknięcie w etykietę aktywuje pole.



**zaobserwowany wynik:** Wszystko działa zgodnie z oczekiwanym wynikiem



**4. Walidacja:**



**oczekiwany wynik:** Każda błędna próba jest blokowana, a przeglądarka wyświetla stosowny komunikat. Poprawnie wypełniony formularz przeładowuje stronę i generuje 4 parametry w URL.



**zaobserwowany wynik:** Wszystko działa zgodnie z oczekiwanym wynikiem.



**5. Eksperyment:** 



**oczekiwany wynik:** brak zapisu parametru email do URL po usunięciu name



**zaobserwowany wynik:** Po usunięciu name w URL brakowało wpisu email, po przywróceniu parametr wrócił. W DevTools w zakładce Network żądanie ma metodę GET

