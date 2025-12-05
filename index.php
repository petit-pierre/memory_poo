<html lang='fr'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Jeu de Mémoire</title>
    <link rel='stylesheet' href='./style.css'>
</head>

<body>
    <div class='game-board'>
        <?php
        require_once 'Card.php';
        $deck = [];
        $pairs = 8;
        for ($i = 1; $i <= $pairs; $i++) {
            $imagePath = "./assets/card" . $i . ".png";
            $deck[] = new Card($i * 2 - 1, $imagePath);
            $deck[] = new Card($i * 2, $imagePath);
        }
        shuffle($deck);
        session_start();
        foreach ($deck as $card) {
            echo "<div class='card'>
            <img src='" . $card->getImage() . "' alt='Card Image'>
            </div>";
        }


        ?>
    </div>
</body>