<x-navBar>
    <section class="mx-auto mt-[180px] w-[1400px] flex flex-col items-center">

        <!-- Header -->
        <div class="self-start">
            <h1 class="text-[#CE5959] text-[30px] flex items-center gap-2 m-0 ml-[50px]">
                Your Order Cart
                <img src="../Images/icons/orderCart_icon.png" class="w-[40px] h-[35px]" alt="order-icon">
            </h1>
        </div>

        <!-- Table Header -->
        <div class="w-[1300px] mt-5 flex items-center border-y border-black">
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[75px]">Name</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[440px]">Price</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[160px]">Quantity</h2>
            <h2 class="text-[#CE5959] text-[20px] p-2 ml-[135px]">Total Price</h2>
        </div>

        <!-- Order Row -->
        <div class="w-[1300px] mt-5 flex justify-between items-center">
            <h2 class="text-[18px] font-normal m-0 w-[190px]">Sample Product Name</h2>

            <img src="../Images/Siopao/sample_1.png" class="w-[80px] h-[80px]" alt="sampleOrder">

            <h2 class="text-[18px] font-normal m-0">₱90.00</h2>

            <div class="flex items-center justify-evenly border border-black w-[100px]">
                <button class="bg-white border-0">
                    <img src="../Images/icons/deduct_icon.png" alt="deduct">
                </button>
                <h2 class="m-0 text-[18px]">1</h2>
                <button class="bg-white border-0">
                    <img src="../Images/icons/add_icon.png" alt="add">
                </button>
            </div>

            <h2 class="text-[18px] font-normal m-0">₱90.00</h2>

            <img src="../Images/icons/deleteOrder_icon.png" class="cursor-pointer" alt="deleteOrder">
        </div>

    </section>
</x-navBar>