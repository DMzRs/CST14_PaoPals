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
                <a href="/adminProduct" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black products">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black inventory">Inventory</a>
                <a href="/adminFeedback" class="block w-[200px] pl-7 py-2 text-black text-xl font-semibold border-b border-black feedback bg-[#F1B9B2]">Feedbacks</a>
            </div>

            <!-- Feedback Container -->
            <div class="flex flex-col items-center justify-center w-[1600px] border border-black rounded-lg ml-5">

                <!-- Feedback Header -->
                <h1 class="self-start ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-400 w-[1380px] font-bold">Feedback</h1>

                <!-- Feedback Messages Box -->
                <div class="flex flex-col items-center justify-center mt-5 mb-5 p-5 w-[1200px] border border-gray-400 rounded bg-white">

                    <div class="w-full max-w-[1100px]">

                        <!-- Single Message -->
                        <div class="border border-[#CE5959] rounded p-4 mb-3 text-justify">
                            <div class="flex justify-between text-[#CE5959] font-bold text-sm mb-2">
                                <strong>From James Oleber</strong>
                                <span>2/05/2025</span>
                            </div>
                            <p class="text-[#CE5959]">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit omnis voluptas fugiat hic eaque quisquam optio. Vitae ipsum quos nobis odio, deleniti eius reiciendis harum minus, quaerat dolor ratione consectetur? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel provident id voluptatum a, sunt, incidunt expedita ullam debitis magni ipsa molestias. Numquam dolorem et doloribus culpa quia consequatur ullam sint.
                            </p>
                        </div>

                        <!-- More messages can be added here in the same format -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-adminNavBar>