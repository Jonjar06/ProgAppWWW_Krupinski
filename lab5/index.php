<?php
$idProjektu = "sklep-z-ciezarami";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep z ciężarami</title>
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
        <li><a href="index.php" aria-current="page">Katalog produktów</a></li>
        <li><a href="lab4.php">Katalog PHP</a></li>
        <li><a href="index.php?idp=produkt">Produkt</a></li>
        <li><a href="index.php?idp=kontakt">Kontakt</a></li>
    </ul>

</nav>

<main class="produkty">

    <?php include __DIR__ . '/html/glowna.html'; ?>
</main>

<footer>
    Sklep z ciężarami 2026 | ID projektu: <?php echo $idProjektu; ?>
</footer>
</body>
</html>