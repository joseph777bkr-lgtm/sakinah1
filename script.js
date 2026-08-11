// ==========================================
// CHANGER LE PRIX ET LA TAILLE
// ==========================================

function changePrice(button, price) {

    const card = button.closest(".product-card");

    if (!card) {
        return;
    }

    // Changer le prix affiché
    const priceElement = card.querySelector(".current-price");

    if (priceElement) {
        priceElement.textContent = price;
    }

    // Enlever selected de tous les boutons
    const buttons = card.querySelectorAll(".sizes button");

    buttons.forEach(function (btn) {
        btn.classList.remove("selected");
    });

    // Sélectionner le bouton choisi
    button.classList.add("selected");

    // Sauvegarder le choix
    card.dataset.selectedPrice = price;
    card.dataset.selectedSize = button.textContent.trim();
}



// ==========================================
// AJOUTER AU PANIER
// ==========================================

function addToCart(button) {

    const card = button.closest(".product-card");

    if (!card) {
        return;
    }

    // Récupérer les informations
    const id = card.dataset.id;

    const nameElement = card.querySelector("h3");
    const imageElement = card.querySelector("img");

    const name = nameElement
        ? nameElement.textContent.trim()
        : "";

    const image = imageElement
        ? imageElement.getAttribute("src")
        : "";

    const price = Number(card.dataset.selectedPrice);
    const size = card.dataset.selectedSize;


    // Vérification
    if (!id || !name) {
        return;
    }

    if (!price || !size) {
        return;
    }


    // Récupérer le panier
    let cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    // Chercher produit + taille
    const existingProduct = cart.find(function (item) {

        return String(item.id) === String(id)
            && item.size === size;

    });


    // Produit déjà présent
    if (existingProduct) {

        existingProduct.quantity =
            Number(existingProduct.quantity) + 1;

    }

    // Nouveau produit
    else {

        cart.push({

            id: id,

            name: name,

            image: image,

            size: size,

            price: price,

            quantity: 1

        });

    }


    // Sauvegarder
    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );


    // Mettre à jour le compteur
    updateCartCount();


    // Petit effet sur le bouton
    button.textContent = "AJOUTÉ ✓";

    setTimeout(function () {

        button.textContent = "AJOUTER AU PANIER";

    }, 1000);

}



// ==========================================
// COMPTEUR DU PANIER
// ==========================================

function updateCartCount() {

    const cartCount =
        document.getElementById("cart-count");

    if (!cartCount) {
        return;
    }


    const cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    let count = 0;


    cart.forEach(function (item) {

        count += Number(item.quantity);

    });


    cartCount.textContent = count;
}



// ==========================================
// AFFICHER LE PANIER
// ==========================================

function displayCart() {

    const cartItems =
        document.getElementById("cart-items");

    const totalPrice =
        document.getElementById("total-price");


    // Pas sur la page panier
    if (!cartItems) {
        return;
    }


    const cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    // Panier vide
    if (cart.length === 0) {

        cartItems.innerHTML = `

            <div class="empty-cart">

                <p>
                    Votre panier est vide.
                </p>

            </div>

        `;


        if (totalPrice) {
            totalPrice.textContent = "0 DT";
        }

        return;
    }


    let total = 0;

    cartItems.innerHTML = "";


    // Afficher chaque produit
    cart.forEach(function (item, index) {

        const price =
            Number(item.price);

        const quantity =
            Number(item.quantity);

        const itemTotal =
            price * quantity;


        total += itemTotal;


        cartItems.innerHTML += `

            <div class="cart-item">


                <!-- IMAGE -->

                <div class="cart-image">

                    <img
                        src="${item.image || ''}"
                        alt="${item.name}"
                    >

                </div>


                <!-- INFORMATIONS -->

                <div class="cart-info">

                    <h3>
                        ${item.name}
                    </h3>

                    <p>
                        Taille :
                        <strong>${item.size}</strong>
                    </p>

                    <p>
                        Prix :
                        <strong>${price} DT</strong>
                    </p>

                    <p>
                        Quantité :
                        <strong>${quantity}</strong>
                    </p>

                    <p>
                        Total :
                        <strong>${itemTotal} DT</strong>
                    </p>

                </div>


                <!-- QUANTITÉ -->

                <div class="cart-quantity">

                    <button
                        type="button"
                        onclick="decreaseQuantity(${index})"
                    >
                        −
                    </button>


                    <span>
                        ${quantity}
                    </span>


                    <button
                        type="button"
                        onclick="increaseQuantity(${index})"
                    >
                        +
                    </button>

                </div>


                <!-- SUPPRIMER -->

                <button
                    type="button"
                    class="remove-cart"
                    onclick="removeFromCart(${index})"
                >
                    SUPPRIMER
                </button>


            </div>

        `;

    });


    // Total général
    if (totalPrice) {

        totalPrice.textContent =
            total + " DT";

    }

}



// ==========================================
// AUGMENTER QUANTITÉ
// ==========================================

function increaseQuantity(index) {

    let cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    if (cart[index]) {

        cart[index].quantity =
            Number(cart[index].quantity) + 1;

    }


    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );


    displayCart();

    updateCartCount();

}



// ==========================================
// DIMINUER QUANTITÉ
// ==========================================

function decreaseQuantity(index) {

    let cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    if (!cart[index]) {
        return;
    }


    cart[index].quantity =
        Number(cart[index].quantity) - 1;


    // Si quantité = 0
    if (cart[index].quantity <= 0) {

        cart.splice(index, 1);

    }


    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );


    displayCart();

    updateCartCount();

}



// ==========================================
// SUPPRIMER UN PRODUIT
// ==========================================

function removeFromCart(index) {

    let cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    cart.splice(index, 1);


    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );


    displayCart();

    updateCartCount();

}



// ==========================================
// VIDER LE PANIER
// ==========================================

function clearCart() {

    localStorage.removeItem("cart");


    displayCart();

    updateCartCount();

}



// ==========================================
// PASSER LA COMMANDE
// ==========================================

function goToCommande() {

    const cart =
        JSON.parse(localStorage.getItem("cart")) || [];


    if (cart.length === 0) {

        return;

    }


    window.location.href =
        "commande.php";

}



// ==========================================
// INITIALISATION
// ==========================================

document.addEventListener(
    "DOMContentLoaded",
    function () {


        // ======================================
        // INITIALISER 30 ML PAR DÉFAUT
        // ======================================

        const cards =
            document.querySelectorAll(".product-card");


        cards.forEach(function (card) {

            const firstSizeButton =
                card.querySelector(".sizes button");


            if (!firstSizeButton) {
                return;
            }


            // 30 ML sélectionné
            firstSizeButton.classList.add("selected");


            // Récupérer le prix depuis onclick
            const onclickValue =
                firstSizeButton.getAttribute("onclick");


            if (onclickValue) {

                const match =
                    onclickValue.match(
                        /changePrice\(this,\s*([0-9.]+)/
                    );


                if (match) {

                    const price =
                        Number(match[1]);


                    // Sauvegarder automatiquement
                    card.dataset.selectedPrice =
                        price;


                    card.dataset.selectedSize =
                        firstSizeButton
                            .textContent
                            .trim();

                }

            }

        });


        // Compteur panier
        updateCartCount();


        // Afficher panier
        displayCart();

    }
);


function goToCommande() {

    const cart =
        JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {

        alert("Votre panier est vide.");

        return;
    }

    window.location.href = "commande.php";
}