<?php

require_once "config.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // =========================
    // RÉCUPÉRATION DES DONNÉES
    // =========================

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");


    // =========================
    // VALIDATION
    // =========================

    if (
        empty($name) ||
        empty($email) ||
        empty($subject) ||
        empty($message)
    ) {

        $error = "Veuillez remplir tous les champs obligatoires.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Adresse email invalide.";

    } else {

        // =========================
        // PROTECTION SQL
        // =========================

        $name_db = $conn->real_escape_string($name);
        $email_db = $conn->real_escape_string($email);
        $phone_db = $conn->real_escape_string($phone);
        $subject_db = $conn->real_escape_string($subject);
        $message_db = $conn->real_escape_string($message);


        // =========================
        // ENREGISTRER DANS MYSQL
        // =========================

        $sql = "INSERT INTO contact_messages
                (name, email, phone, subject, message)
                VALUES
                ('$name_db', '$email_db', '$phone_db', '$subject_db', '$message_db')";


        if ($conn->query($sql)) {

            // =========================
            // ENVOI EMAIL
            // =========================

            $to = "joseph777bkr@gmail.com";

            $email_subject = "Nouveau message - SAKINAH";

            $email_body =
                "Nouveau message reçu depuis le site SAKINAH\n\n" .
                "Nom : " . $name . "\n" .
                "Email : " . $email . "\n" .
                "Téléphone : " . $phone . "\n" .
                "Sujet : " . $subject . "\n\n" .
                "Message :\n" .
                $message . "\n";


            $headers = "From: no-reply@sakinah.tn\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


            $mail_sent = mail(
                $to,
                $email_subject,
                $email_body,
                $headers
            );


            // =========================
            // RÉSULTAT
            // =========================

            if ($mail_sent) {

                $success =
                    "✓ Votre message a été envoyé avec succès !";

            } else {

                $success =
                    "✓ Votre message a été enregistré avec succès, " .
                    "mais l'envoi de l'email a échoué.";
            }


            // Vider les champs après envoi
            $name = "";
            $email = "";
            $phone = "";
            $subject = "";
            $message = "";

        } else {

            $error =
                "Erreur lors de l'enregistrement du message : "
                . $conn->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact - SAKINAH</title>

    <link rel="stylesheet" href="contact.css">

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
        <a href="contact.php" class="active">
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


<!-- ================= MAIN ================= -->

<main>

    <section class="contact-section">


        <!-- ================= TITLE ================= -->

        <div class="contact-title">

            <h1>
                CONTACTEZ-NOUS
            </h1>

            <p>
                Une question ? Nous sommes à votre écoute.
            </p>

        </div>


        <!-- ================= CONTACT CONTENT ================= -->

        <div class="contact-container">


            <!-- ================= INFORMATIONS ================= -->

            <div class="contact-info">

                <h2>
                    PARLONS-EN
                </h2>

                <p class="info-description">
                    Notre équipe est à votre disposition pour
                    répondre à toutes vos questions concernant
                    nos parfums et vos commandes.
                </p>


                <div class="info-item">

                    <span class="info-icon">
                        📍
                    </span>

                    <div class="info-text">

                        <h3>
                            Adresse
                        </h3>

                        <p>
                            Tunis, Tunisie (20 Mars Sidi Hssine)
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <span class="info-icon">
                        📞
                    </span>

                    <div class="info-text">

                        <h3>
                            Téléphone
                        </h3>

                        <p>
                            +216 XX XXX XXX
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <span class="info-icon">
                        ✉️
                    </span>

                    <div class="info-text">

                        <h3>
                            Email
                        </h3>

                        <p>
                            joseph777bkr@gmail.com
                        </p>

                    </div>

                </div>


                <div class="info-item">

                    <span class="info-icon">
                        🕐
                    </span>

                    <div class="info-text">

                        <h3>
                            Horaires
                        </h3>

                        <p>
                            Lundi - Samedi : 09:00 - 18:00
                        </p>

                    </div>

                </div>

            </div>


            <!-- ================= FORMULAIRE ================= -->

            <div class="contact-form">

                <h2>
                    ENVOYEZ-NOUS UN MESSAGE
                </h2>


                <?php if (!empty($success)): ?>

                    <div class="success-message"
                         style="display:block;">

                        <?php echo htmlspecialchars($success); ?>

                    </div>

                <?php endif; ?>


                <?php if (!empty($error)): ?>

                    <div class="error-message">

                        <?php echo htmlspecialchars($error); ?>

                    </div>

                <?php endif; ?>


                <form method="POST"
                      action="contact.php"
                      id="contactForm">


                    <!-- NOM -->

                    <div class="form-group">

                        <label for="name">
                            Nom complet
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Votre nom complet"
                            value="<?php echo htmlspecialchars($name ?? ''); ?>"
                            required
                        >

                    </div>


                    <!-- EMAIL -->

                    <div class="form-group">

                        <label for="email">
                            Adresse email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="exemple@email.com"
                            value="<?php echo htmlspecialchars($email ?? ''); ?>"
                            required
                        >

                    </div>


                    <!-- TELEPHONE -->

                    <div class="form-group">

                        <label for="phone">
                            Téléphone
                        </label>

                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="+216 XX XXX XXX"
                            value="<?php echo htmlspecialchars($phone ?? ''); ?>"
                        >

                    </div>


                    <!-- SUJET -->

                    <div class="form-group">

                        <label for="subject">
                            Sujet
                        </label>

                        <select
                            id="subject"
                            name="subject"
                            required
                        >

                            <option value="">
                                Choisissez un sujet
                            </option>

                            <option value="Question générale">
                                Question générale
                            </option>

                            <option value="Question sur un parfum">
                                Question sur un parfum
                            </option>

                            <option value="Question sur une commande">
                                Question sur une commande
                            </option>

                            <option value="Autre">
                                Autre
                            </option>

                        </select>

                    </div>


                    <!-- MESSAGE -->

                    <div class="form-group">

                        <label for="message">
                            Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            placeholder="Écrivez votre message..."
                            required
                        ><?php echo htmlspecialchars($message ?? ''); ?></textarea>

                    </div>


                    <!-- BUTTONS -->

                    <div class="form-buttons">

                        <button
                            type="submit"
                            class="send-btn"
                        >
                            ENVOYER LE MESSAGE
                        </button>


                        <button
                            type="reset"
                            class="reset-btn"
                        >
                            EFFACER
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</main>


 <script src="contact.js"></script> 

</body>

</html>