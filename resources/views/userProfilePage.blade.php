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

                <a href="{{ route('user.orderHistory') }}"
                   class="w-[250px] pl-[30px] py-2 text-[22px] font-semibold border-b border-black">
                    Order History
                </a>
            </div>

            <!-- Profile Info -->
            <div class="ml-[50px] w-[1000px] px-5 py-10 border border-gray-300 rounded-2xl flex flex-col items-center">

                <h3 class="self-start text-[#CE5959] text-xl font-semibold ml-4">
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
                               value="{{ old('firstName', $user->firstName ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('firstName')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Last Name
                        </label>
                        <input type="text" name="lastName"
                               value="{{ old('lastName', $user->lastName ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('lastName')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Email
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('email')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Contact Number
                        </label>
                        <input type="text" inputmode="numeric" name="contactNumber"
                               value="{{ old('contactNumber', $user->contactNumber ?? '') }}"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('contactNumber')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Address
                        </label>
                        <input type="text" name="address"
                               value="{{ old('address', $user->address ?? '') }}"
                               class="border-b border-black px-2 w-[900px] focus:outline-none">
                        @error('address')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            Current Password
                        </label>
                        <input type="password" name="currentPassword"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('currentPassword')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-[40%]">
                        <label class="text-[#CE5959] text-lg font-medium my-2">
                            New Password
                        </label>
                        <input type="password" name="newPassword"
                               class="border-b border-black px-2 focus:outline-none">
                        @error('newPassword')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(session('success'))
                        <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mt-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="w-full flex justify-center mt-5">
                        <button type="submit"
                                class="w-[200px] py-1 rounded-full bg-[#CE5959] text-white text-lg font-semibold hover:bg-[#ff5858] mt-5 transition">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</x-navBar>