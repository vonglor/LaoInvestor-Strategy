<section>
    <header>
        <div class="flex items-center gap-4">
            <a href="{{ route('strategies.create') }}"><x-success-button>{{ __('Add Strategies') }}</x-success-button></a>
        </div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 my-4">
            {{ __('Strategies Lists') }}
        </h2>
        
    </header>
 @if (session('status') != null)
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                    >{{ session('status') }}</p>
            @endif
    <table class="max-w-full divide-y divide-gray-200 border border-gray-300">
    <thead>
        <tr>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r"></th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Symbol</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Strategies</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">RR</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Timeframe</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Date</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">  
            @php
                $i = 1;
            @endphp
        @foreach ($strategies as $str)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $i }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $str->symbol->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $str->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $str->rr }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $str->timeframe }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $str->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm flex justify-between font-medium text-gray-900 border-r">
                   <a href="{{ route('strategies.edit', $str->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>
                        <form action="{{ route('strategies.destroy', $str->id) }}" method="POST" onsubmit="return confirm('Are you sour to delete this strate?');">
                             @csrf 
                            @method('DELETE') 
                            <button type="submit" class="nline-flex items-center px-4 py-2 mx-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                    <a href="{{ route('strategies.backtest', $str->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Backtest</a>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </tbody>
</table>

</section>
