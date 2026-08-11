document.addEventListener("DOMContentLoaded", function () {

    // ================================
    // COMPTEUR PANIER
    // ================================

    updateCartCount();

});


// ================================
// COMPTEUR PANIER
// ================================

function updateCartCount() {

    const cartCount = document.getElementById("cart-count");

    // إذا العنصر موش موجود
    if (!cartCount) {
        return;
    }

    // جلب panier من LocalStorage
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    let count = 0;

    // حساب الكمية الكلية
    cart.forEach(function (item) {

        count += Number(item.quantity) || 0;

    });

    // عرض العدد
    cartCount.textContent = count;
}