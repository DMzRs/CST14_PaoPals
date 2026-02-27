<x-navBar>  
    <section class="max-w-4xl mx-auto mt-32 px-4 flex flex-col items-center">

        {{-- Success Icon --}}
        <div class="mb-4">
            <img src="{{ asset('images/icons/checkLogo.png') }}" alt="success" class="w-16 h-16">
        </div>

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#CE5959] mb-2">Thank you for your purchase!</h1>
            <h2 class="text-lg font-normal text-gray-700">Your order will be arriving soon.<br> Sit tight and relax...</h2>
        </div>

        {{-- Order Summary --}}
        <div class="w-full mb-6">
            <h1 class="text-2xl font-semibold text-[#CE5959] border-b pb-2">Order Summary</h1>
        </div>

        {{-- Order Table --}}
        <div class="w-full bg-white rounded-xl shadow-md overflow-hidden mb-6">

            <table class="w-full text-sm">

                {{-- Header --}}
                <thead class="bg-[#F7D7D7] text-gray-800">
                    <tr>
                        <th class="p-4 text-left">Product</th>
                        <th class="p-4 text-center">Quantity</th>
                        <th class="p-4 text-right">Subtotal</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y">

                    @forelse ($orderItems as $item)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- Product (Image + Name) --}}
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($item['productImage']) }}"
                                        alt="product"
                                        class="w-16 h-16 rounded-lg object-cover border">

                                    <div class="font-medium text-gray-800">
                                        {{ $item['productName'] }}
                                    </div>
                                </div>
                            </td>

                            {{-- Quantity --}}
                            <td class="p-4 text-center font-medium">
                                x {{ $item['quantity'] }}
                            </td>

                            {{-- Subtotal --}}
                            <td class="p-4 text-right font-semibold text-gray-900">
                                ₱{{ number_format($item['subTotal'], 2) }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center italic text-gray-500">
                                No recent orders found.
                            </td>
                        </tr>
                    @endforelse

                    {{-- Total Row --}}
                    @if(!empty($orderItems))
                        <tr class="bg-gray-50 font-bold text-lg">
                            <td colspan="2" class="p-4 text-right">
                                Total:
                            </td>
                            <td class="p-4 text-right text-[#CE5959]">
                                ₱{{ number_format($totalCost, 2) }}
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>

        {{-- Back to Home Button --}}
        <a href="/" class="w-64 bg-[#CE5959] text-white text-center font-bold py-3 rounded hover:bg-red-500 transition">
            Back to Home
        </a>

    </section>
</x-navBar>