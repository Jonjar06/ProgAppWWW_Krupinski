function initTheme() {
    const btn = document.getElementById('theme-toggle');

    if (!btn) return;

    let zapisanyMotyw = localStorage.getItem('theme');

    if (zapisanyMotyw !== 'dark' && zapisanyMotyw !== 'light') {
        zapisanyMotyw = 'light';
    }

    document.documentElement.setAttribute('data-theme', zapisanyMotyw);

    btn.setAttribute('aria-pressed', zapisanyMotyw === 'dark' ? 'true' : 'false');

    btn.addEventListener('click', () => {
        let obecnyMotyw = document.documentElement.getAttribute('data-theme');

        let nowyMotyw = obecnyMotyw === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', nowyMotyw);

        localStorage.setItem('theme', nowyMotyw);

        btn.setAttribute('aria-pressed', nowyMotyw === 'dark' ? 'true' : 'false');
    });
}

let interwalId = null;

function aktualizujZegar() {
    const teraz = new Date();

    const opcjeDaty = { dateStyle: 'full' };
    const formatDaty = new Intl.DateTimeFormat('pl-PL', opcjeDaty);
    const sformatowanaData = formatDaty.format(teraz);

    const opcjeCzasu = { timeStyle: 'medium', hour12: false };
    const formatCzasu = new Intl.DateTimeFormat('pl-PL', opcjeCzasu);
    const sformatowanyCzas = formatCzasu.format(teraz);

    document.getElementById('data-zegar').textContent = sformatowanaData;
    document.getElementById('czas-zegar').textContent = sformatowanyCzas;
}

function initClock() {
    const btnStart = document.getElementById('btn-start');
    const btnStop = document.getElementById('btn-stop');

    if (!btnStart || !btnStop) return;

    aktualizujZegar();
    interwalId = setInterval(aktualizujZegar, 1000);
    btnStart.addEventListener('click', () => {
        if (interwalId === null) {
            interwalId = setInterval(aktualizujZegar, 1000);
        }
    });

    btnStop.addEventListener('click', () => {
        if (interwalId !== null) {
            clearInterval(interwalId);
            interwalId = null;
        }
    });
}
function initSearch() {
    const input = document.getElementById('szukaj');
    const licznik = document.getElementById('licznik');
    const karty = document.querySelectorAll('.karta');

    if (!input || !licznik) return;

    input.addEventListener('input', (e) => {
        const fraza = e.target.value.trim().toLowerCase();
        let znalezione = 0;

        karty.forEach(karta => {
            const tytul = karta.querySelector('h2').textContent.toLowerCase();

            if (tytul.includes(fraza)) {
                karta.hidden = false;
                znalezione++;
            } else {
                karta.hidden = true;
            }
        });

        if (znalezione === 0) {
            licznik.textContent = "Brak wyników dla podanej frazy.";
        } else {
            licznik.textContent = `Znaleziono: ${znalezione}`;
        }
    });
}
const produktyBaza = [
    { id: 'talerz-10kg', nazwa: 'Stalowy talerz do sztangi 10kg', cenaGrosze: 20000 },
    { id: 'talerz-15kg', nazwa: 'Stalowy talerz do sztangi 15kg', cenaGrosze: 30000 },
    { id: 'talerz-20kg', nazwa: 'Stalowy talerz do sztangi 20kg', cenaGrosze: 40000 }
];

function obliczWartosc(cenaGrosze, ilosc) {
    return cenaGrosze * ilosc;
}
function initForm() {
    const form = document.querySelector('form');
    if (!form) return;

    const sel = document.getElementById('produkt');
    const ile = document.getElementById('ilosc');
    const txt = document.getElementById('wiadomosc');
    const err = document.getElementById('blad-wiadomosc');
    const pod = document.getElementById('podsumowanie');

    const clear = () => { pod.textContent = ''; err.textContent = ''; };
    sel.addEventListener('change', clear);
    ile.addEventListener('input', clear);
    txt.addEventListener('input', clear);

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        clear();

        const i = Number(ile.value);
        if (ile.value === '' || !Number.isInteger(i) || i < 1 || i > 5) {
            pod.textContent = "Błąd ilości (1-5).";
            return;
        }
        const w = txt.value.trim();
        if (w.length < 10) {
            err.textContent = "Wiadomość min. 10 znaków.";
            txt.focus();
            return;
        }

        const p = produktyBaza.find(x => x.id === sel.value);
        if (!p) { pod.textContent = "Wybierz produkt."; return; }
        const suma = obliczWartosc(p.cenaGrosze, i) / 100;
        const format = new Intl.NumberFormat('pl-PL', { style: 'currency', currency: 'PLN' });
        pod.textContent = `Produkt: ${p.nazwa}\nIlość: ${i}\nWartość: ${format.format(suma)}\nWiadomość: ${w}`;
    });
}
document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initClock();
    initSearch();
    initForm();
});