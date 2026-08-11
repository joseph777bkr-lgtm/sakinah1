<?php

require_once "config.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ==========================
    // RÉCUPÉRER LES DONNÉES
    // ==========================

    $nom = trim($_POST["nom"] ?? "");
    $telephone = trim($_POST["telephone"] ?? "");
    $adresse = trim($_POST["adresse"] ?? "");
    $produits = trim($_POST["produits"] ?? "");
    $total = floatval($_POST["total"] ?? 0);

    // ==========================
    // VALIDATION
    // ==========================

    if (
        empty($nom) ||
        empty($telephone) ||
        empty($adresse) ||
        empty($produits) ||
        $total <= 0
    ) {

        $error = "Veuillez remplir tous les champs.";

    } else {

        // ==========================
        // PROTECTION SQL
        // ==========================

        $nom_db = $conn->real_escape_string($nom);
        $telephone_db = $conn->real_escape_string($telephone);
        $adresse_db = $conn->real_escape_string($adresse);
        $produits_db = $conn->real_escape_string($produits);

        // ==========================
        // PAIEMENT
        // ==========================

        $paiement = "Paiement à la livraison";

        $paiement_db =
            $conn->real_escape_string($paiement);

        // ==========================
        // ENREGISTRER LA COMMANDE
        // ==========================

        $sql = "
            INSERT INTO commandes
            (
                nom,
                telephone,
                adresse,
                produits,
                total,
                paiement
            )
            VALUES
            (
                '$nom_db',
                '$telephone_db',
                '$adresse_db',
                '$produits_db',
                '$total',
                '$paiement_db'
            )
        ";

        if ($conn->query($sql)) {

            $success =
                "✓ Votre commande a été enregistrée avec succès !";

        } else {

            $error =
                "Erreur : " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Passer la commande - SAKINAH</title>

    <link rel="stylesheet" href="commande.css">

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
        <a href="panier.php">
            PANIER 🛒
        </a>
    </h2>

</nav>


<!-- ================= MAIN ================= -->

<main>

    <section class="commande-container">

        <div class="commande-title">

            <h1>
                PASSER LA COMMANDE
            </h1>

            <p>
                Remplissez vos informations pour confirmer votre commande.
            </p>

        </div>


        <?php if (!empty($success)): ?>

            <div class="success-message">

                <?php echo htmlspecialchars($success); ?>

            </div>

        <?php endif; ?>


        <?php if (!empty($error)): ?>

            <div class="error-message">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <!-- ================= RÉSUMÉ PANIER ================= -->

        <div class="order-summary">

            <h2>
                RÉSUMÉ DE LA COMMANDE
            </h2>

            <div id="order-products">

                <!-- JavaScript affiche les produits -->

            </div>

            <div class="summary-total">

                Total :

                <strong id="order-total">
                    0 DT
                </strong>

            </div>

        </div>


        <!-- ================= FORMULAIRE ================= -->

        <div class="commande-form">

            <h2>
                VOS INFORMATIONS
            </h2>

            <form
                method="POST"
                action="commande.php"
                id="commandeForm"
            >

                <!-- NOM -->

                <div class="form-group">

                    <label for="nom">
                        Nom complet
                    </label>

                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        placeholder="Votre nom complet"
                        required
                    >

                </div>


                <!-- TÉLÉPHONE -->

                <div class="form-group">

                    <label for="telephone">
                        Téléphone
                    </label>

                    <input
                        type="tel"
                        id="telephone"
                        name="telephone"
                        placeholder="+216 XX XXX XXX"
                        required
                    >

                </div>


                <!-- ADRESSE -->

                <div class="form-group">

                    <label for="adresse">
                        Adresse de livraison
                    </label>

                    <textarea
                        id="adresse"
                        name="adresse"
                        rows="4"
                        placeholder="Votre adresse complète"
                        required
                    ></textarea>

                </div>


                <!-- PAIEMENT -->

                <div class="payment-box">

                    <h3>
                        MODE DE PAIEMENT
                    </h3>

                    <p>
                        💵 Paiement à la livraison
                    </p>

                </div>


                <!-- DONNÉES CACHÉES -->

                <input
                    type="hidden"
                    name="produits"
                    id="produits"
                >

                <input
                    type="hidden"
                    name="total"
                    id="total"
                >


                <!-- BOUTON -->

                <button
                    type="submit"
                    class="confirm-btn"
                >
                    CONFIRMER LA COMMANDE
                </button>

            </form>

        </div>

    </section>

</main>


<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {

        const cart =
            JSON.parse(
                localStorage.getItem("cart")
            ) || [];


        const productsContainer =
            document.getElementById(
                "order-products"
            );

        const totalElement =
            document.getElementById(
                "order-total"
            );

        const productsInput =
            document.getElementById(
                "produits"
            );

        const totalInput =
            document.getElementById(
                "total"
            );


        // ==========================
        // PANIER VIDE
        // ==========================

        if (cart.length === 0) {

            productsContainer.innerHTML = `
                <p>
                    Votre panier est vide.
                </p>
            `;

            return;
        }


        let total = 0;

        let productsText = "";


        // ==========================
        // AFFICHER PRODUITS
        // ==========================

        cart.forEach(function (item) {

            const price =
                Number(item.price);

            const quantity =
                Number(item.quantity);

            const itemTotal =
                price * quantity;

            total += itemTotal;


            productsContainer.innerHTML += `

                <div class="order-product">

                    <img
                        src="${item.image || ''}"
                        alt="${item.name}"
                    >

                    <div>

                        <h3>
                            ${item.name}
                        </h3>

                        <p>
                            Taille :
                            ${item.size}
                        </p>

                        <p>
                            Quantité :
                            ${quantity}
                        </p>

                        <p>
                            Prix :
                            ${price} DT
                        </p>

                    </div>

                </div>

            `;


            // Texte qui sera enregistré MySQL

            productsText +=
                "Produit : " +
                item.name +
                " | Taille : " +
                item.size +
                " | Quantité : " +
                quantity +
                " | Prix : " +
                price +
                " DT | Total : " +
                itemTotal +
                " DT\n";

        });


        // ==========================
        // TOTAL
        // ==========================

        totalElement.textContent =
            total + " DT";


        // ==========================
        // INPUTS CACHÉS
        // ==========================

        productsInput.value =
            productsText;

        totalInput.value =
            total;


    }
);

</script>

</body>

</html>