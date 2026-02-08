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
                <a href="/adminProduct" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black bg-[#F1B9B2]">Inventory</a>
                <a href="/adminFeedback" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black">Feedbacks</a>
            </div>

            <!-- Inventory Container -->
            <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5">

                <!-- Inventory Header -->
                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Inventory</h1>

                <!-- Add Stock Button -->
                <button 
                    class="self-end mr-12 my-5 px-5 py-2 bg-[#CE5959] text-white text-xl font-semibold rounded-lg hover:bg-[#ff5858] open-modal-btn"
                    data-modal="addStocksModal">
                    Add Stocks
                </button>

                <!-- Inventory Table -->
                <div class="w-4/5 p-2 mb-5 rounded-lg">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr>
                                <th class="py-5 pl-10 text-[#c14c4c] border-t border-b border-[#CE5959] font-bold">Name</th>
                                <th class="py-5 pl-10 text-[#c14c4c] border-t border-b border-[#CE5959] font-bold">Category</th>
                                <th class="py-5 pl-10 text-[#c14c4c] border-t border-b border-[#CE5959] font-bold">Quantity</th>
                                <th class="py-5 pl-10 text-[#c14c4c] border-t border-b border-[#CE5959] font-bold">Date Arrived</th>
                                <th class="py-5 pl-10 text-[#c14c4c] border-t border-b border-[#CE5959] font-bold">Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody class="border-b border-[#CE5959]">
                            @foreach($stockIns as $stock)
                                <tr>
                                    <td class="py-5 pl-10 text-[#c14c4c]">{{ $stock->product->productName }}</td>
                                    <td class="py-5 pl-10 text-[#c14c4c]">{{ $stock->product->productCategory }}</td>
                                    <td class="py-5 pl-10 text-[#c14c4c]">{{ $stock->quantity }}</td>
                                    <td class="py-5 pl-10 text-[#c14c4c]">{{ $stock->dateCreated->format('Y-m-d') }}</td>
                                    <td class="py-5 pl-10 text-[#c14c4c]">{{ $stock->expirationDate }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <!-- Include Add Stock Modal Component -->
    <x-add-stock-modal modal-id="addStocksModal" form-action="{{ route('inventory.store') }}" />

    <!-- Vanilla JS for Modal -->
    <script>
        document.querySelectorAll('.open-modal-btn').forEach(btn => {
            const modalId = btn.dataset.modal;
            const modal = document.getElementById(modalId);
            const closeBtn = modal.querySelector('.close-modal-btn');

            btn.addEventListener('click', () => modal.classList.remove('hidden'));
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

            window.addEventListener('click', e => {
                if (e.target === modal) modal.classList.add('hidden');
            });
        });
    </script>

</x-adminNavBar>
