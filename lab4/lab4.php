<?php
session_start();
require_once __DIR__ . '/includes/produkty.php';

$tytul = 'Katalog PHP';
$idGrupy = 'GRUPA-1';
$blad = '';
$komunikat = '';
$filtr = 'wszystkie';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['produkt'] ?? null, FILTER_VALIDATE_INT);
    $ilosc = filter_var($_POST['ilosc'] ?? null, FILTER_VALIDATE_INT);

    $produkt = null;
    foreach ($produkty as $p) {
        if ($p['id'] === $id) { $produkt = $p; break; }
    }

    if ($id === false || $ilosc === false || $produkt === null || $ilosc < 1 || $ilosc > 5 || $ilosc > $produkt['stan']) {
        $blad = "Błędne dane wejściowe lub przekroczony stan magazynowy.";
        http_response_code(400);
    } else {
        $_SESSION['ostatni_wybor'] = ['id' => $id, 'ilosc' => $ilosc];
        header('Location: lab4.php', true, 303);
        exit;
    }
}
if (isset($_GET['kategoria'])) {
    $kat = $_GET['kategoria'];
    if (is_array($kat)) {
        $komunikat = "Nieprawidłowy format filtra.";
    } elseif (in_array($kat, ['ksiazki', 'akcesoria'], true)) {
        $filtr = $kat;
    } elseif ($kat !== 'wszystkie' && $kat !== '') {
        $komunikat = "Nieznana kategoria. Pokazano wszystkie.";
    }
}
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

    <p>
        Ostatni wybór:
        <?php
        if (isset($_SESSION['ostatni_wybor'])) {
            $idSesji = $_SESSION['ostatni_wybor']['id'];
            $iloscSesji = $_SESSION['ostatni_wybor']['ilosc'];
            $nazwaSesji = "Nieznany";
            foreach ($produkty as $p) { if ($p['id'] === $idSesji) { $nazwaSesji = $p['nazwa']; break; } }
            echo htmlspecialchars($nazwaSesji, ENT_QUOTES, 'UTF-8') . " (" . $iloscSesji . " szt.)";
        } else {
            echo "Brak zapisanego wyboru.";
        }
        ?>
    </p>
    <form method="get" action="lab4.php">
        <label for="kategoria">Filtruj:</label>
        <select name="kategoria" id="kategoria">
            <option value="wszystkie" <?php if($filtr == 'wszystkie') echo 'selected'; ?>>Wszystkie</option>
            <option value="ksiazki" <?php if($filtr == 'ksiazki') echo 'selected'; ?>>Książki</option>
            <option value="akcesoria" <?php if($filtr == 'akcesoria') echo 'selected'; ?>>Akcesoria</option>
        </select>
        <button type="submit">Filtruj</button>
    </form>
    <p><?php echo htmlspecialchars($komunikat); ?></p>
    <div class="produkty">
        <?php
        $i = 0;
        while ($i < count($produkty)) {
            $p = $produkty[$i];
        if ($filtr === 'wszystkie' || $p['kategoria'] === $filtr) {
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
                <h3><?php echo htmlspecialchars($p['nazwa'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p>Kategoria: <?php echo $kategoriaTekst; ?></p>
                <p>Stan: <?php echo $p['stan']; ?> (<?php echo $status; ?>)</p>
            </article>
            <?php
        }
            $i++;
        }
        ?>
    </div>

    <p><?php echo htmlspecialchars($blad); ?></p>
    <form method="post" action="lab4.php">
        <div>
            <label for="produkt">Produkt:</label>
            <select name="produkt" id="produkt" required>
                <?php
                $j = 0;
                while ($j < count($produkty)) {
                    echo "<option value='{$produkty[$j]['id']}'>{$produkty[$j]['nazwa']}</option>";
                    $j++;
                }
                ?>
            </select>
        </div>

        <div>
            <label for="ilosc">Ilość:</label>
            <select id="ilosc" name="ilosc" required>
                <?php
                for ($ile = 1; $ile <= 5; $ile++) {
                    echo '<option value="' . $ile . '">' . $ile . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit">Zapisz</button>
    </form>
</main>

<footer>
    Sklep z ciężarami 2026
</footer>
</body>
</html>