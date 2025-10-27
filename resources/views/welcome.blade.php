<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lao Investor</title>

    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    
</head>
<body class="antialiased bg-gray-50">

    <div class="min-h-screen flex flex-col">
        
        <header class="py-4 px-6 sm:px-12 bg-white shadow-md flex justify-between items-center">
            <div class="text-2xl font-bold text-gray-800">
                Lao Investor
            </div>
            
            <nav class="flex space-x-6 items-center">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium">{{ __('Login') }}</a>
                
                <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150">
                    {{ __('Get Started Free') }}
                </a>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
        
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>
                                    {{-- ສະແດງພາສາປັດຈຸບັນ, ຕົວຢ່າງ: ພາສາລາວ (LA) --}}
                                    {{ strtoupper(app()->getLocale()) }}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- ລິ້ງເລືອກພາສາ --}}
                            
                            {{-- ລິ້ງ: ພາສາລາວ (LA) --}}
                            <x-dropdown-link :href="route('lang.switch', ['lang' => 'lo'])">
                                🇱🇦 {{ __('Lao') }}
                            </x-dropdown-link>

                            {{-- ລິ້ງ: ພາສາອັງກິດ (EN) --}}
                            <x-dropdown-link :href="route('lang.switch', ['lang' => 'en'])">
                                🇺🇸 {{ __('English') }}
                            </x-dropdown-link>
                            
                            {{-- ທ່ານສາມາດເພີ່ມພາສາອື່ນໆທີ່ທ່ານຮອງຮັບໄດ້ທີ່ນີ້ --}}
                            
                        </x-slot>
                    </x-dropdown>
                    {{-- USER SETTINGS DROPDOWN (ວາງຕໍ່ຈາກນີ້) --}}
                    <x-dropdown align="right" width="48">
                        {{-- ... ໂຄ້ດ User Dropdown ເດີມ ... --}}
                    </x-dropdown>
                </div>
            </nav>
      
                {{-- ... ສ່ວນອື່ນໆຂອງ Navbar ... --}}
        </header>

        <main class="flex-grow flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
                
                <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                    ປ່ຽນການເທຣດຂອງທ່ານໃຫ້ເປັນທຸລະກິດ.
                </h1>
                
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    ບັນທຶກ, ວິເຄາະ, ແລະປັບປຸງ Strategies ຂອງທ່ານດ້ວຍເຄື່ອງມືທີ່ອອກແບບມາສະເພາະສໍາລັບ Trader.
                </p>

                <div class="mt-10 flex justify-center space-x-4">
                    <a href="{{ route('register') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transition duration-150">
                        {{ __('Start Your Free Account') }}
                    </a>
                </div>
            </div>
        </main>
        
        <section id="features" class="py-16 bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">{{ __('Powerful Features for Serious Traders') }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    
                    <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                        <div class="text-indigo-600 mb-3 text-3xl">📊</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Strategy Performance Tracking') }}</h3>
                        <p class="text-gray-600">ບັນທຶກທຸກ Strategy, ຕິດຕາມ Win Rate ແລະ Risk/Reward ຢ່າງຊັດເຈນ.</p>
                    </div>

                    <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                        <div class="text-red-600 mb-3 text-3xl">⚠️</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Risk Management') }}</h3>
                        <p class="text-gray-600">ຄິດໄລ່ Risk of Ruin ຕາມເງິນທຶນ ແລະ ການສ່ຽງຂອງທ່ານເພື່ອຄວາມປອດໄພ.</p>
                    </div>

                    <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                        <div class="text-green-600 mb-3 text-3xl">📝</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Quick & Easy Logging') }}</h3>
                        <p class="text-gray-600">ການບັນທຶກທີ່ວ່ອງໄວ, ບໍ່ສັບສົນ. ໃຊ້ເວລາໜ້ອຍລົງໃນການບັນທຶກ, ໃຊ້ເວລາຫຼາຍຂຶ້ນໃນການເທຣດ.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="py-6 bg-gray-800 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400 text-sm">
                &copy; {{ date('Y') }} TradingLogPro. All rights reserved.
            </div>
        </footer>

    </div>
</body>
</html>