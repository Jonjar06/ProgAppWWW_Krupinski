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