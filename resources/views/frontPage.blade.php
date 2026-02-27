<x-navBar>
    <section class="mt-[90px] flex flex-col items-center justify-center">

        <!-- Hero Section -->
        <div class="w-full flex items-center justify-center bg-[#A54646] py-3">
            <div class="w-[500px] mr-12">
                <h1 class="text-white text-center font-bold text-[22px]">
                    Freshly Steamed Siopao, Every Time!<br>
                    Order Now!
                </h1>
            </div>
            <div class="w-[170px] mr-10">
                <img src="{{ asset('images/siopao/sample_1.png') }}"
                     class="w-full h-[170px] rounded-lg" alt="Siopao">
            </div>
        </div>

        <!-- Intro Section -->
        <div class="my-8 w-full flex flex-col items-center text-center">
            <h1 class="text-[#CE5959] text-[26px] font-bold">Welcome to PaoPals</h1>
            <h3 class="text-black text-[14px] font-normal mt-2 max-w-2xl">
                PaoPals is where authentic flavors and convenience meet. Enjoy freshly steamed
                Siopao crafted with care and delivered with ease.
                <br>
                Order now for a satisfying experience!
            </h3>
        </div>

        <!-- Best Sellers Section -->
        <div class="w-[1100px] flex flex-col items-center mt-3">
            <h1 class="self-start text-[#CE5959] text-[24px] font-semibold">
                Best Sellers
            </h1>

            <div class="mt-10 w-full flex items-center justify-around flex-wrap">
                @foreach($bestSellers as $product)
                    @php
                        $cart = session('cart', []);
                        $currentQty = $cart[$product->id]['quantity'] ?? 0;
                        $availableStock = $product->stockIns()->sum('remainingStock');
                    @endphp

                    <div class="flex flex-col items-center p-5 rounded-2xl shadow-md shadow-gray-400 mr-5 mb-5">
                        <img src="{{ asset($product->productImage) }}" 
                            class="w-[200px] h-[200px] object-cover" 
                            alt="{{ $product->productName }}">
                        
                        <h2 class="mt-3 text-[20px] font-semibold w-[200px] text-center truncate">{{ $product->productName }}</h2>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <button type="submit"
                                class="mt-3 px-4 py-1 bg-[#CE5959] text-white text-[12px] font-bold rounded-full hover:bg-[#ff5858]"
                                {{ $currentQty >= $availableStock ? 'disabled opacity-50 cursor-not-allowed' : '' }}>
                                ORDER NOW
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
</x-navBar>
