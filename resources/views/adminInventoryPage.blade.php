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
                <a href="{{ route('adminProduct.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory bg-[#F1B9B2]">Inventory</a>
                <a href="{{ route('adminFeedback.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedback">Feedbacks</a>
                <a href="{{ route('adminActivityLogs.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black logs">Activity Logs</a>
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

    <!-- Feedback Modal -->
    @if(session('success') || $errors->any())
    <div id="feedbackModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-[400px] text-center relative">
            
            <button class="absolute top-2 right-3 text-xl close-feedback">&times;</button>

            @if(session('success'))
                <h2 class="text-2xl font-bold text-green-600 mb-3">Success</h2>
                <p class="text-gray-700">{{ session('success') }}</p>
            @endif

            @if($errors->any())
                <h2 class="text-2xl font-bold text-red-600 mb-3">Error</h2>
                <ul class="text-gray-700 text-left list-none ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <button class="mt-5 px-5 py-2 bg-[#CE5959] text-white rounded close-feedback">
                OK
            </button>
        </div>
    </div>
    @endif

    <!-- Vanilla JS for Feedback Modal -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("feedbackModal");
        if(modal){
            document.querySelectorAll(".close-feedback").forEach(btn=>{
                btn.addEventListener("click", ()=>{
                    modal.style.display = "none";
                });
            });

            window.addEventListener("click", function(e){
                if(e.target === modal){
                    modal.style.display = "none";
                }
            });
        }
    });
    </script>

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

    <!-- Prevent double clicking -->
    <script>
    function disableStockBtn(form) {
        const btn = form.querySelector('#addStockBtn');
        btn.disabled = true;
        btn.innerText = "Processing...";
    }
    </script>
    <script>
    function disableProductBtn(form) {
        const btn = form.querySelector('.submit-product-btn');

        btn.disabled = true;
        btn.innerText = "Processing...";
    }
    </script>
</x-adminNavBar>
