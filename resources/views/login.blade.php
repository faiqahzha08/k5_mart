@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        font-family: Inter, Arial, sans-serif;

        /*
        ========================================
        BACKGROUND TEMA POS
        ========================================
        */
        background:
            radial-gradient(
                circle at 15% 20%,
                rgba(37, 99, 235, 0.35),
                transparent 32%
            ),
            radial-gradient(
                circle at 85% 75%,
                rgba(14, 165, 233, 0.25),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #020617 0%,
                #0f172a 45%,
                #172554 100%
            ) !important;

        color: #fff;
        overflow-x: hidden;
    }


    /* ========================================
       HALAMAN LOGIN
    ======================================== */

    .login-page {
        position: relative;
        min-height: 100vh;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 30px;

        overflow: hidden;
    }


    /* ========================================
       BACKGROUND GLOW
    ======================================== */

    .glow {
        position: absolute;
        border-radius: 50%;

        filter: blur(100px);

        pointer-events: none;
    }


    .glow-1 {
        width: 500px;
        height: 500px;

        background: rgba(37, 99, 235, 0.30);

        top: -200px;
        left: -150px;
    }


    .glow-2 {
        width: 500px;
        height: 500px;

        background: rgba(59, 130, 246, 0.22);

        right: -180px;
        bottom: -200px;
    }


    .glow-3 {
        width: 300px;
        height: 300px;

        background: rgba(14, 165, 233, 0.12);

        left: 45%;
        top: 35%;

        filter: blur(120px);
    }


    /* ========================================
       GRID BACKGROUND
    ======================================== */

    .grid-background {
        position: absolute;

        inset: 0;

        opacity: 0.25;

        background-image:
            linear-gradient(
                rgba(148, 163, 184, 0.05) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(148, 163, 184, 0.05) 1px,
                transparent 1px
            );

        background-size: 45px 45px;

        mask-image:
            linear-gradient(
                to bottom,
                black,
                transparent
            );

        pointer-events: none;
    }


    /* ========================================
       LINGKARAN DECORATION
    ======================================== */

    .circle-decoration {
        position: absolute;

        width: 420px;
        height: 420px;

        border: 1px solid rgba(96, 165, 250, 0.08);

        border-radius: 50%;

        right: -160px;
        top: -150px;

        pointer-events: none;
    }


    .circle-decoration::before {
        content: '';

        position: absolute;

        width: 300px;
        height: 300px;

        border: 1px solid rgba(96, 165, 250, 0.08);

        border-radius: 50%;

        top: 60px;
        left: 60px;
    }


    .circle-decoration::after {
        content: '';

        position: absolute;

        width: 180px;
        height: 180px;

        border: 1px solid rgba(96, 165, 250, 0.08);

        border-radius: 50%;

        top: 120px;
        left: 120px;
    }


    /* ========================================
       CONTAINER
    ======================================== */

    .login-container {
        position: relative;

        z-index: 5;

        width: 100%;
        max-width: 1050px;

        min-height: 650px;

        display: grid;

        grid-template-columns: 1fr 1fr;

        background: rgba(15, 23, 42, 0.72);

        border: 1px solid rgba(148, 163, 184, 0.13);

        border-radius: 30px;

        overflow: hidden;

        box-shadow:
            0 30px 80px rgba(0, 0, 0, 0.55),
            0 0 80px rgba(37, 99, 235, 0.10);

        backdrop-filter: blur(25px);

        -webkit-backdrop-filter: blur(25px);

        animation: cardAppear 0.7s ease forwards;
    }


    /* ========================================
       LEFT BRANDING
    ======================================== */

    .login-brand {
        position: relative;

        display: flex;

        flex-direction: column;

        justify-content: space-between;

        padding: 55px;

        overflow: hidden;

        background:
            linear-gradient(
                145deg,
                #1d4ed8 0%,
                #1e40af 45%,
                #0f172a 100%
            );
    }


    .login-brand::before {
        content: '';

        position: absolute;

        width: 450px;
        height: 450px;

        border-radius: 50%;

        background:
            radial-gradient(
                circle,
                rgba(96, 165, 250, 0.25),
                transparent 70%
            );

        top: -220px;
        right: -180px;
    }


    .brand-decoration {
        position: absolute;

        width: 350px;
        height: 350px;

        border-radius: 50%;

        border: 1px solid rgba(147, 197, 253, 0.13);

        right: -170px;
        top: -130px;
    }


    .brand-decoration::before {
        content: '';

        position: absolute;

        width: 250px;
        height: 250px;

        border-radius: 50%;

        border: 1px solid rgba(147, 197, 253, 0.11);

        top: 45px;
        left: 45px;
    }


    /* ========================================
       BRAND TOP
    ======================================== */

    .brand-top {
        position: relative;

        z-index: 2;
    }


    .brand-icon {
        width: 66px;
        height: 66px;

        border-radius: 18px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: rgba(255, 255, 255, 0.10);

        border: 1px solid rgba(255, 255, 255, 0.18);

        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.20);

        margin-bottom: 35px;
    }


    .brand-icon svg {
        width: 36px;
        height: 36px;

        filter:
            drop-shadow(
                0 0 10px
                rgba(147, 197, 253, 0.6)
            );
    }


    /* ========================================
       BRAND TITLE
    ======================================== */

    .brand-title {
        font-size: 46px;

        line-height: 1.05;

        font-weight: 800;

        letter-spacing: -1.8px;

        margin: 0 0 18px;

        color: #ffffff;
    }


    .brand-description {
        max-width: 390px;

        color: #dbeafe;

        font-size: 15px;

        line-height: 1.8;

        margin: 0;
    }


    /* ========================================
       FEATURES
    ======================================== */

    .brand-features {
        position: relative;

        z-index: 2;

        display: flex;

        flex-direction: column;

        gap: 14px;
    }


    .feature {
        display: flex;

        align-items: center;

        gap: 12px;

        color: #dbeafe;

        font-size: 13px;
    }


    .feature-icon {
        width: 31px;
        height: 31px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background: rgba(255, 255, 255, 0.08);

        border: 1px solid rgba(255, 255, 255, 0.10);
    }


    .feature-icon svg {
        width: 15px;
        height: 15px;
    }


    /* ========================================
       RIGHT LOGIN AREA
    ======================================== */

    .login-form-area {
        display: flex;

        align-items: center;

        justify-content: center;

        padding: 55px;

        background:
            rgba(2, 6, 23, 0.35);
    }


    .login-form {
        width: 100%;

        max-width: 390px;
    }


    /* ========================================
       MOBILE LOGO
    ======================================== */

    .mobile-logo {
        display: none;
    }


    /* ========================================
       HEADER
    ======================================== */

    .form-header {
        margin-bottom: 30px;
    }


    .form-header h2 {
        margin: 0 0 8px;

        font-size: 30px;

        font-weight: 750;

        letter-spacing: -0.8px;

        color: #f8fafc;
    }


    .form-header p {
        margin: 0;

        color: #94a3b8;

        font-size: 14px;
    }


    /* ========================================
       ALERT
    ======================================== */

    .alert {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 13px 15px;

        border-radius: 13px;

        font-size: 13px;

        margin-bottom: 20px;
    }


    .success-alert {
        background:
            rgba(16, 185, 129, 0.10);

        border:
            1px solid rgba(16, 185, 129, 0.25);

        color: #6ee7b7;
    }


    .error-alert {
        background:
            rgba(239, 68, 68, 0.10);

        border:
            1px solid rgba(239, 68, 68, 0.25);

        color: #fca5a5;
    }


    /* ========================================
       FORM GROUP
    ======================================== */

    .form-group {
        margin-bottom: 20px;
    }


    .form-label {
        display: block;

        color: #cbd5e1 !important;

        font-size: 13px;

        font-weight: 550;

        margin-bottom: 8px;
    }


    /* ========================================
       INPUT
    ======================================== */

    .input-wrapper {
        position: relative;
    }


    .input-icon {
        position: absolute;

        left: 15px;
        top: 50%;

        transform: translateY(-50%);

        width: 18px;
        height: 18px;

        color: #64748b;

        pointer-events: none;

        transition: 0.25s ease;

        z-index: 2;
    }


    .password-toggle {
        position: absolute;

        right: 15px;
        top: 50%;

        transform: translateY(-50%);

        width: 18px;
        height: 18px;

        color: #64748b;

        cursor: pointer;

        transition: 0.2s ease;

        z-index: 3;
    }


    .password-toggle:hover {
        color: #60a5fa;
    }


    .form-control {
        width: 100%;

        height: 52px !important;

        padding:
            0 45px !important;

        border-radius: 13px !important;

        border:
            1px solid rgba(71, 85, 105, 0.55) !important;

        background:
            rgba(15, 23, 42, 0.65) !important;

        color: #f8fafc !important;

        font-size: 14px !important;

        outline: none !important;

        transition:
            all 0.25s ease !important;
    }


    .form-control::placeholder {
        color: #475569 !important;
    }


    .form-control:hover {
        border-color:
            rgba(100, 116, 139, 0.7) !important;
    }


    .form-control:focus {
        border-color:
            #3b82f6 !important;

        background:
            rgba(15, 23, 42, 0.9) !important;

        box-shadow:
            0 0 0 3px
                rgba(59, 130, 246, 0.12),

            0 0 25px
                rgba(59, 130, 246, 0.08) !important;
    }


    /* ========================================
       LOGIN BUTTON
    ======================================== */

    .btn-login {
        position: relative;

        width: 100%;

        height: 52px;

        margin-top: 5px;

        border: none !important;

        border-radius: 13px !important;

        background:
            linear-gradient(
                135deg,
                #3b82f6,
                #2563eb
            ) !important;

        color: #fff !important;

        font-size: 14px;

        font-weight: 650;

        letter-spacing: 0.1px;

        cursor: pointer;

        overflow: hidden;

        transition:
            all 0.25s ease;

        box-shadow:
            0 10px 25px
                rgba(37, 99, 235, 0.30),

            inset 0 1px 0
                rgba(255, 255, 255, 0.18);
    }


    .btn-login::before {
        content: '';

        position: absolute;

        top: 0;
        left: -100%;

        width: 70%;
        height: 100%;

        background:
            linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.18),
                transparent
            );

        transition:
            left 0.5s ease;
    }


    .btn-login:hover {
        transform:
            translateY(-2px);

        box-shadow:
            0 14px 30px
                rgba(37, 99, 235, 0.40),

            inset 0 1px 0
                rgba(255, 255, 255, 0.20);
    }


    .btn-login:hover::before {
        left: 130%;
    }


    .btn-login:active {
        transform:
            translateY(0);
    }


    /* ========================================
       FOOTER
    ======================================== */

    .login-footer {
        text-align: center;

        margin-top: 25px;

        color: #475569;

        font-size: 12px;
    }


    .login-footer span {
        color: #64748b;
    }


    /* ========================================
       ANIMATION
    ======================================== */

    @keyframes cardAppear {

        from {
            opacity: 0;

            transform:
                translateY(25px)
                scale(0.98);
        }

        to {
            opacity: 1;

            transform:
                translateY(0)
                scale(1);
        }
    }


    @keyframes floatingGlow {

        0% {
            transform:
                translate(0, 0);
        }

        50% {
            transform:
                translate(20px, -15px);
        }

        100% {
            transform:
                translate(0, 0);
        }
    }


    .glow-1 {
        animation:
            floatingGlow 8s ease-in-out infinite;
    }


    .glow-2 {
        animation:
            floatingGlow 10s ease-in-out infinite reverse;
    }


    /* ========================================
       RESPONSIVE TABLET
    ======================================== */

    @media (max-width: 850px) {

        .login-container {
            grid-template-columns: 1fr;

            max-width: 480px;

            min-height: auto;
        }


        .login-brand {
            display: none;
        }


        .login-form-area {
            padding: 45px 35px;
        }


        .mobile-logo {
            width: 60px;
            height: 60px;

            margin:
                0 auto 22px;

            border-radius: 17px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                rgba(37, 99, 235, 0.15);

            border:
                1px solid
                rgba(59, 130, 246, 0.25);

            box-shadow:
                0 10px 30px
                rgba(37, 99, 235, 0.15);
        }


        .mobile-logo svg {
            width: 32px;
            height: 32px;
        }


        .form-header {
            text-align: center;
        }
    }


    /* ========================================
       RESPONSIVE MOBILE
    ======================================== */

    @media (max-width: 480px) {

        .login-page {
            padding: 15px;
        }


        .login-container {
            border-radius: 22px;
        }


        .login-form-area {
            padding:
                35px 22px;
        }


        .form-header h2 {
            font-size: 27px;
        }


        .form-header p {
            font-size: 13px;
        }
    }

