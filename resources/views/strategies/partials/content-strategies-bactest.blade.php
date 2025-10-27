<section>
    <header>
         <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 my-4">
            {{ __('Strategy details') }}
        </h2>

        <div class="flex items-center gap-4 py-4">
           
            {{-- <a href="{{ route('strategies.win', $strategies)}}" 
            onclick="return confirm('Are you sure you want to record a win for this strategy?');"
            class="nline-flex items-center px-4 py-2 mx-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Win
            </a>
            <a href="{{ route('strategies.loss', $strategies)}}" 
            onclick="return confirm('Are you sure you want to record a loss for this strategy?');"
            class="nline-flex items-center px-4 py-2 mx-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Loss
            </a> --}}
        </div>
        <div class="pb-4">
           <form method="POST" action="{{ route('strategies.timespan', $strategies) }}">
                @csrf
                @method('post')

                {{-- Date Start / Date End / SAVE Button (ທັງໝົດໃນແຖວດຽວ) --}}
                <div class="flex space-x-4 mt-4 items-end">
                    
                    {{-- 1. Date Start (ໃຊ້ພື້ນທີ່ 1/3) --}}
                    <div class="w-1/3"> 
                        <x-input-label for="datestart" :value="__('Date start')" />
                        <x-text-input 
                            id="datestart" 
                            name="datestart" 
                            type="date" 
                            class="mt-1 block w-full" 
                            :value="old('datestart', $strategies->datestart)" 
                            autocomplete="off"
                            required
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('datestart')" />
                    </div>

                    {{-- 2. Date End (ໃຊ້ພື້ນທີ່ 1/3) --}}
                    <div class="w-1/3">
                        <x-input-label for="dateend" :value="__('Date end')" />
                        <x-text-input 
                            id="dateend" 
                            name="dateend" 
                            type="date" 
                            class="mt-1 block w-full" 
                            :value="old('dateend', $strategies->dateend)" 
                            autocomplete="off"
                    
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('dateend')" />
                    </div>
                    
                    {{-- 3. ປຸ່ມບັນທຶກ (ໃຊ້ພື້ນທີ່ 1/3 ທີ່ເຫຼືອ, ໂດຍມີພຽງປຸ່ມດຽວ) --}}
                    <div class="w-1/3 flex justify-end">
                        <button type="submit" class="nline-flex items-center px-4 py-2 mx-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('SAVE') }}
                        </button>
                        
                    </div>
                </div>
                @if (session('status') != null)
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-green-600 dark:text-green-400"
                            >{{ session('status') }}</p>
                        @endif
            </form>
        </div>
    </header>

    <table class="max-w-full divide-y divide-gray-200 border border-gray-300">
        <thead>
            <tr>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Symbol</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Strategies</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">RR</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Timeframe</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Win</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">% Win</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Loss</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">% Loss</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Total</th>
                <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php
                $total = $strategies->win + $strategies->loss;

                $stop_loss = ($capital['risk_per_trade']/100)*$capital['capital'];
                $winnings = $strategies->win * $strategies->rr * $stop_loss;
                $losses = $strategies->loss * $stop_loss;
                $profit = $winnings - $losses;
            ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->symbol->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->rr }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->timeframe }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->win }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r text-green-600">{{ format_percent($strategies->win, $total) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $strategies->loss }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r text-red-600">{{ format_percent($strategies->loss, $total) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ ($strategies->win + $strategies->loss) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                        <a href="{{ route('strategies.win', $strategies)}}" 
                        onclick="return confirm('Are you sure you want to record a win for this strategy?');"
                        class="nline-flex items-center px-4 py-2 mx-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Win
                        </a>
                        <a href="{{ route('strategies.loss', $strategies)}}" 
                        onclick="return confirm('Are you sure you want to record a loss for this strategy?');"
                        class="nline-flex items-center px-4 py-2 mx-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Loss
                        </a>
                    </td>
                </tr>
        </tbody>
    </table>
     @if (session('backtest_status') != null)
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-green-600 dark:text-green-400"
                            >{{ session('backtest_status') }}</p>
                        @endif

    <br>
    <div class="pb-4">
        {{-- form add Capital --}}
           <form method="POST" action="{{ route('capital.store') }}">
                @csrf
                @method('post')

                {{-- Date Start / Date End / SAVE Button (ທັງໝົດໃນແຖວດຽວ) --}}
                <div class="flex space-x-4 mt-4 items-end">
                    <input type="hidden" id="capital_id" name="capital_id" value="{{ $capital['id'] }}">
                    {{-- 1. Date Start (ໃຊ້ພື້ນທີ່ 1/3) --}}
                    <div class="w-1/3"> 
                        <x-input-label for="capital" :value="__('Capital')" />
                        <x-text-input 
                            id="capital" 
                            name="capital" 
                            type="text" 
                            class="mt-1 block w-full" 
                            :value="old('capital', $capital['capital'])" 
                            autocomplete="off"
                            required
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('capital')" />
                    </div>

                    {{-- 2. Date End (ໃຊ້ພື້ນທີ່ 1/3) --}}
                    <div class="w-1/3">
                        <x-input-label for="risk_per_trade" :value="__('Risk per Trade')" />
                        <x-text-input 
                            id="risk_per_trade" 
                            name="risk_per_trade" 
                            type="text" 
                            class="mt-1 block w-full" 
                            :value="old('risk_per_trade', $capital['risk_per_trade'])" 
                            autocomplete="off"
                    
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('risk_per_trade')" />
                    </div>
                    
                    {{-- 3. ປຸ່ມບັນທຶກ (ໃຊ້ພື້ນທີ່ 1/3 ທີ່ເຫຼືອ, ໂດຍມີພຽງປຸ່ມດຽວ) --}}
                    <div class="w-1/3 flex justify-end">
                        <button type="submit" class="nline-flex items-center px-4 py-2 mx-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('SAVE') }}
                        </button>
                        
                    </div>
                </div>
                @if (session('capital_status') != null)
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-green-600 dark:text-green-400"
                            >{{ session('capital_status') }}</p>
                        @endif
            </form>
            
        </div>


        <div class="flex space-x-4 mb-4">
            <table class="max-w-full divide-y divide-gray-200 border border-gray-300 pt-4">
                <thead>
                    <tr>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Capital</th>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Risk per trade</th>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Stop Loss Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ format_currency($capital['capital']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r text-red-600">{{ format_risk_per_trade($capital['risk_per_trade']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r text-red-600">{{ format_currency($stop_loss) }}</td>
                        </tr>
                </tbody>
            </table>
            <table class="max-w-full divide-y divide-gray-200 border border-gray-300 pt-4">
                <thead>
                    <tr>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Winnings</th>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Losses</th>
                        <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900 tracking-wider border-b border-r">Profit</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ format_currency($winnings) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ format_currency($losses) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r 
                                @if($profit >= 0) 
                                    text-green-600 
                                @else 
                                    text-red-600 
                                @endif">
                                {{ format_currency($profit) }}
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>

</section>
