document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll("input[name='payment_type']");
    const button = document.getElementById("payment-button");

    radios.forEach(radio => {

        radio.addEventListener("change", function () {

            button.disabled = false;

            button.classList.remove(
                "bg-gray-300",
                "text-gray-600"
            );

            button.classList.add(
                "bg-gradient-to-r",
                "from-blue-600",
                "to-indigo-600",
                "hover:scale-[1.02]",
                "hover:shadow-xl",
                "text-white"
            );

            button.innerHTML =
                `<i class="fa-solid fa-lock mr-2"></i>
                 ثبت سفارش و انتقال به درگاه`;

        });

    });

});
