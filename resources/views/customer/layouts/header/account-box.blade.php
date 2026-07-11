@auth
<section class="dropdown d-inline-block px-3">
    <button
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        class="btn p-0 border-0 bg-transparent shadow-none">
        <section
            class="d-flex justify-content-center align-items-center"
            style="
                                    width:42px;
                                    height:42px;
                                    border-radius:14px;
                                    background:#fff;
                                    border:1px solid #e5e7eb;
                                    transition:.25s;
                                    box-shadow:0 4px 12px rgba(0,0,0,.08);"
            onmouseover="this.style.background='#2563eb';this.style.color='#fff';this.style.borderColor='#2563eb';"
            onmouseout="this.style.background='#fff';this.style.color='#374151';this.style.borderColor='#e5e7eb';">
            <i class="fas fa-user" style="font-size:15px;color:inherit;"></i>
        </section>
    </button>
    <section
        class="dropdown-menu dropdown-menu-end p-0 overflow-hidden"
        style="
                                width:250px;
                                border:none;
                                border-radius:18px;
                                box-shadow:0 20px 45px rgba(0,0,0,.12);
                                margin-top:12px;
                            ">
        <section
            style="
                                    background:linear-gradient(135deg,#2563eb,#1d4ed8);
                                    color:#fff;
                                    padding:16px;
                                ">
            <div style="font-size:14px;font-weight:bold;">
                {{ auth()->user()->full_name ?? auth()->user()->username }}
            </div>

            <small style="opacity:.9;">
                حساب کاربری
            </small>
        </section>
        <a href="#"
           class="dropdown-item py-2">
            <i class="far fa-user-circle text-primary me-2"></i>
            پروفایل کاربری
        </a>
        <a href="{{ route('customer.profile.orders') }}"
           class="dropdown-item py-2">
            <i class="fas fa-shopping-bag text-success me-2"></i>
            سفارشات
        </a>
        <a href="{{ route('customer.profile.my-favorites') }}"
           class="dropdown-item py-2">
            <i class="far fa-heart text-danger me-2"></i>
            علاقه‌مندی‌ها
        </a>
        <div class="dropdown-divider m-0"></div>
        <button
            form="logout-form"
            class="dropdown-item py-2 text-danger">

            <i class="fas fa-sign-out-alt me-2"></i>
            خروج
        </button>
        <form
            id="logout-form"
            action="{{ route('auth.customer.logout') }}"
            method="POST">

            @csrf
        </form>
    </section>
</section>
@endauth
@guest
<a href="{{ route('auth.customer.login-register-form') }}" class="btn-link text-decoration-none text-dark profile-button mr-5">
    <i class="fa fa-user-lock"></i>
</a>
@endguest
