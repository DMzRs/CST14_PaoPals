@props(['title', 'products', 'sectionId' => ''])

<div id="{{ $sectionId }}" class="ml-[500px] scroll-mt-[180px]">
    <h2 class="text-[22px] text-[#CE5959] font-semibold mb-6">{{ $title }}</h2>

    <div class="w-[1200px] mx-auto p-5 flex flex-row items-center flex-wrap">

        @forelse ($products as $product)
            @php
                $cart = session('cart', []);
                $currentQty = $cart[$product->id]['quantity'] ?? 0;
                $availableStock = $product->stockIns()->sum('remainingStock');
            @endphp

            <div class="flex flex-col items-center justify-center rounded-2xl px-10 py-8 shadow-[1px_1px_5px_2px_gray] mr-8 mt-8">
                <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}" class="w-[200px] h-[200px] object-cover">

                <h2 class="mt-2.5 text-[20px] font-semibold">{{ $product->productName }}</h2>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button type="submit"
                        class="mt-2.5 px-3 py-1 bg-[#CE5959] rounded-full text-xs font-bold text-white"
                        {{ $currentQty >= $availableStock ? 'disabled' : '' }}>
                        ORDER
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">No products available.</p>
        @endforelse

    </div>
</div>
