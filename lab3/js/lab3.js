let powiekszonyA = false;

$('#sekcja-demonstracyjna #btn-a').on('click', function() {
    $(this).stop(true, false);

    if (powiekszonyA) {
        $(this).animate({
            width: '160px',
            height: '90px'
        }, 300);
        powiekszonyA = false;
        $(this).attr('aria-pressed', 'false');
    } else {
        $(this).animate({
            width: '240px',
            height: '130px'
        }, 300);
        powiekszonyA = true;
        $(this).attr('aria-pressed', 'true');
    }
});

let myszNaB = false;
let fokusNaB = false;

function aktualizujB() {
    if (myszNaB || fokusNaB) {
        $('#sekcja-demonstracyjna #btn-b').stop(true, false).animate({
            width: '220px',
            height: '120px'
        }, 300);
    } else {
        $('#sekcja-demonstracyjna #btn-b').stop(true, false).animate({
            width: '160px',
            height: '90px'
        }, 300);
    }
}

$('#sekcja-demonstracyjna #btn-b').on({
    mouseenter: function() {
        myszNaB = true;
        aktualizujB();
    },
    mouseleave: function() {
        myszNaB = false;
        aktualizujB();
    },
    focus: function() {
        fokusNaB = $('#sekcja-demonstracyjna #btn-b').is(":focus-visible");
        aktualizujB();
    },
    blur: function() {
        fokusNaB = false;
        aktualizujB();
    }
});
let krokiC = 0;

$('#sekcja-demonstracyjna #btn-c').on('click', function() {
    if ($(this).is(":animated")) {
        return;
    }
    if (krokiC >= 5) {
        return;
    }
    krokiC++;
    const nowaSzerokosc = 160 + (krokiC * 20);
    const nowaWysokosc = 90 + (krokiC * 10);
    $(this).animate({
        width: nowaSzerokosc + 'px',
        height: nowaWysokosc + 'px'
    }, 300);

    $('#sekcja-demonstracyjna #kroki-c').text(krokiC);
});

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
if (prefersReducedMotion.matches) {
    $.fx.off = true;
}

$('#sekcja-demonstracyjna #btn-reset').on('click', function() {
    $('#sekcja-demonstracyjna #btn-a')
        .stop(true, false)
        .css({ width: '160px', height: '90px' })
        .attr('aria-pressed', 'false');
    powiekszonyA = false;

    $('#sekcja-demonstracyjna #btn-c')
        .stop(true, false)
        .css({ width: '160px', height: '90px' });
    krokiC = 0;
    $('#sekcja-demonstracyjna #kroki-c').text('0');
});
$('#sekcja-demonstracyjna #btn-ajax').on('click', function() {
    const $btn = $(this);
    const $wynik = $('#sekcja-demonstracyjna #wynik-ajax');

    $btn.prop('disabled', true);
    $wynik.text('Ładowanie...');
    $.ajax({
        url: 'status.php',
        type: 'GET',
        dataType: 'text',
        timeout: 5000
    })
        .done(function(odpowiedz) {
            $wynik.text(odpowiedz);
        })
        .fail(function() {
            $wynik.text('Wystąpił błąd podczas łączenia z serwerem');
        })
        .always(function() {
            $btn.prop('disabled', false);
        });
});