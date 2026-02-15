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
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black {{ request()->is('adminDashboard') ? 'bg-[#F1B9B2]' : '' }}">Dashboard</a>
                <a href="{{ route('adminProduct.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black {{ request()->is('adminProduct') ? 'bg-[#F1B9B2]' : '' }}">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black {{ request()->is('adminInventory') ? 'bg-[#F1B9B2]' : '' }}">Inventory</a>
                <a href="{{ route('adminFeedback.index') }}" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black {{ request()->is('adminFeedback') ? 'bg-[#F1B9B2]' : '' }}">Feedbacks</a>
            </div>

            <!-- Dashboard Content -->
            <div class="w-[1600px] ml-5 flex flex-col items-center border border-black rounded-lg">

                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">
                    Dashboard
                </h1>

                <!-- Stats -->
                <div class="w-[1180px] my-3 flex justify-evenly">
                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Revenue</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">₱{{ number_format($totalRevenue, 2) }}</h1>
                    </div>

                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Order Count</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">{{ $orderCount }}</h1>
                    </div>

                    <div class="w-[300px] h-[150px] border border-gray-400 flex flex-col justify-center items-center">
                        <h2 class="text-[20px] font-medium text-[#CE5959] m-0">Total Customers</h2>
                        <h1 class="text-[26px] font-bold text-[#CE5959] m-0">{{ $customerCount }}</h1>
                    </div>
                </div>

                <!-- Most Popular Items -->
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
                            @foreach($popularItems as $index => $item)
                                <tr>
                                    <td class="border border-black p-2 text-[#CE5959] font-light">{{ $index + 1 }}</td>
                                    <td class="border border-black p-2 text-[#CE5959] font-light">{{ $item->product->productName ?? 'Unknown' }}</td>
                                    <td class="border border-black p-2 text-[#CE5959] font-light">{{ $item->total_sold }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</x-adminNavBar>