</style>


<!-- ========================================
     LOGIN PAGE
========================================= -->

<div class="login-page">

    <!-- Background Effects -->

    <div class="glow glow-1"></div>

    <div class="glow glow-2"></div>

    <div class="glow glow-3"></div>

    <div class="grid-background"></div>


    <!-- Decorative Circle -->

    <div class="circle-decoration"></div>


    <!-- ========================================
         MAIN LOGIN CONTAINER
    ========================================= -->

    <div class="login-container">


        <!-- ====================================
             LEFT BRANDING
        ===================================== -->

        <div class="login-brand">

            <div class="brand-decoration"></div>


            <div class="brand-top">

                <!-- Icon -->

                <div class="brand-icon">

                    <svg
                        viewBox="0 0 48 48"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M8 18L12 10H36L40 18"
                            stroke="#bfdbfe"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                        <path
                            d="M10 18H38V36C38 37.1046 37.1046 38 36 38H12C10.8954 38 10 37.1046 10 36V18Z"
                            stroke="#bfdbfe"
                            stroke-width="2.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M18 26H22V34H18V26Z"
                            stroke="#bfdbfe"
                            stroke-width="2.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M28 26H34V30H28V26Z"
                            stroke="#bfdbfe"
                            stroke-width="2.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M30 18V14C30 12.8954 30.8954 12 32 12H36"
                            stroke="#bfdbfe"
                            stroke-width="2.5"
                            stroke-linecap="round"/>
                    </svg>

                </div>


                <!-- Title -->

                <h1 class="brand-title">

                    K5<br>Mart

                    System.

                </h1>


                <!-- Description -->

                <p class="brand-description">

                    Kelola penjualan, produk, stok,
                    dan transaksi bisnis Anda dengan
                    lebih mudah, cepat, dan efisien.

                </p>

            </div>


            <!-- ====================================
                 FEATURES
            ===================================== -->

            <div class="brand-features">


                <!-- Feature 1 -->

                <div class="feature">

                    <div class="feature-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <polyline
                                points="20 6 9 17 4 12"/>

                        </svg>

                    </div>

                    Sistem penjualan yang cepat

                </div>


                <!-- Feature 2 -->

                <div class="feature">

                    <div class="feature-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <path d="M3 3v18h18"/>

                            <path
                                d="M7 16l4-5 3 3 5-7"/>

                        </svg>

                    </div>

                    Monitoring stok secara mudah

                </div>


                <!-- Feature 3 -->

                <div class="feature">

                    <div class="feature-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2">

                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="16"
                                rx="2"/>

                            <line
                                x1="3"
                                y1="10"
                                x2="21"
                                y2="10"/>

                        </svg>

                    </div>

                    Laporan transaksi terorganisir

                </div>


            </div>

        </div>


        <!-- ====================================
             RIGHT LOGIN
        ===================================== -->

        <div class="login-form-area">


            <div class="login-form">


                <!-- Mobile Logo -->

                <div class="mobile-logo">

                    <svg
                        viewBox="0 0 48 48"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">

                        <path
                            d="M8 18L12 10H36L40 18"
                            stroke="#60a5fa"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                        <path
                            d="M10 18H38V36C38 37.1046 37.1046 38 36 38H12C10.8954 38 10 37.1046 10 36V18Z"
                            stroke="#60a5fa"
                            stroke-width="2.5"
                            stroke-linejoin="round"/>

                        <path
                            d="M18 26H22V34H18V26Z"
                            stroke="#60a5fa"
                            stroke-width="2.5"/>

                        <path
                            d="M28 26H34V30H28V26Z"
                            stroke="#60a5fa"
                            stroke-width="2.5"/>

                    </svg>

                </div>


                <!-- =================================
                     HEADER
                ================================== -->

                <div class="form-header">

                    <h2>
                        Selamat datang 👋
                    </h2>

                    <p>
                        Login ke akun Anda untuk melanjutkan.
                    </p>

                </div>


                <!-- =================================
                     SUCCESS ALERT
                ================================== -->

                @if(session('success'))

                    <div class="alert success-alert">

                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <path
                                d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                            <polyline
                                points="22 4 12 14.01 9 11.01"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                        </svg>


                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                @endif


                <!-- =================================
                     ERROR ALERT
                ================================== -->

                @if(session('error'))

                    <div class="alert error-alert">

                        <svg
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5">

                            <circle
                                cx="12"
                                cy="12"
                                r="10"/>

                            <line
                                x1="15"
                                y1="9"
                                x2="9"
                                y2="15"/>

                            <line
                                x1="9"
                                y1="9"
                                x2="15"
                                y2="15"/>

                        </svg>


                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                @endif


                <!-- =================================
                     LOGIN FORM
                ================================== -->

                <form
                    method="POST"
                    action="{{ route('login.post') }}">

                    @csrf


                    <!-- =================================
                         EMAIL
                    ================================== -->

                    <div class="form-group">

                        <label class="form-label">

                            Email

                        </label>


                        <div class="input-wrapper">


                            <!-- Email Icon -->

                            <svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <rect
                                    x="2"
                                    y="4"
                                    width="20"
                                    height="16"
                                    rx="2"/>

                                <path
                                    d="M22 7L12 13L2 7"/>

                            </svg>


                            <!-- Email Input -->

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan email Anda"
                                value="{{ old('email') }}"
                                required
                                autofocus>

                        </div>

                    </div>


                    <!-- =================================
                         PASSWORD
                    ================================== -->

                    <div class="form-group">

                        <label class="form-label">

                            Password

                        </label>


                        <div class="input-wrapper">


                            <!-- Lock Icon -->

                            <svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <rect
                                    x="3"
                                    y="11"
                                    width="18"
                                    height="11"
                                    rx="2"/>

                                <path
                                    d="M7 11V7a5 5 0 0 1 10 0v4"/>

                            </svg>


                            <!-- Password -->

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Masukkan password Anda"
                                required>


                            <!-- Show Password -->

                            <svg
                                class="password-toggle"
                                id="passwordIcon"
                                onclick="togglePassword()"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"/>

                            </svg>

                        </div>

                    </div>


                    <!-- =================================
                         LOGIN BUTTON
                    ================================== -->

                    <button
                        type="submit"
                        class="btn-login">

                        Masuk ke Dashboard

                    </button>


                </form>


                <!-- =================================
                     FOOTER
                ================================== -->

                <div class="login-footer">

                    <span>
                        © {{ date('Y') }} K5 Mart
                    </span>

                </div>


            </div>

        </div>


    </div>

</div>


<!-- ========================================
     JAVASCRIPT
========================================= -->

<script>

    function togglePassword() {

        const input =
            document.getElementById('password');

        const icon =
            document.getElementById('passwordIcon');


        if (input.type === 'password') {

            input.type = 'text';

            icon.style.color = '#60a5fa';

        } else {

            input.type = 'password';

            icon.style.color = '#64748b';

        }

    }

</script>

@endsection
