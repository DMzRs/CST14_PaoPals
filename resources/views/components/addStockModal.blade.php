@props([
    'modalId', 
    'formAction', 
    'products' => []
])

<div id="{{ $modalId }}" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="modal-content bg-white rounded-lg w-1/2 p-6 relative">
        <span class="close-modal-btn absolute top-3 right-3 cursor-pointer text-xl font-bold">&times;</span>

        <h2 class="text-2xl font-bold mb-4 text-[#CE5959]">Add Stock to Existing Product</h2>

        <form method="POST" action="{{ $formAction }}">
            @csrf

            <div class="mb-3">
                <label class="block mb-1">Select Product:</label>
                <select name="productId" class="w-full border p-2 rounded" required>
                    <option value="" disabled selected>-- Choose a product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->productName }} ({{ $product->productCategory }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Quantity to Add:</label>
                <input type="number" name="quantity" class="w-full border p-2 rounded" min="1" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Date Added:</label>
                <input type="date" name="dateCreated" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Expiration Date:</label>
                <input type="date" name="expirationDate" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-[#CE5959] text-white px-4 py-2 rounded hover:bg-[#ff5858]">
                Add Stock
            </button>
        </form>
    </div>
</div>
