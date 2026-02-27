<x-adminNavBar>
    <section class="mx-auto mt-36 flex flex-col items-center w-[1700px]">

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

        <div class="mt-5 flex w-full">

            <!-- Sidebar -->
            <div class="flex flex-col justify-center items-center w-72 self-start">
                <a href="/adminDashboard" class="block w-[200px] pl-7 py-2 text-xl font-semibold border-b border-black">Dashboard</a>
                <a href="{{ route('adminProduct.index') }}" class="block w-[200px] pl-7 py-2 text-xl font-semibold border-b border-black">Products</a>
                <a href="/adminInventory" class="block w-[200px] pl-7 py-2 text-xl font-semibold border-b border-black">Inventory</a>
                <a href="{{ route('adminFeedback.index') }}" class="block w-[200px] pl-7 py-2 text-xl font-semibold border-b border-black">Feedbacks</a>
                <a href="{{ route('adminActivityLogs.index') }}" class="block w-[200px] pl-7 py-2 text-xl font-semibold border-b border-black bg-[#F1B9B2]">
                    Activity Logs
                </a>
            </div>

            <!-- Logs Container -->
            <div class="flex flex-col w-[1600px] border border-black rounded-lg ml-5 bg-gray-50">

                <!-- Title -->
                <h1 class="ml-5 mt-5 text-4xl text-[#CE5959] border-b border-gray-300 w-[1380px] font-bold">
                    Activity Logs
                </h1>

                <!-- Logs List -->
                <div class="mt-5 mb-6 px-8 h-[700px] overflow-y-auto">

                    @forelse($logs as $log)
                        <div class="bg-white rounded-xl shadow-md p-5 mb-4">

                            <!-- Top Row -->
                            <div class="flex justify-between items-center mb-3">

                                <!-- User Info -->
                                <div class="flex items-center gap-3">

                                    <!-- Avatar Placeholder -->
                                    <div class="w-10 h-10 rounded-full bg-[#CE5959] text-white flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($log->user->firstName ?? 'S', 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $log->user
                                                ? $log->user->firstName . ' ' . $log->user->lastName
                                                : 'System' }}
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($log->created_at)->format('F d, Y • h:i A') }}
                                        </p>
                                    </div>

                                </div>

                                <!-- Action Badge -->
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-[#CE5959]">
                                    {{ $log->action }}
                                </span>

                            </div>

                            <!-- Description -->
                            <p class="text-gray-700 leading-relaxed">
                                {{ $log->description }}
                            </p>

                            <!-- Optional Metadata -->
                            @if($log->module || $log->ip_address)
                                <div class="mt-3 text-xs text-gray-500 border-t pt-2">
                                    @if($log->module)
                                        Module: {{ $log->module }}
                                    @endif

                                    @if($log->ip_address)
                                        • IP: {{ $log->ip_address }}
                                    @endif
                                </div>
                            @endif

                        </div>

                    @empty
                        <div class="text-center mt-20 text-gray-500">
                            <p class="text-xl font-semibold">No activity logs yet</p>
                            <p class="text-sm">System actions will appear here</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
</x-adminNavBar>