<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transfer Amount') }}
        </h2>
    </x-slot>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">


        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">


            <form method="POST" action="{{ route('transfer') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="Email" :value="__('Reciever Email')" />
                    <x-text-input id="Email" class="block mt-1 w-full" type="email" name="receiver_email" :value="old('receiver_email')" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('receiver_email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input id="Amount" class="block mt-1 w-full" type="text" name="amount" :value="old('amount')" required autofocus autocomplete="amount" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Transfer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
