<x-navBar>
<!-- Main Container -->
    <section class="mx-auto mt-[150px] w-[1700px] flex flex-col items-center justify-center">

        <!-- Header -->
        <div class="self-start ml-[350px]">
            <h1 class="text-[#CE5959] text-[30px] font-semibold">
                YOUR ACCOUNT
            </h1>
            <h2 class="text-[#CE5959] text-[18px] font-medium mt-1 ml-[10px]">
                Edit your profile
            </h2>
        </div>

        <!-- Content -->
        <div class="mt-5 w-[1700px] flex flex-row items-center">

            <!-- Tabs -->
            <div class="self-start w-[300px] flex flex-col items-center">
                <a href=""
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black bg-[#F1B9B2]">
                    Account Info
                </a>

                <a href="/history"
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black">
                    Order History
                </a>
            </div>

            <!-- Profile Info -->
            <div class="ml-[50px] w-[1000px] px-5 py-10 border border-gray-300 rounded-2xl flex flex-col items-center">

                <h3 class="self-start text-[#CE5959] text-xl font-semibold">
                    Your information
                </h3>

                <form method="POST"
                      class="mt-5 w-[900px] flex flex-wrap justify-between">
                    @csrf

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            First Name
                        </label>
                        <input type="text" name="firstName"
                               value="{{ old('firstName', $customer->customerFirstName ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Last Name
                        </label>
                        <input type="text" name="lastName"
                               value="{{ old('lastName', $customer->customerLastName ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Email
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $customer->customerEmail ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Contact Number
                        </label>
                        <input type="text" inputmode="numeric" name="contactNumber"
                               value="{{ old('contactNumber', $customer->customerContactNumber ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Address
                        </label>
                        <input type="text" name="address"
                               value="{{ old('address', $customer->customerAddress ?? '') }}"
                               class="border-b border-black px-2 w-[850px] focus:outline-none">
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Current Password
                        </label>
                        <input type="password" name="currentPassword"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            New Password
                        </label>
                        <input type="password" name="newPassword"
                               class="border-b border-black px-2 focus:outline-none">
                    </div>

                    <div class="w-full flex justify-center mt-5">
                        <button type="submit"
                                class="w-[200px] py-1 rounded-full bg-[#CE5959] text-white text-lg font-semibold hover:bg-[#ff5858] transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-navBar>