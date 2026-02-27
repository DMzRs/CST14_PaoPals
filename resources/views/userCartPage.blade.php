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
        <div class="cart-row w-[1300px] mt-5 flex justify-between items-center"
             data-id="{{ $id }}"
             data-price="{{ $item['price'] }}">

            <h2 class="text-[18px] w-[190px]">{{ $item['name'] }}</h2>

            <img src="{{ asset($item['image']) }}" class="w-[80px] h-[80px]">

            <h2>₱{{ number_format($item['price'], 2) }}</h2>

            <div class="flex items-center border border-black w-[100px] h-[30px] justify-between px-2">
                <button type="button" class="decrease-btn"><img src="{{ asset('images/icons/deduct_icon.png') }}" class="w-[12px]" alt="decrease"></button>
                <span class="quantity-display">{{ $item['quantity'] }}</span>
                <button type="button" class="increase-btn"><img src="{{ asset('images/icons/add_icon.png') }}" class="w-[12px] h-[12px] mb-[2px]" alt="increase"></button>
            </div>

            <h2 class="item-total">
                ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
            </h2>

            <button type="button" class="remove-btn text-red-600">
                <img src="{{ asset('images/icons/deleteOrder_icon.png') }}"
                     class="w-[10px] h-[10px]" alt="remove">
            </button>
        </div>

    @empty
    @endforelse

    <div id="emptyCartMessage"
        class="mt-10 text-gray-500 text-lg {{ empty($cart) ? '' : 'hidden' }}">
        Your cart is empty.
    </div>


    {{-- Checkout Button --}}
    @if(!empty($cart))
    <button
        id="checkoutBtn"
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
            <h2 class="text-2xl font-bold text-[#CE5959] mb-4">Stock Limit Reached</h2>
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


<!-- AJAX Cart Controls -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll(".increase-btn").forEach(btn => {
        btn.addEventListener("click", function() {

            const row = this.closest(".cart-row");
            const id = row.dataset.id;

            fetch(`/cart/increase/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {

                if (data.error) {
                    showStockError(data.error);
                    return;
                }

                row.querySelector(".quantity-display").textContent = data.quantity;
                row.querySelector(".item-total").textContent =
                    "₱" + parseFloat(data.itemTotal).toFixed(2);
            });
        });
    });

    document.querySelectorAll(".decrease-btn").forEach(btn => {
        btn.addEventListener("click", function() {

            const row = this.closest(".cart-row");
            const id = row.dataset.id;

            fetch(`/cart/decrease/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.removed) {
                    row.remove();

                    // Check if no items left
                    if (document.querySelectorAll(".cart-row").length === 0) {
                        const checkoutBtn = document.getElementById("checkoutBtn");
                        if (checkoutBtn) checkoutBtn.style.display = "none";

                        document.getElementById("emptyCartMessage").classList.remove("hidden");
                    }

                    return;
                }

                row.querySelector(".quantity-display").textContent = data.quantity;
                row.querySelector(".item-total").textContent =
                    "₱" + parseFloat(data.itemTotal).toFixed(2);
            });
        });
    });

    document.querySelectorAll(".remove-btn").forEach(btn => {
        btn.addEventListener("click", function() {

            const row = this.closest(".cart-row");
            const id = row.dataset.id;

            fetch(`/cart/remove/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(() => {
                row.remove();
                // Hide checkout if cart empty
               if (document.querySelectorAll(".cart-row").length === 0) {
                    const checkoutBtn = document.getElementById("checkoutBtn");
                    if (checkoutBtn) checkoutBtn.style.display = "none";

                    document.getElementById("emptyCartMessage").classList.remove("hidden");
                }
            });
        });
    });

});
</script>


<script>
function openCheckoutModal() {
    document.getElementById('checkoutModal').classList.remove('hidden');
}

function closeCheckoutModal() {
    document.getElementById('checkoutModal').classList.add('hidden');
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('checkoutModal');
    if (e.target === modal) closeCheckoutModal();
});

function showStockError(message) {
    const modal = document.getElementById("stockErrorModal");
    modal.querySelector("p").textContent = message;
    modal.classList.remove("hidden");
}
</script>

</x-navBar>