<x-adminNavBar>
    <section class="mx-auto mt-36 flex flex-col items-center w-[1700px]">

        <!-- Header -->
        <div class="self-start ml-64">
            <h1 class="text-[#CE5959] text-[30px] ml-5 font-bold">Hello, James Oliver Mendoza</h1>
        </div>

        <div class="mt-5 flex w-full">

            <!-- Sidebar Tabs -->
            <div class="flex flex-col justify-center items-center w-72 self-start">
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black dashboard">Dashboard</a>
                <a href="/adminProduct" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory bg-[#F1B9B2]">Inventory</a>
                <a href="/adminFeedback" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedbacks">Feedbacks</a>
            </div>

            <!-- Inventory Container -->
            <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5">

                <!-- Inventory Header -->
                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Inventory</h1>

                <!-- Add Stock Button -->
                <button class="self-end mr-12 my-5 px-5 py-2 bg-[#CE5959] text-white text-xl font-semibold rounded-lg hover:bg-[#ff5858]">
                    Add Stocks
                </button>

                <!-- Table -->
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
                            <tr>
                                <td class="py-5 pl-10 text-[#c14c4c]">Pork Asado Siopao</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">Siopao</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">1</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">2/05/2025</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">2/08/2025</td>
                            </tr>
                            <tr>
                                <td class="py-5 pl-10 text-[#c14c4c]">Pork Asado Siopao</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">Siopao</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">1</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">2/05/2025</td>
                                <td class="py-5 pl-10 text-[#c14c4c]">2/08/2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</x-adminNavBar>