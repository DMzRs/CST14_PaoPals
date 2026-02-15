<x-navBar>
    <section class="mx-auto mt-[150px] w-[1700px] flex flex-col items-center justify-center">

        <!-- Header -->
        <div class="self-start ml-[350px]">
            <h1 class="text-[#CE5959] text-[30px] font-semibold">
                YOUR ACCOUNT
            </h1>
            <h2 class="text-[#CE5959] text-[18px] font-medium mt-1 ml-[10px]">
                Order History
            </h2>
        </div>

        <!-- Main Content -->
        <div class="mt-5 w-[1700px] flex flex-row items-center">

            <!-- Tabs -->
            <div class="self-start w-[300px] flex flex-col items-center">
                <a href="/profile"
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black">
                    Account Info
                </a>

                <a href="{{ route('user.orderHistory')  }}"
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black bg-[#F1B9B2]">
                    Order History
                </a>
            </div>

            <!-- History Container -->
            <div class="ml-[50px] w-[1200px] px-5 py-10 border border-gray-300 rounded-2xl flex flex-col items-center">

                <h3 class="self-start ml-40 text-[#CE5959] text-xl font-semibold">
                    Your Past Orders
                </h3>

                @if($orders->isEmpty())
                    <h2 class="my-12 text-[#CE5959] text-2xl font-medium">
                        You do not have any saved orders.
                    </h2>
                @else
                    <!-- Table -->
                    <table class="mt-5 w-[800px] border-collapse text-center">
                        <thead>
                            <tr class="border-y border-black">
                                <th class="py-2 text-[#CE5959] font-bold">
                                    Items Ordered
                                </th>
                                <th class="py-2 text-[#CE5959] font-bold">
                                    Quantity
                                </th>
                                <th class="py-2 text-[#CE5959] font-bold">
                                    Total Price
                                </th>
                                <th class="py-2 text-[#CE5959] font-bold">
                                    Date
                                </th>
                            </tr>
                        </thead>

                        <tbody class="border border-black">
                            @foreach($orders as $order)
                                @foreach($order->orderItems as $item)
                                    <tr class="border-b border-black">
                                        <td class="py-2">{{ $item->product->productName }}</td>
                                        <td class="py-2">{{ $item->quantity }}</td>
                                        <td class="py-2">₱{{ number_format($item->quantity * $item->unitPrice, 2) }}</td>
                                        <td class="py-2">{{ \Carbon\Carbon::parse($order->orderDate)->format('m/d/Y') }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </section>
</x-navBar>
