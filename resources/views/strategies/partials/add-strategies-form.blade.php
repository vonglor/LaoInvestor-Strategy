<section class="">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Strategy') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('strategies.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="symbol" :value="__('Select Symbol')" />
            <x-select-input id="symbol_id" name="symbol_id" class="mt-1 block w-full" required>
                <option value="">--- Select symbol ---</option>
                @foreach ($symbols as $symbol)
                    <option value="{{ $symbol->id }}">
                        {{ $symbol->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('symbol_id')" />
        
        </div>

        <div>
            <x-input-label for="name" :value="__('Strategy name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autocomplete="strategies name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        
        </div>

         <div>
            <x-input-label for="name" :value="__('Risk-Reward Ratio (RR)')" />
            <x-text-input id="rr" name="rr" type="text" class="mt-1 block w-full" required autocomplete="RR" />
            <x-input-error class="mt-2" :messages="$errors->get('rr')" />
        
        </div>

        <div>
            <x-input-label for="name" :value="__('Timeframe')" />
            <x-text-input id="timeframe" name="timeframe" type="text" class="mt-1 block w-full" required autocomplete="timeframe" />
            <x-input-error class="mt-2" :messages="$errors->get('timeframe')" />
        
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <a href="{{ route('strategies.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Cancel</a>
           
        </div>
    </form>
</section>
