<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Bank Balance :  INR: {{ auth()->user()->balance }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Account Statement :

                    <br>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">

                                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                                        <thead>
                                            <tr class="text-center font-bold">
                                                <td class="border px-6 py-4">Type</td>
                                                <td class="border px-6 py-4">Amount</td>
                                                <td class="border px-6 py-4">Date</td>
                                            </tr>
                                        </thead>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td class="border px-6 py-4">{{$transaction->type}}</td>
                                                <td class="border px-6 py-4">{{$transaction->amount}}</td>
                                                <td class="border px-6 py-4">{{$transaction->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
