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