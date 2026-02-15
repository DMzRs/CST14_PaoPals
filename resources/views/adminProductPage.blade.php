<x-adminNavBar>
<section class="mx-auto mt-36 flex flex-col items-center w-[1700px]">

    <!-- Header -->
    <div class="self-start ml-64">
        <h1 class="text-[#CE5959] text-[30px] m-0 ml-5 font-bold">
            Hello, {{ Auth::check() ? Auth::user()->firstName . ' ' . Auth::user()->lastName : 'Guest' }}
        </h1>
    </div>

    <div class="mt-5 flex w-full">

        <!-- Sidebar Tabs -->
        <div class="flex flex-col justify-center items-center w-72 self-start">
            <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black dashboard">Dashboard</a>
            <a href="{{ route('adminProduct.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products bg-[#F1B9B2]">Products</a>
            <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory">Inventory</a>
            <a href="{{ route('adminFeedback.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedbacks">Feedbacks</a>
        </div>

        <!-- Main Container -->
        <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5 p-5">

            <!-- Menu Header -->
            <h1 class="self-start text-4xl text-[#CE5959] border-b border-gray-400 w-full font-bold mb-4">Menu</h1>

            <!-- Categories -->
            <div class="flex justify-start items-center w-full mb-6 gap-4">
                @foreach($categories as $cat)
                    <a href="{{ route('adminProduct.index', ['category' => $cat]) }}"
                       class="px-4 py-2 border rounded-lg font-medium {{ $category === $cat ? 'bg-[#CE5959] text-white' : 'bg-white text-black' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Products Section -->
            <div class="w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <div class="bg-white p-5 border border-gray-300 rounded-xl text-center flex flex-col items-center justify-between">
                            <!-- Product Image -->
                            <img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}" class="h-[180px] w-[180px] object-cover rounded-md mb-4">

                            <!-- Product Name -->
                            <h2 class="text-lg font-semibold mb-2">{{ $product->productName }}</h2>

                            <!-- Price and Stock -->
                            <div class="flex justify-between w-full text-sm font-light mb-2">
                                <span>₱{{ number_format($product->productPrice, 2) }}</span>
                                <span>Stocks: {{ $product->stockIns()->sum('remainingStock') }}</span>
                            </div>

                        </div>
                    @empty
                        <p class="text-gray-500 mt-5 col-span-full text-center">No products found in this category.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>
</x-adminNavBar>
