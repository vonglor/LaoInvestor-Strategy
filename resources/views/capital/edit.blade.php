<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Capital') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-center">
                <div class="max-w-xl w-full">
                   <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit capital') }}
                            </h2>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('capital.update', $capital) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="capital" :value="__('Capital')" />
                                <x-text-input id="capital" name="capital" type="text" class="mt-1 block w-full" autocomplete="capital" :value="old('name', $capital->capital)" required/>
                                <x-input-error class="mt-2" :messages="$errors->get('capital')" />
                            
                            </div>

                            <div>
                                <x-input-label for="Risk per trade" :value="__('Risk per trade')" />
                                <x-text-input id="risk_per_trade" name="risk_per_trade" type="text" class="mt-1 block w-full" autocomplete="Risk per trade" :value="old('risk_per_trade', $capital->risk_per_trade)" />
                                <x-input-error class="mt-2" :messages="$errors->get('risk_per_trade')" />
                            
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                                <a href="{{ route('capital.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Cancel</a>
                            
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>