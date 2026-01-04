<div class="container">

    <section class="mt-4 underline">
        <p>کد ورود شما به شاپیتگو</p>
        <p class="font-bold">اگر شما این کد رو درخواست ندادید این پیام را نادیده بگیرید</p>
    </section>

    <section class="text-2xl border-3">
        <p>
            {{ $email }}
            کد ورود شما:
        </p>
        <div style="
        margin-top:20px;
        padding:15px;
        background:#f8d7da;
        border-radius:8px;
        text-align:center;
        font-size:28px;
        font-weight:bold;
        letter-spacing:4px;
        ">
            {{ $code }}
        </div>
    </section>

</div>
