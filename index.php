<html lang='fr'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Jeu de Mémoire</title>
    <link rel='stylesheet' href='./style.css'>
</head>

<body>
    <form method="post" class='game-board'>
        <?php
        require_once 'Card.php';
        session_start();
        if (!isset($_SESSION['deck'])) {
            $deck = [];
            $pairs = 8;
            for ($i = 1; $i <= $pairs; $i++) {
                $imagePath = "./assets/card" . $i . ".png";
                $deck[] = new Card($i * 2 - 1, $imagePath);
                $deck[] = new Card($i * 2, $imagePath);
            }
            shuffle($deck);
            $_SESSION['deck'] = $deck;
        };


        $deck = ($_SESSION['deck']);

        if (isset($_POST['cardId'])) {
            for ($i = 0; $i < count($deck); $i++) {
                if ($deck[$i]->getId() == $_POST['cardId']) {
                    $deck[$i]->flipped = true;
                    $_SESSION['deck'] = $deck;
                    $flippedCard = $deck[$i]->getImage();
                    for ($j = 0; $j < count($deck); $j++) {
                        if ($deck[$j]->getImage() === $flippedCard) {
                            $deck[$j]->matched = true;
                            $_SESSION['deck'] = $deck;
                        }
                    }
                }
            }
        }



        foreach ($deck as $card) {
            if ($card->flipped || $card->matched) {
                echo "<button type='submit' class='card'>
                <img src='" . $card->getImage() . "' alt='Card Image'>
                </button>";
            } else {
                echo "<button type='submit' class='card' name='cardId' value='" . $card->getId() . "'>
                <img src='./assets/backside.png' alt='Card Back'>
                </button>";
            }
        }


        ?>
    </form>
</body>