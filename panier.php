```php
<?php
// panier.php
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panier - SAKINAH</title>

    <link rel="stylesheet" href="style.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet"
    >

</head>

<body>

<!-- ================= HEADER ================= -->

<header>

    <h1 class="text text1">
        LA COLLECTION SAKINAH
    </h1>

    <h1 class="text text2">
        DES PARFUMS D'EXCEPTION
    </h1>

    <h1 class="text text3">
        L'ÉLÉGANCE EN FRAGRANCE
    </h1>

</header>


<!-- ================= NAV ================= -->


<nav>
    <img src="logo.JPEG" alt="Logo">

    <h2>
        <a href="index.php">
            ACCUEIL
        </a>
    </h2>

    <h2>
        <a href="contact.php">
            CONTACT
        </a>
    </h2>

    <h2>
        <a href="panier.php" class="active">
            PANIER 🛒
            <span id="cart-count">0</span>
        </a>
    </h2>
</nav>




<!-- ================= MAIN ================= -->

<main>

    <h1 id="tt">
        MON PANIER
    </h1>

    <p id="tr">
        VOS PRODUITS SÉLECTIONNÉS
    </p>


    <!-- ================= PANIER ================= -->

    <div class="cart-container">

        <div id="cart-items">
            <!-- JS affiche les produits ici -->
        </div>


        <div class="cart-total">

            <h2>
                Total :
                <span id="total-price">
                    0 DT
                </span>
            </h2>

        </div>


        <div class="cart-buttons">

            <button
                type="button"
                class="checkout-btn"
                onclick="goToCommande()"
            >
                PASSER LA COMMANDE
            </button>

            <button
                type="button"
                class="remove-cart"
                onclick="clearCart()"
            >
                VIDER LE PANIER
            </button>

        </div>

    </div>

</main>


<!-- ================= JAVASCRIPT ================= -->

<script src="script.js"></script>

</body>

</html>

