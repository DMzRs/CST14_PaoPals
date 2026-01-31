<x-navBar>
    <section class="mt-[180px] font-[Inter]">

        <!-- Menu Options -->
        <div class="fixed ml-[200px]">
            <h1 class="text-[#CE5959] text-[30px] font-bold">
                Menu
            </h1>

            <ul class="inline-block w-[200px] h-[200px] list-none">
                <li class="my-2.5">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="#" class="no-underline text-black">All</a>
                    </h2>
                </li>
                <li class="my-2.5">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="#" class="no-underline text-black">Siopao</a>
                    </h2>
                </li>
                <li class="my-2.5">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="#" class="no-underline text-black">Drinks</a>
                    </h2>
                </li>
                <li class="my-2.5">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="#" class="no-underline text-black">Dessert</a>
                    </h2>
                </li>
            </ul>
        </div>

        <!-- Menu Products -->
        <div class="ml-[500px]">

            <h2 class="text-[22px] font-semibold mb-6">
                Siopao
            </h2>

            <div class="bg-[#FEFAF8] w-[1200px] mx-auto p-5 mt-10 flex flex-row items-center flex-wrap">

                <!-- Product Card -->
                <div class="flex flex-col items-center justify-center rounded-2xl px-10 py-8 shadow-[1px_1px_5px_2px_gray] mr-8 mt-8">
                    <img src="{{ asset('images/siopao/sample_1.png') }}"
                        alt="Siopao"
                        class="w-[200px] h-[200px]">

                    <h2 class="mt-2.5 text-[20px] font-semibold">
                        Siopao Name
                    </h2>

                    <button class="mt-2.5 px-3 py-1 bg-[#CE5959] rounded-full text-xs font-bold text-white">
                        ORDER
                    </button>
                </div>

                <!-- Repeat Product -->
                <div class="flex flex-col items-center justify-center rounded-2xl px-10 py-8 shadow-[1px_1px_5px_2px_gray] mr-8 mt-8">
                    <img src="{{ asset('images/siopao/sample_1.png') }}"
                        alt="Siopao"
                        class="w-[200px] h-[200px]">

                    <h2 class="mt-2.5 text-[20px] font-semibold">
                        Siopao Name
                    </h2>

                    <button class="mt-2.5 px-3 py-1 bg-[#CE5959] rounded-full text-xs font-bold text-white">
                        ORDER
                    </button>
                </div>

                <!-- You can loop products here in Blade later -->
            </div>
        </div>

    </section>
</x-navBar>