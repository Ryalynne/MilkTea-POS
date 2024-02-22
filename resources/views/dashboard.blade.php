<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="bg-violet-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <a
                        href="{{ route('Sales_Report', [
                            'start_date' => now()->format('Y-m-d'),
                            'end_date' => now()->format('Y-m-d'),
                        ]) }}">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white">Total Sales</h3>
                            <p class="text-3xl font-bold text-white">₱{{ number_format($totalSales, 2) }}</p>
                        </div>
                    </a>
                </div>
                <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <a
                        href="{{ route('Sales_Report', [
                            'start_date' => now()->format('Y-m-d'),
                            'end_date' => now()->format('Y-m-d'),
                        ]) }}">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white">Total Profit</h3>
                            <p class="text-3xl font-bold text-white">₱{{ number_format($totalIncome, 2) }}</p>
                        </div>
                    </a>
                </div>
                <div class="bg-red-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="/Ingredients-Volume">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white">Item need to Reorder</h3>
                            <p class="text-3xl font-bold text-white">{{ number_format($itemsToReorder) }}</p>
                        </div>
                    </a>
                </div>
                <div class="bg-blue-300 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white">Users</h3>
                        <p class="text-3xl font-bold text-white">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
