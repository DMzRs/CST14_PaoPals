<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-['Inter'] m-0 p-0">

    <section class="fixed top-0 left-0 w-full z-[1000] flex flex-col m-0">

        <!-- Main Navbar -->
        <div class="flex items-center justify-between bg-white py-2">

            <!-- Logo -->
            <div class="pl-[120px]">
                <img src="{{ asset('images/logo/PaoPals_logo.png') }}" alt="logo">
            </div>

            <!-- Navigation Links -->
            <div class="">
                <ul class="flex items-center justify-evenly">
                    <li class="px-5 list-none">
                        <a href="@if(Auth::check()){{ route('frontPage') }}@else{{ route('login') }}@endif" class="text-black text-[16px] font-bold hover:text-[#CE5959] hover:underline">
                            Home
                        </a>
                    </li>
                    <li class="px-5 list-none">
                        <a href="@if(Auth::check()){{ route('menu.all') }}@else{{ route('login') }}@endif" class="text-black text-[16px] font-bold hover:text-[#CE5959] hover:underline">
                            Menu
                        </a>
                    </li>
                    <li class="px-5 list-none">
                        <a href="@if(Auth::check()){{ route('contact') }}@else{{ route('login') }}@endif" class="text-black text-[16px] font-bold hover:text-[#CE5959] hover:underline">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Action Icons -->
                <div class="mr-[100px] flex items-center justify-evenly">
                    @if(Auth::check())
                        <!-- If user is logged in -->
                        <a href="{{ route('profile') }}">
                            <img src="{{ asset('images/icons/username_icon.png') }}"
                                class="mx-5 cursor-pointer"
                                alt="profile">
                        </a>
                        <a href="{{ route('cart.index') }}">
                        <img src="{{ asset('images/icons/cart_icon.png') }}"
                            class="mx-5 cursor-pointer"
                            alt="cart">
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit">
                                <img src="{{ asset('images/icons/logout_icon.png') }}"
                                    class="mt-[5px] mx-5 cursor-pointer"
                                    alt="logout">
                            </button>
                        </form>
                    @else
                        <!-- If user is not logged in -->
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('images/icons/username_icon.png') }}"
                                class="mx-5 cursor-pointer"
                                alt="profile">
                        </a>
                        <a href="{{ route('login') }}">
                        <img src="{{ asset('images/icons/cart_icon.png') }}"
                            class="mx-5 cursor-pointer"
                            alt="cart">
                        </a>
                    @endif
                </div>
        </div>

        <!-- Bottom Accent Bar -->
        <div class="h-[5px] bg-[#A54646]"></div>
        
    </section>
    {{ $slot }}
</body>
</html>
