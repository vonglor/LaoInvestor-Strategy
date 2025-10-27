<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Strategies
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recorded Strategies</h3>
                    <a href="{{ route('strategies.create') }}" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Add New Strategy
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider"></th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider">{{ __('Symbol') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider">{{ __('Name') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider">{{__('RR') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider">{{ __('Timeframe') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500  tracking-wider">{{ __('Date') }}</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($strategies as $str)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $i }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $str->symbol->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $str->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $str->rr }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $str->timeframe }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $str->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex justify-between">
                                    <a href="{{ route('strategies.edit', $str->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    
                                    <form action="{{ route('strategies.destroy', $str->id) }}" method="POST" onsubmit="return confirm('Are you sour to delete this strate?');">
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                            Delete
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('strategies.backtest', $str->id) }}" class="text-green-600 hover:text-green-900 ml-2">
                                        Backtest
                                    </a>
                                    
                                </td>
                            </tr>
                             @php
                                    $i++;
                                @endphp
                            @endforeach

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