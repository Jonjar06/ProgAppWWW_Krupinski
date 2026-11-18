<?php
$idProjektu = "sklep-z-ciezarami";

$podstrony = [
        'glowna'  => ['tytul' => 'Katalog produktów', 'plik' => 'html/glowna.html'],
        'produkt' => ['tytul' => 'Produkt',           'plik' => 'html/produkt.html'],
        'kontakt' => ['tytul' => 'Kontakt',           'plik' => 'html/kontakt.html'],
        'filmy'   => ['tytul' => 'Filmy',             'plik' => 'html/filmy.html']
];

$idp = $_GET['idp'] ?? 'glowna';
$widok = $podstrony[$idp] ?? $podstrony['glowna'];

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $widok['tytul']; ?></title>
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
                <a href="index.php?idp=<?php echo $klucz; ?>">
                    <?php echo $strona['tytul']; ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li><a href="lab4.php">Katalog PHP</a></li>
    </ul>

</nav>

<main>

    <?php include __DIR__ . '/' . $widok['plik']; ?>
</main>

<footer>
    Sklep z ciężarami 2026 | ID projektu: <?php echo $idProjektu; ?>
</footer>
</body>
</html>