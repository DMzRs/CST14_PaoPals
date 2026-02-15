@props([
    'modalId', 
    'formAction'
])

<div id="{{ $modalId }}" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="modal-content bg-white rounded-lg w-1/2 p-6 relative">
        <span class="close-modal-btn absolute top-3 right-3 cursor-pointer text-xl font-bold">&times;</span>

        <h2 class="text-2xl font-bold mb-4 text-[#CE5959]">Add New Product & Stock</h2>

        <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="block mb-1">Product Image:</label>
                <input type="file" name="productImage" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Product Name:</label>
                <input type="text" name="productName" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Category:</label>
                <select name="productCategory" class="w-full border p-2 rounded" required>
                    <option value="Siopao">Siopao</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Price:</label>
                <input type="number" step="0.01" name="productPrice" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Quantity:</label>
                <input type="number" name="quantity" class="w-full border p-2 rounded" min="1" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Date Arrived:</label>
                <input type="date" name="dateCreated" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block mb-1">Expiration Date:</label>
                <input type="date" name="expirationDate" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-[#CE5959] text-white px-4 py-2 rounded hover:bg-[#ff5858]">
                Add Product & Stock
            </button>
        </form>
    </div>
</div>
