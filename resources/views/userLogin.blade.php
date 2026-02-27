<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Login Page</title>
</head>

<body class="font-[Inter] bg-white">

    <!-- Logo -->
    <section class="w-full flex justify-center mt-5">
        <img src="{{ asset('images/logo/PaoPals_bigLogo.png') }}"
             alt="logo"
             class="w-[180px] h-[160px]">
    </section>

    <!-- Main Container -->
    <section class="flex flex-col items-center justify-center mt-12 mx-auto w-[1000px]">

        <!-- Intro -->
        <div class="flex flex-col items-center text-center w-[700px]">
            <h1 class="text-[35px] text-[#CE5959] font-semibold">Sign In</h1>
            <h3 class="text-[18px] mt-4 font-normal">
                Welcome to Paopals! Sign in to order delicious siopao, manage your account,
                and enjoy seamless service!
            </h3>
        </div>

        <!-- Login Form -->
       <div class="w-[700px] bg-[#FEFAF8] border border-black rounded-2xl px-8 pt-6 pb-6 mt-5">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center" novalidate>
                @csrf
                <!-- Email -->
                <label class="self-start ml-[110px] mt-5 text-[20px] font-medium">Email</label>
                <input type="email" id="email" name="email" autocomplete="none" value="{{ old('email') }}"
                    class="w-[400px] border border-black rounded-md py-2 pl-10 bg-no-repeat bg-[length:24px_24px] bg-[position:7px_center]"
                    style="background-image: url('{{ asset('images/icons/email_icon.png') }}');">
                <p id="emailError"
                    class="hidden w-[400px] text-sm px-3 py-2 text-red-700">
                </p>

                <!-- Password -->
                <label class="self-start ml-[110px] mt-5 text-[20px] font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="w-[400px] border border-black rounded-md py-2 pl-10 bg-no-repeat bg-[position:11px_center]" 
                    style="background-image: url('{{ asset('images/icons/password_icon.png') }}');">
                <p id="passwordError"
                    class="hidden w-[400px] text-sm px-3 py-2 text-red-700">
                </p>

                <!-- Show Password Checkbox -->
                <div class="flex justify-between items-center w-[410px] ml-5 mt-4">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" id="showPassword">
                        <label for="showPassword" class="text-xs">Show Password</label>
                    </div>
                </div>

                <div id="loginError"
                    class="hidden w-[400px] px-3 py-2 text-red-700 text-center border border-red-700 rounded mt-4">
                </div>

                <!-- Password visibility -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const passwordInput = document.getElementById('password');
                        const showPasswordCheckbox = document.getElementById('showPassword');

                        showPasswordCheckbox.addEventListener('change', function() {
                            passwordInput.type = this.checked ? 'text' : 'password';
                        });
                    });
                </script>

                <!-- Sign In Button -->
                <button type="submit"
                        class="h-[45px] bg-[#CE5959] hover:bg-[#ff5858] text-white font-medium text-base px-10 py-2 rounded-full transition mb-0 mt-3">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Create Account -->
        <div class="w-[700px] h-[150px] mt-6 bg-[#F1B9B2] border border-black rounded-2xl
                    flex flex-col items-center justify-evenly text-center mb-10">
            <h1 class="text-2xl font-semibold">
                Want to create an account?
            </h1>
            <button onclick="location.href='{{ route('register') }}'"
                    class="h-[45px] bg-[#CE5959] hover:bg-[#ff5858] text-white
                            font-medium px-5 py-1 rounded-3xl transition text-base">
                Create an Account
            </button>
        </div>

    </section>


    <!-- OTP MODAL -->
    <div id="otpModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-xl w-[350px] text-center">

            <h2 class="text-xl font-semibold text-[#CE5959] mb-4">
                Enter OTP Code
            </h2>

            <input id="otpInput" type="text" maxlength="6"
                class="border w-full p-2 rounded mb-3 text-center"
                placeholder="6-digit code">

            <p id="otpError" class="text-red-500 text-sm mb-2"></p>

            <button onclick="verifyOtp()"
                    class="bg-[#CE5959] text-white px-6 py-2 rounded-full w-full">
                Verify
            </button>

            <button onclick="resendOtp()"
                    class="mt-3 text-sm text-gray-600 underline">
                Resend OTP
            </button>
        </div>
    </div>

    <!-- FOOTER -->
    <script>
    const loginForm = document.querySelector('form');

    // CSRF token from Blade
    const csrfToken = '{{ csrf_token() }}';

    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Get elements
        const loginError = document.getElementById('loginError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        // Reset all errors
        loginError.classList.add('hidden');
        emailError.classList.add('hidden');
        passwordError.classList.add('hidden');

        emailInput.classList.remove('border-red-500');
        passwordInput.classList.remove('border-red-500');

        const formData = new FormData(loginForm);

        const response = await fetch("{{ route('login') }}", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: formData
        });

        const data = await response.json();

        // ✅ Validation errors (422)
        if (response.status === 422) {
            const errors = data.errors;

            if (errors.email) {
                emailError.textContent = errors.email[0];
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
            }

            if (errors.password) {
                passwordError.textContent = errors.password[0];
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('border-red-500');
            }

            return;
        }

        // Wrong credentials (401)
        if (response.status === 401) {
            loginError.textContent = data.error;
            loginError.classList.remove('hidden');
            return;
        }

        // Success → show OTP modal
        if (data.success) {
            document.getElementById('otpModal').classList.remove('hidden');
        }
    });


    // ✅ VERIFY OTP
    async function verifyOtp() {
        const otp = document.getElementById('otpInput').value;

        const response = await fetch("{{ route('verify.otp') }}", {
            method: "POST",
            credentials: "same-origin", // VERY IMPORTANT
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify({ otp: otp })
        });

        const data = await response.json();

        if (data.error) {
            document.getElementById('otpError').innerText = data.error;
        } else if (data.redirect) {
            window.location.href = data.redirect;
        }
    }


    // ✅ RESEND OTP
    async function resendOtp() {
        const response = await fetch("{{ route('resend.otp') }}", {
            method: "POST",
            credentials: "same-origin", // REQUIRED
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            }
        });

        const data = await response.json();

        if (data.success) {
            alert("OTP resent to your email.");
        }
    }
    </script>

</body>
</html>