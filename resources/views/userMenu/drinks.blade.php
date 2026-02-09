<x-navBar>
    <section class="mt-[180px] font-[Inter]">

        <!-- Menu Options -->
         <div class="fixed ml-[200px]">
            <h1 class="text-[#CE5959] text-[30px] font-bold">
                Menu
            </h1>

            <ul class="inline-block w-[200px] h-[200px] list-none">
                <li class="">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="{{ route('menu.all') }}" class="no-underline text-black">All</a>
                    </h2>
                </li>
                <li class="">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="{{ route('menu.siopao') }}" class="no-underline text-black">Siopao</a>
                    </h2>
                </li>
                <li class="">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black bg-[#F1B9B2]">
                        <a href="{{ route('menu.drinks') }}" class="no-underline text-black">Drinks</a>
                    </h2>
                </li>
                <li class="">
                    <h2 class="text-[22px] font-bold py-2 pl-5 border-b border-black">
                        <a href="{{ route('menu.desserts') }}" class="no-underline text-black">Dessert</a>
                    </h2>
                </li>
            </ul>
        </div>

        <!-- Product Sections -->
        <x-menu-products 
            sectionId="productsSection" 
            title="Drinks" 
            :products="$products" 
        />

    </section>
</x-navBar>
