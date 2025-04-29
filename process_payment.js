// process_payment.js

document.addEventListener("DOMContentLoaded", () => {
    console.log("Payment confirmation page loaded ✅");

    // Optional: animate confirmation box
    const confirmationBox = document.querySelector('.confirmation-box');
    if (confirmationBox) {
        confirmationBox.classList.add('animate__animated', 'animate__fadeInUp');
    }

    // Optional: alert user before redirect
    setTimeout(() => {
        alert("You'll be redirected to the homepage in a few seconds.");
    }, 10000);
});
