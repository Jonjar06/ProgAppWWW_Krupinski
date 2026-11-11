<?php
require_once __DIR__ . '/includes/produkty.php';

$tytul = 'Katalog PHP';
$idGrupy = 'GRUPA-1';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tytul; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js" defer></script>
</head>
<body>
<?php include __DIR__ . '/includes/naglowek.php'; ?>

<main>
    <h2><?php echo $tytul; ?></h2>
    <p>Identyfikator grupy: <strong><?php echo $idGrupy; ?></strong></p>
    <p><a href="index.html">Powrót do strony głównej</a></p>
</main>

<footer>
    Sklep z ciężarami 2026
</footer>
</body>
</html>