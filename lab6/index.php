<?php
require_once __DIR__ . '/cfg.php';
$idProjektu = "sklep-z-ciezarami";

$podstrony = [
        'glowna'  => ['tytul' => 'Katalog produktów', 'plik' => 'html/glowna.html'],
        'produkt' => ['tytul' => 'Produkt',           'plik' => 'html/produkt.html'],
        'kontakt' => ['tytul' => 'Kontakt',           'plik' => 'html/kontakt.html'],
        'filmy'   => ['tytul' => 'Filmy',             'plik' => 'html/filmy.html']
];

$idp = $_GET['idp'] ?? 'glowna';
if ($idp === '') {
    $idp = 'glowna';
}
$blad = false;
$kodHttp = 200;

if (is_array($idp) || !isset($podstrony[$idp])) {
    $kodHttp = 404;
    $blad = "404 Not Found, nie znaleziono podstrony";
} else {
    $tytul = $podstrony[$idp]['tytul'];
    $sciezka = __DIR__ . '/' . $podstrony[$idp]['plik'];

    if (!is_file($sciezka) || !is_readable($sciezka)) {
        $kodHttp = 500;
        $blad = "500 Internal Server Error, błąd po stronie serwera";
    }
}

http_response_code($kodHttp);

if ($blad) {
    $tytul = "Błąd";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tytul, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="vendor/jquery-4.0.0.min.js" defer></script>
    <script src="js/main.js" defer></script>
    <script src="js/lab3.js" defer></script>
</head>
<body>
<header>
    <h1>Sklep z ciężarami</h1>
    <button type="button" id="theme-toggle" aria-pressed="false">Tryb ciemny</button>

</header>

<nav>
    <ul>
        <?php foreach ($podstrony as $klucz => $strona): ?>
            <li>
                <a href="index.php?idp=<?php echo $klucz; ?>"
                        <?php if (!$blad && $idp === $klucz) echo 'aria-current="page"'; ?>>
                    <?php echo htmlspecialchars($strona['tytul'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li><a href="lab4.php">Katalog PHP</a></li>
    </ul>

</nav>

<main>
    <?php if ($blad): ?>
        <div style="padding: 20px; border: 1px solid red; background: #ffe6e6; color: #900;">
            <h2>Błąd</h2>
            <p><?php echo htmlspecialchars($blad, ENT_QUOTES, 'UTF-8'); ?></p>
            <p><a href="index.php">Powrót do strony głównej</a></p>
        </div>
    <?php else: ?>
        <?php include $sciezka; ?>
    <?php endif; ?>
</main>

<footer>
    Sklep z ciężarami 2026 | ID projektu: <?php echo $idProjektu; ?> | Wersja: v1.5
</footer>
</body>
</html>