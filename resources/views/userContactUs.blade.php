<x-navBar>
    <section class="mx-auto mt-[180px] w-[1300px] flex flex-col items-center justify-center font-[Inter]">

        <!-- Header -->
        <div class="self-start">
            <h1 class="text-[#CE5959] text-[34px] font-semibold ml-[150px]">
                Tell us your feedback!
            </h1>
        </div>

        <!-- Form + Image -->
        <div class="mx-auto h-['600px'] w-[1000px] flex flex-row items-center justify-between">

            <!-- Feedback Form -->
            <div class="w-[800px] h-[500px]">
                <form
                    class="mt-10 w-[600px] h-[400px] p-[50px] border border-gray-300 rounded-2xl
                        flex flex-col items-center justify-evenly bg-[#FEFAF8]"
                    method="POST" action="{{ route('feedback.store') }}">
                    
                    @csrf

                    <textarea name="message" rows="6" placeholder="Enter your feedback" required
                        class="w-[500px] my-2 px-3 py-2 text-lg border border-gray-300 rounded-xl resize-none"></textarea>

                    <button type="submit"
                            class="self-end px-8 py-2 bg-[#CE5959] rounded-full
                                text-white text-xl font-normal hover:bg-[#ff5858] transition">
                        Submit
                    </button>
                </form>
            </div>


            <!-- Image -->
            <div>
                <img src="{{ asset('images/Logo/chefContactUs_logo.png') }}"
                    alt="chef"
                    class="w-[400px] h-['500px']">
            </div>
        </div>

        <!-- Contact Us -->
        <div class="mt-5 w-[1200px] flex flex-col items-center justify-center mb-10">

            <h1 class="text-[40px] text-[#CE5959] font-semibold mb-2">
                Contact Us
            </h1>

            <div class="flex flex-col items-center justify-center
                        border border-gray-300 rounded-2xl p-5 w-[400px]">

                <!-- Hotline -->
                <div class="flex flex-col items-center justify-center my-2">
                    <h2 class="flex items-center gap-2 text-[30px] text-[#CE5959] font-semibold">
                        <img src="{{ asset('images/icons/hotline_icon.png') }}"
                            class="w-[22px] h-[22px]" alt="hotline">
                        Hotline
                    </h2>
                    <h3 class="text-[20px] text-[#CE5959] font-medium">
                        #8-44-44
                    </h3>
                </div>

                <!-- Email -->
                <div class="flex flex-col items-center justify-center my-2">
                    <h2 class="flex items-center gap-2 text-[30px] text-[#CE5959] font-semibold">
                        <img src="{{ asset('images/icons/email_icon.png') }}"
                            class="w-[25px] h-[25px]" alt="email">
                        Email
                    </h2>
                    <h3 class="text-[20px] text-[#CE5959] font-medium">
                        feedback@papls.com
                    </h3>
                </div>

                <!-- Address -->
                <div class="flex flex-col items-center justify-center my-2">
                    <h2 class="flex items-center gap-2 text-[30px] text-[#CE5959] font-semibold">
                        <img src="{{ asset('images/icons/address_icon.png') }}"
                            class="w-[20px] h-[20px]" alt="address">
                        Address
                    </h2>
                    <h3 class="text-[20px] text-[#CE5959] font-medium">
                        UM Matina, Davao City
                    </h3>
                </div>

            </div>
        </div>

    </section>
</x-navBar>