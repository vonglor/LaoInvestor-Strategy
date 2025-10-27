<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Strategy Log
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span>Success message placeholder.</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-500 text-sm">Win Rate</p>
                    <p class="text-2xl font-bold mt-1 text-indigo-600">
                        --.--%
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-500 text-sm">Risk of Ruin</p>
                    <p class="text-2xl font-bold mt-1 text-red-600">
                        --.--%
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-500 text-sm">Capital</p>
                    <p class="text-2xl font-bold mt-1 text-green-600">
                        $0.00
                    </p>
                </div>
                
                <div class="bg-white overflow-hidden shadow sm:rounded-lg p-4 text-center">
                    <p class="text-gray-500 text-sm">Total Trades</p>
                    <p class="text-2xl font-bold mt-1 text-blue-600">
                        0
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Recorded Strategies</h3>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Add New Strategy
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RR</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timeframe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Win/Loss</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">EMA 50 Crossover</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">H4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 / 3</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    
                                    <a href="#" class="text-green-600 hover:text-green-900 ml-2">
                                        WIN
                                    </a>
                                    
                                    <a href="#" class="text-red-600 hover:text-red-900 ml-2">
                                        LOSS
                                    </a>
                                    
                                    </td>
                            </tr>
                            
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Breakout Pattern</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">D1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1 / 0</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Win</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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