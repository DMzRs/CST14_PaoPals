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
        <div class="w-full rounded-lg p-4 mb-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-red-200">
                        <th class="p-4 border-b border-red-600"></th>
                        <th class="p-4 border-b border-red-600 text-center">Name</th>
                        <th class="p-4 border-b border-red-600 text-center">SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($orderItems as $item)
                        <tr class="border-b border-red-600">
                            <td class="p-4 text-center">
                                <img src="{{ asset('Images/products/' . $item['productImage']) }}" alt="picture" class="w-20 h-20 mx-auto">
                            </td>
                            <td class="p-4 text-center">{{ $item['productName'] }} x {{ $item['quantity'] }}</td>
                            <td class="p-4 text-center">₱{{ number_format($item['subTotal'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center italic text-gray-500">No recent orders found.</td>
                        </tr>
                    @endforelse

                    @if(!empty($orderItems))
                        <tr class="font-bold">
                            <td colspan="2" class="p-4 text-right">Total:</td>
                            <td class="p-4 text-center">₱{{ number_format($totalCost, 2) }}</td>
                        </tr>
                    @endif --}}
                </tbody>
            </table>
        </div>

        {{-- Back to Home Button --}}
        <a href="/" class="w-64 bg-[#CE5959] text-white text-center font-bold py-3 rounded hover:bg-red-500 transition">
            Back to Home
        </a>

    </section>
</x-navBar>