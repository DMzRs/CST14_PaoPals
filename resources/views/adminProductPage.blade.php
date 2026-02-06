<x-adminNavBar>
    <section class="mx-auto mt-36 flex flex-col items-center w-[1700px]">

        <!-- Header -->
        <div class="self-start ml-64">
            <h1 class="text-[#CE5959] text-[30px] m-0 ml-5 font-bold">
                Hello, 
                @if(Auth::guard('admin')->check())
                    {{ Auth::guard('admin')->user()->name }}
                @elseif(Auth::check())
                    {{ Auth::user()->name }}
                @else
                    Guest
                @endif
            </h1>
        </div>

        <div class="mt-5 flex w-full">

            <!-- Sidebar Tabs -->
            <div class="flex flex-col justify-center items-center w-72 self-start">
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black dashboard">Dashboard</a>
                <a href="/adminProduct" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products bg-[#F1B9B2]">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory">Inventory</a>
                <a href="/adminFeedback" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedbacks">Feedbacks</a>
            </div>

            <!-- Menu Container -->
            <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5">

                <!-- Menu Header -->
                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Menu</h1>
                <h3 class="self-start ml-5 mt-2 text-3xl text-[#CE5959] font-semibold">Category</h3>

                <!-- Categories -->
                <div class="flex justify-evenly items-center w-[800px] my-2">
                    <div class="flex flex-col items-center justify-center w-[140px] h-[150px] border border-gray-600 rounded-xl">
                        <img src="{{ asset('images/siopao/sample_1.png') }}" alt="siopao" class="w-[100px] h-[100px] mb-2 rounded-md">
                        <h2 class="text-[#CE5959] font-medium text-lg">Siopao</h2>
                    </div>
                    <div class="flex flex-col items-center justify-center w-[140px] h-[150px] border border-gray-600 rounded-xl">
                        <img src="{{ asset('images/drinks/drink1.png') }}" alt="drink" class="w-[100px] h-[100px] mb-2 rounded-md">
                        <h2 class="text-[#CE5959] font-medium text-lg">Drinks</h2>
                    </div>
                    <div class="flex flex-col items-center justify-center w-[140px] h-[150px] border border-gray-600 rounded-xl">
                        <img src="{{ asset('images/desserts/dessert1.png') }}" alt="dessert" class="w-[100px] h-[100px] mb-2 rounded-md">
                        <h2 class="text-[#CE5959] font-medium text-lg">Desserts</h2>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="w-[1300px] border border-black rounded-lg my-2">
                    <h1 class="text-center text-[#CE5959] text-2xl my-5">Siopao</h1>
                    <div class="flex flex-wrap justify-evenly items-center my-5">

                        <!-- Single Item -->
                        <div class="flex-1 min-w-[20%] bg-white p-5 m-2 border border-gray-300 rounded-xl text-center">
                            <img src="../Images/Siopao/sample_1.png" alt="siopao" class="h-[150px] w-[170px] mx-auto">
                            <h2 class="text-base font-normal mt-2">Siopao</h2>
                            <div class="flex justify-between mt-2 text-sm font-light">
                                <h2>₱90.00</h2>
                                <h2>Stocks: 99</h2>
                            </div>
                        </div>

                        <!-- Duplicate items for multiple products as needed -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-adminNavBar>