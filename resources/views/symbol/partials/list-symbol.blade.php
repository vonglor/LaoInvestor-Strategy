<section>
    <header>
        <div class="flex items-center gap-4">
            <a href="{{ route('symbol.create') }}"><x-success-button>{{ __('Add Symbol') }}</x-success-button></a>
        </div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 my-4">
            {{ __('Symbol Lists') }}
        </h2>
        
    </header>
    @php
        $i = 1;
    @endphp
 @if (session('status') != null)
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                    >{{ session('status') }}</p>
            @endif
    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
    <thead>
        <tr>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">ID</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Symbol</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Date</th>
            <th class="px-6 py-5 bg-gray-50 text-sm font-bold text-gray-900  tracking-wider border-b border-r">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($symbols as $symbol)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $i }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $symbol->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">{{ $symbol->created_at->format('d/m/Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm flex justify-between font-medium text-gray-900 border-r">
                    <a href="{{ route('symbol.edit', $symbol->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>
                    <form action="{{ route('symbol.destroy', $symbol) }}" method="POST" onsubmit="return confirm('Are you sour to delete this Symbol?');">
                        @csrf 
                        @method('DELETE') 
                        <button type="submit" class="nline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Delete
                        </button>
                    </form>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </tbody>
</table>

</section>
