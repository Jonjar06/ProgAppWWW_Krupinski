<?php
require_once __DIR__ . '/cfg.php';
require_once __DIR__ . '/showpage.php';

$idProjektu = "sklep-z-ciezarami";

$idp = $_GET['idp'] ?? 'glowna';
if ($idp === '') {
    $idp = 'glowna';
}

$blad = false;
$kodHttp = 200;
$widok = null;

if (is_array($idp) || !preg_match('/^[a-z0-9-]{1,20}$/', $idp)) {
    $kodHttp = 404;
    $blad = "404 Not Found, nieprawidłowy format adresu.";
} else {
    $widok = PokazPodstrone($pdo, $idp);

    if ($widok === null) {
        $kodHttp = 404;
        $blad = "404 Not Found, nie znaleziono podstrony.";
    }
}

http_response_code($kodHttp);

$tytul = $blad ? "Błąd" : $widok['page_title'];

$stmtMenu = $pdo->query("SELECT alias, page_title FROM page_list WHERE status = 1 ORDER BY id");
$menu = $stmtMenu->fetchAll(PDO::FETCH_ASSOC);
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
        <?php foreach ($menu as $link): ?>
            <li>
                <a href="index.php?idp=<?php echo htmlspecialchars($link['alias'], ENT_QUOTES, 'UTF-8'); ?>"
                        <?php if (!$blad && $idp === $link['alias']) echo 'aria-current="page"'; ?>>
                    <?php echo htmlspecialchars($link['page_title'], ENT_QUOTES, 'UTF-8'); ?>
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
        <?php
        echo $widok['page_content'];
        ?>
    <?php endif; ?>
</main>

<footer>
    Sklep z ciężarami 2026 | ID projektu: <?php echo $idProjektu; ?> | Wersja: v1.5
</footer>
</body>
</html>