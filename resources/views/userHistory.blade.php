<x-navBar>

    <section class="mx-auto mt-[150px] w-[1700px] flex flex-col items-center justify-center">

        <!-- Header -->
        <div class="self-start ml-[350px]">
            <h1 class="text-[#CE5959] text-[30px] font-semibold">
                YOUR ACCOUNT
            </h1>
            <h2 class="text-[#CE5959] text-[18px] font-medium mt-1 ml-[15px]">
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

                <a href="/history"
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black bg-[#F1B9B2]">
                    Order History
                </a>
            </div>

            <!-- History Container -->
            <div class="ml-[50px] w-[1200px] px-5 py-10 border border-gray-300 rounded-2xl flex flex-col items-center">

                <h3 class="self-start ml-3 text-[#CE5959] text-xl font-semibold">
                    Your Past Orders
                </h3>

                {{-- If no orders --}}
                {{-- <h2 class="my-12 text-[#CE5959] text-2xl font-medium">
                    You do not have any saved orders.
                </h2> --}}

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
                        <tr class="border-b border-black">
                            <td class="py-2">Pork Asado Siopao</td>
                            <td class="py-2">1</td>
                            <td class="py-2">₱90.00</td>
                            <td class="py-2">2/05/2025</td>
                        </tr>

                        <tr class="border-b border-black">
                            <td class="py-2">Pork Asado Siopao</td>
                            <td class="py-2">1</td>
                            <td class="py-2">₱90.00</td>
                            <td class="py-2">2/05/2025</td>
                        </tr>

                        <tr class="border-b border-black">
                            <td class="py-2">Pork Asado Siopao</td>
                            <td class="py-2">1</td>
                            <td class="py-2">₱90.00</td>
                            <td class="py-2">2/05/2025</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</x-navBar>
