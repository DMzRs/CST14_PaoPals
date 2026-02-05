<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-['Inter']">

    <section class="fixed top-0 left-0 w-full z-[1000]">
        <div class="flex items-center justify-between py-2 bg-[#A54646]">

            <div class="ml-[200px]">
                <img src="{{ asset('images/logo/PaoPals_logo.png') }}">
            </div>

            <div class="mr-[100px]">
                <form action="{{ route('adminLogout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-[200px] px-5 py-4 text-[20px] font-bold text-white bg-[#A35C5C] rounded-[10px]
                                shadow-[0px_3px_5px_1px_rgba(13,14,15,0.322)]
                                hover:bg-[#ff5858] cursor-pointer">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </section>
    {{ $slot }}
</body>
