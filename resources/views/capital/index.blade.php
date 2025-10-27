
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Capital
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
            
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">User name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Capital</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-800  tracking-wider">Risk per trade</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($capital as $cap)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $cap->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $cap->capital }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $cap->risk_per_trade }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                       <a href="{{ route('capital.edit', $cap) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    
                                        <form action="{{ route('capital.destroy', $cap) }}" method="POST" onsubmit="return confirm('Are you sour to delete this capital?');">
                                            @csrf 
                                            @method('DELETE') 
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="mt-4 text-center text-sm text-gray-500">
                    Pagination Links Placeholder
                </div>
            </div>

        </div>
    </div>
</x-app-layout>