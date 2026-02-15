<x-navBar>
    <section class="mx-auto mt-[180px] w-[1400px] flex flex-col items-center">

        <!-- Header -->
        <div class="self-start">
            <h1 class="text-[#CE5959] text-[30px] flex items-center gap-2 m-0 ml-[50px]">
                Your Order Cart
                <img src="{{ asset('Images/icons/orderCart_icon.png') }}"
                     class="w-[40px] h-[35px]" alt="order-icon">
            </h1>
        </div>

        <!-- Table Header -->
        <div class="w-[1300px] mt-5 flex items-center border-y border-black">
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[75px]">Name</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[440px]">Price</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[160px]">Quantity</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[135px]">Total Price</h2>
        </div>

        @php $cart = session('cart', []); @endphp

        @forelse ($cart as $id => $item)
        <div class="w-[1300px] mt-5 flex justify-between items-center">

            <!-- Product Name -->
            <h2 class="text-[18px] font-normal m-0 w-[190px]">{{ $item['name'] }}</h2>

            <!-- Product Image -->
            <img src="{{ asset($item['image']) }}" class="w-[80px] h-[80px]" alt="{{ $item['name'] }}">

            <!-- Price -->
            <h2 class="text-[18px] font-normal m-0">₱{{ number_format($item['price'], 2) }}</h2>

            <!-- Quantity Controls -->
            <div class="flex items-center justify-evenly border border-black w-[80px] h-[30px]">

                <!-- Deduct Button -->
                <form action="{{ route('cart.decrease', $id) }}" method="POST">
                    @csrf
                    <button class="bg-white border-0 mb-[16px]">
                        <img src="{{ asset('Images/icons/deduct_icon.png') }}" alt="deduct">
                    </button>
                </form>

                <h2 class="m-0 text-[18px] quantity-display">{{ $item['quantity'] }}</h2>

                <!-- Add Button (always clickable) -->
                <form action="{{ route('cart.increase', $id) }}" method="POST" class="add-form">
                    @csrf
                    <button type="submit" class="bg-white border-0">
                        <img src="{{ asset('Images/icons/add_icon.png') }}" alt="add">
                    </button>
                </form>

            </div>

            <!-- Total Price -->
            <h2 class="text-[18px] font-normal m-0">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</h2>

            <!-- Delete Button -->
            <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                <button class="cursor-pointer bg-transparent border-0">
                    <img src="{{ asset('Images/icons/deleteOrder_icon.png') }}" alt="deleteOrder">
                </button>
            </form>

        </div>
        @empty
        <p class="mt-10 text-gray-500 text-lg">Your cart is empty.</p>
        @endforelse

        {{-- Checkout Button --}}
        @if(!empty($cart))
        <button
            onclick="openCheckoutModal()"
            class="w-64 mt-10 bg-[#CE5959] text-white font-bold py-3 rounded hover:bg-[#ff5858] transition">
            Checkout
        </button>
        @endif


        <!-- Stock Error Modal -->
        <div id="stockErrorModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg p-6 w-[400px] text-center relative">
                <button id="closeStockModal"
                        class="absolute top-2 right-3 text-2xl font-bold text-gray-600">&times;</button>
                <h2 class="text-2xl font-bold text-[#CE5959] mb-4">Out of Stock</h2>
                <p class="text-gray-700">
                    Sorry, you cannot add more of this item.<br>
                    The available stock has been reached.
                </p>
                <button id="okStockModal"
                        class="mt-6 px-5 py-2 bg-[#CE5959] text-white rounded hover:bg-[#ff5858]">
                    OK
                </button>
            </div>
        </div>

        <!-- Checkout Modal -->
        <div id="checkoutModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">

            <div class="bg-white rounded-lg p-6 w-[420px] text-center relative">

                <button onclick="closeCheckoutModal()"
                        class="absolute top-2 right-3 text-2xl font-bold text-gray-600">
                    &times;
                </button>

                <h2 class="text-2xl font-bold text-[#CE5959] mb-4">
                    Confirm Checkout
                </h2>

                <p class="text-gray-700 mb-4">
                    Please select your payment method
                </p>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <select name="paymentMethod"
                        class="border border-gray-300 rounded p-2 w-full mb-6"
                        required>
                        <option value="">Choose payment method</option>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                        <option value="GCash">GCash</option>
                        <option value="Credit/Debit Card">Credit/Debit Card</option>
                    </select>

                    <button
                        type="submit"
                        class="w-full bg-[#CE5959] text-white font-bold py-3 rounded hover:bg-[#ff5858] transition">
                        Confirm Payment
                    </button>
                </form>

            </div>
        </div>

    </section>

    <!-- Show Stock Error Modal if backend sent an error -->
    @if(session('stock_error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const errorModal = document.getElementById('stockErrorModal');
            errorModal.classList.remove('hidden');
        });
    </script>
    @endif

    <script>
        const errorModal = document.getElementById('stockErrorModal');
        const closeModalBtn = document.getElementById('closeStockModal');
        const okModalBtn = document.getElementById('okStockModal');

        function closeStockError() { errorModal.classList.add('hidden'); }

        closeModalBtn.onclick = closeStockError;
        okModalBtn.onclick = closeStockError;
        window.onclick = (e) => { if(e.target === errorModal) closeStockError(); };
    </script>

    <script>
        function openCheckoutModal() {
            document.getElementById('checkoutModal').classList.remove('hidden');
        }

        function closeCheckoutModal() {
            document.getElementById('checkoutModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('checkoutModal');
            if (e.target === modal) {
                closeCheckoutModal();
            }
        });
    </script>
</x-navBar>
