
    <?php
                $total = $strategies->win + $strategies->loss;

                $stop_loss = ($capital['risk_per_trade']/100)*$capital['capital'];
                $winnings = $strategies->win * $strategies->rr * $stop_loss;
                $losses = $strategies->loss * $stop_loss;
                $profit = $winnings - $losses;
            ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Strategy details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') != null)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert" 
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)">
                <span>{{ session('status') }}</span>
            </div>
            @endif
            

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-800 text-sm">% Win</p>
                    <p class="text-2xl font-bold mt-1 text-indigo-600">
                        {{ format_percent($strategies->win, $total) }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-800 text-sm">% Loss</p>
                    <p class="text-2xl font-bold mt-1 text-red-600">
                        {{ format_percent($strategies->loss, $total) }}
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-800 text-sm">Capital</p>
                    <p class="text-2xl font-bold mt-1 text-green-600">
                        {{ format_currency($capital['capital']) }}
                    </p>
                </div>
                
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-800 text-sm">Risk per trade</p>
                    <p class="text-2xl font-bold mt-1 text-blue-600">
                        {{ format_risk_per_trade($capital['risk_per_trade']) }}
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    {{-- start form add time span --}}
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
                                <button type="submit" class="ninline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Save time span') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- end form add time span --}}

                    {{-- start form add capital --}}
                    <form method="POST" action="{{ route('capital.store') }}">
                        @csrf
                        @method('post')
                        <div class="flex space-x-4 mt-4 items-end">
                            <input type="hidden" id="capital_id" name="capital_id" value="{{ $capital['id'] }}">
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
                            <div class="w-1/3 flex justify-end">
                                <button type="submit" class="ninline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Save capital') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- end form add capital --}}
                </div>
                

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Symbol</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Strategy</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">RR</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Timeframe</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Win/Loss</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Total trades</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $strategies->symbol->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $strategies->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $strategies->rr }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $strategies->timeframe }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $strategies->win.' / '. $strategies->loss }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $total }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
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
                </div>
                <hr>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Winnings</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Losses</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Profit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ format_currency($winnings) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ format_currency($losses) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm
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

                <div class="mt-4 text-center text-sm text-gray-500">
                    Pagination Links Placeholder
                </div>
            </div>

        </div>
    </div>
</x-app-layout>