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
    <div class="produkty">
        <?php
        $i = 0;
        while ($i < count($produkty)) {
            $p = $produkty[$i];

            if ($p['stan'] === 0) {
                $status = 'Niedostępny';
            } elseif ($p['stan'] <= 5) {
                $status = 'Niski stan';
            } else {
                $status = 'Dostępny';
            }

            switch ($p['kategoria']) {
                case 'ksiazki':
                    $kategoriaTekst = 'Książki';
                    break;
                case 'akcesoria':
                    $kategoriaTekst = 'Akcesoria';
                    break;
                default:
                    $kategoriaTekst = 'Inna';
            }
            ?>
            <article class="karta">
                <h3><?php echo $p['nazwa']; ?></h3>
                <p>Kategoria: <?php echo $kategoriaTekst; ?></p>
                <p>Stan: <?php echo $p['stan']; ?> (<?php echo $status; ?>)</p>
            </article>
            <?php
            $i++;
        }
        ?>
    </div>

    <form>
        <label for="ilosc">Ilość:</label>
        <select id="ilosc" name="ilosc">
            <?php
            for ($ile = 1; $ile <= 5; $ile++) {
                echo '<option value="' . $ile . '">' . $ile . '</option>';
            }
            ?>
        </select>
    </form>
</main>

<footer>
    Sklep z ciężarami 2026
</footer>
</body>
</html>