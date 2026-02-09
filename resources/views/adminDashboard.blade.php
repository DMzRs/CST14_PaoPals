<x-adminNavBar>
    <section class="mx-auto mt-36 w-[1700px] flex flex-col items-center">

        <!-- Header -->
        <div class="self-start ml-64">
            <h1 class="text-[#CE5959] text-[30px] m-0 ml-5 font-bold">
                Hello, 
                @if(Auth::check())
                    {{ Auth::user()->firstName . ' ' . Auth::user()->lastName }} 
                @else
                    Guest
                @endif
            </h1>
        </div>

        <!-- Main Layout -->
        <div class="mt-5 flex w-full">

            <!-- Tabs -->
            <div class="flex flex-col justify-center items-center w-72 self-start">
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black dashboard bg-[#F1B9B2]">Dashboard</a>
                <a href="/adminProduct" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory">Inventory</a>
                <a href="/adminFeedback" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedbacks">Feedbacks</a>
            </div>

            <!-- Dashboard Content -->
            <div class="w-[1600px] ml-5 flex flex-col items-center border border-black rounded-lg">

                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">
                    Dashboard
                </h1>

                <!-- Stats -->
                <div class="w-[1180px] my-3 flex justify-evenly">
                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Siopao</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">₱99,999.99</h1>
                    </div>

                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Order Count</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">33,440</h1>
                    </div>

                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Total Customers</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">33,440</h1>
                    </div>
                </div>

                <!-- Most Popular -->
                <div class="w-[1000px] p-5 border border-gray-300 m-8">
                    <h1 class="text-[#CE5959] text-[28px] m-0">Most Popular Items</h1>

                    <table class="w-4/5 mx-auto my-5 border-collapse text-center">
                        <thead>
                            <tr class="bg-[#F1B9B2]">
                                <th class="border border-black p-2 text-[#CE5959] font-bold">Rank</th>
                                <th class="border border-black p-2 text-[#CE5959] font-bold">Menu Items</th>
                                <th class="border border-black p-2 text-[#CE5959] font-bold">Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-black p-2 text-[#CE5959] font-light">1</td>
                                <td class="border border-black p-2 text-[#CE5959] font-light">Pork Asado Siopao</td>
                                <td class="border border-black p-2 text-[#CE5959] font-light">120</td>
                            </tr>
                            <!-- repeat rows -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</x-adminNavBar>