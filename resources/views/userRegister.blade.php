<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Create Account</title>
</head>

<body class="font-[Inter]">

    <!-- Logo -->
    <section class="w-full mt-5 flex justify-center">
        <img src="{{ asset('images/logo/PaoPals_BigLogo.png') }}"
             alt="logo"
             class="w-[180px] h-[160px]">
    </section>

    <!-- Main Container -->
    <section class="flex flex-col mx-auto mt-3 w-full max-w-[1000px] items-center justify-center">

        <h1 class="text-[#CE5959] text-[35px] font-semibold">
            Create an Account
        </h1>

        <!-- Form Container -->
        <div class="bg-[#FEFAF8] border border-black flex flex-col items-center justify-center px-12 py-5 rounded-2xl mt-5 mb-10">

            <h2 class="text-sm font-normal self-start mb-3">
                Already have an account?
                <a href="/login" class="text-[#CE5959] hover:underline">
                    Sign in
                </a>
            </h2>

            <form method="POST" action=""
                  class="flex flex-col items-center justify-center gap-1">
                @csrf

                <label class="self-start font-medium text-lg mt-2">
                    First Name
                </label>
                <input type="text" name="firstName" value="{{ old('firstName') }}" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <label class="self-start font-medium text-lg mt-2">
                    Last Name
                </label>
                <input type="text" name="lastName" value="{{ old('lastName') }}" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <label class="self-start font-medium text-lg mt-2">
                    Email Address
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <label class="self-start font-medium text-lg mt-2">
                    Contact Number
                </label>
                <input type="text" inputmode="numeric" name="contactNumber"
                       value="{{ old('contactNumber') }}" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <label class="self-start font-medium text-lg mt-2">
                    Address
                </label>
                <input type="text" name="address" value="{{ old('address') }}" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <label class="self-start font-medium text-lg mt-2">
                    Password <small class="text-sm font-normal">( min 8 characters )</small>
                </label>
                <input type="password" name="password" required
                       class="w-[500px] border border-black rounded-md px-2 py-1">

                <button type="submit"
                        class="h-[57px] bg-[#CE5959] text-white w-[513px] py-4 mt-5 text-lg font-lg rounded-full hover:bg-[#ff5858] transition">
                    Create an Account
                </button>
            </form>
        </div>
    </section>

</body>
</html>
