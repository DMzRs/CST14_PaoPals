<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <div class="w-[700px] h-[330px] bg-[#FEFAF8] border border-black rounded-2xl px-8 pt-6 pb-14 mt-5">
            <form method="POST" class="flex flex-col items-center">
                @csrf

                <label class="self-start ml-32 mt-5 text-[20px] font-medium">
                    Email
                </label>
                <input type="email"
                       name="username"
                       required
                       class="w-[400px] border border-black rounded-md py-2 pl-10 bg-no-repeat bg-[length:24px_24px] bg-[position:7px_center]"
                       style="background-image: url('{{ asset('images/icons/email_icon.png') }}');">

                <label class="self-start ml-32 mt-5 text-[20px] font-medium">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       class="w-[400px] border border-black rounded-md py-2 pl-10 bg-no-repeat bg-[position:11px_center]"
                       style="background-image: url('{{ asset('images/icons/password_icon.png') }}');">

                <!-- Buttons -->
                <div class="flex justify-between items-center w-[410px] ml-5 mt-4">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" id="showPassword">
                        <label for="showPassword" class="text-xs">
                            Show Password
                        </label>
                    </div>
                </div>
                <button name="signIn"
                            class="h-[45px] bg-[#CE5959] hover:bg-[#ff5858] text-white font-medium text-base px-10 py-2 rounded-full transition mt-3">
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
            <button onclick="location.href='/register'"
                    class="h-[45px] bg-[#CE5959] hover:bg-[#ff5858] text-white
                            font-medium px-5 py-1 rounded-3xl transition text-base">
                Create an Account
            </button>
        </div>

    </section>
</body>
</html>
