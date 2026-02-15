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
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black">Dashboard</a>
                <a href="{{ route('adminProduct.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black bg-[#F1B9B2]">Inventory</a>
                <a href="{{ route('adminFeedback.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black">Feedbacks</a>
            </div>

            <!-- Inventory Container -->
            <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5">

                <!-- Stock In Section -->
                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Stock In</h1>

                <!-- Buttons for Adding Stock and Product -->
                <div class="self-end mr-12 my-5 flex gap-4">
                    <!-- Add Stock Button -->
                    <button 
                        class="px-5 py-2 bg-[#CE5959] text-white text-l font-semibold rounded-lg hover:bg-[#ff5858] open-modal-btn"
                        data-modal="addStockModal">
                        Add Stock
                    </button>

                    <!-- Add Product Button -->
                    <button 
                        class="px-5 py-2 bg-[#CE5959] text-white text-l font-semibold rounded-lg hover:bg-[#ff5858] open-modal-btn"
                        data-modal="addProductModal">
                        Add Product
                    </button>
                </div>

                <!-- Stock In Table -->
                <div class="w-4/5 p-2 mb-10 rounded-lg overflow-x-auto">
                    <table class="w-full border-collapse table-fixed text-center">
                        <thead>
                            <tr class="border-b border-[#CE5959]">
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Name</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Category</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Quantity</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Date Arrived</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockIns as $stock)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2">{{ $stock->product->productName }}</td>
                                    <td class="py-2">{{ $stock->product->productCategory }}</td>
                                    <td class="py-2">{{ $stock->quantity }}</td>
                                    <td class="py-2">{{ $stock->dateCreated->format('Y-m-d') }}</td>
                                    <td class="py-2">{{ \Carbon\Carbon::parse($stock->expirationDate)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Stock Out Section -->
                <h1 class="self-start ml-5 mt-10 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Stock Out</h1>

                <div class="w-4/5 p-2 mb-10 rounded-lg overflow-x-auto">
                    <table class="w-full border-collapse table-fixed text-center">
                        <thead>
                            <tr class="border-b border-[#CE5959]">
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Name</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Category</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Quantity Used</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Date Used</th>
                                <th class="w-1/5 py-3 text-[#c14c4c] font-bold">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockOuts as $out)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2">{{ $out->stockin->product->productName }}</td>
                                    <td class="py-2">{{ $out->stockin->product->productCategory }}</td>
                                    <td class="py-2">{{ $out->quantity }}</td>
                                    <td class="py-2">{{ $out->dateUsed->format('Y-m-d H:i') }}</td>
                                    <td class="py-2">{{ $out->cause }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <!-- Add Product Modal Component -->
    <x-addProductModal 
        modal-id="addProductModal" 
        form-action="{{ route('inventory.storeProduct') }}" 
    />

    <!-- Add Stock Modal Component -->
    <x-addStockModal 
        modal-id="addStockModal" 
        form-action="{{ route('inventory.storeStock') }}" 
        :products="$products" 
    />

    <!-- Vanilla JS for Opening/Closing Modals -->
    <script>
        document.querySelectorAll('.open-modal-btn').forEach(btn => {
            const modalId = btn.dataset.modal;
            const modal = document.getElementById(modalId);
            const closeBtn = modal.querySelector('.close-modal-btn');

            btn.addEventListener('click', () => modal.classList.remove('hidden'));
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            window.addEventListener('click', e => { if(e.target === modal) modal.classList.add('hidden'); });
        });
    </script>
</x-adminNavBar>
