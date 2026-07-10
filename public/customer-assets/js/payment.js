document.addEventListener("DOMContentLoaded", () => {

    const radios = document.querySelectorAll("input[name='payment_type']");

    const infoButton = document.getElementById("payment-button");
    const submitButton = document.getElementById("payment-button-redirect");
    const hiddenInput = document.getElementById("payment_type_hidden");

    radios.forEach(radio => {

        radio.addEventListener("change", () => {

            hiddenInput.value = radio.id;

            infoButton.classList.add("d-none");

            submitButton.classList.remove("d-none");
            submitButton.disabled = false;

        });

    });

});
