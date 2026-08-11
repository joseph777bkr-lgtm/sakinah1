<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Collection SAKINAH</title>

    <link rel="stylesheet" href="style.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet"
    >
</head>

<body>

<header>

    <h1 class="text text1">LA COLLECTION SAKINAH</h1>

    <h1 class="text text2">DES PARFUMS D'EXCEPTION</h1>

    <h1 class="text text3">L'ÉLÉGANCE EN FRAGRANCE</h1>

</header>



<nav>
    <img src="logo.JPEG" alt="Logo">

    <h2>
        <a href="index.php" class="active">
            ACCUEIL
        </a>
    </h2>

    <h2>
        <a href="contact.php">
            CONTACT
        </a>
    </h2>

    <h2>
        <a href="panier.php">
            PANIER 🛒
            <span id="cart-count">0</span>
        </a>
    </h2>
</nav>



<main>

    <h1 id="tt">
        NOS PARFUMS
    </h1>

    <p id="tr">
        DÉCOUVREZ NOTRE COLLECTION
    </p>


    <div class="products">

        <?php

        $sql = "SELECT * FROM products";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {

            while ($product = $result->fetch_assoc()) {

                $id = (int)$product['id'];

                $name = htmlspecialchars(
                    $product['name'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $image = htmlspecialchars(
                    $product['image'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $price30 = (float)$product['price_30'];
                $price50 = (float)$product['price_50'];
                $price100 = (float)$product['price_100'];

        ?>

        <div
            class="product-card"
            data-id="<?php echo $id; ?>"
        >

            <!-- IMAGE -->

            <img
                src="<?php echo $image; ?>"
                alt="<?php echo $name; ?>"
            >


            <!-- NOM -->

            <h3>
                <?php echo $name; ?>
            </h3>


            <!-- PRIX -->

            <p class="price">

                <span class="current-price">
                    <?php echo $price30; ?>
                </span>

                DT

            </p>


            <!-- TAILLES -->

            <div class="sizes">

                <button
                    type="button"
                    class="selected"
                    onclick="changePrice(this, <?php echo $price30; ?>)"
                >
                    30 ML
                </button>


                <button
                    type="button"
                    onclick="changePrice(this, <?php echo $price50; ?>)"
                >
                    50 ML
                </button>


                <button
                    type="button"
                    onclick="changePrice(this, <?php echo $price100; ?>)"
                >
                    100 ML
                </button>

            </div>


            <!-- AJOUTER AU PANIER -->

            <button
                type="button"
                class="add-cart"
                onclick="addToCart(this)"
            >
                AJOUTER AU PANIER
            </button>

        </div>

        <?php

            }

        } else {

            echo "<p>Aucun produit trouvé.</p>";

        }

        ?>

    </div>

</main>


<script src="script.js"></script>

</body>
</html>