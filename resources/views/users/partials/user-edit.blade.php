<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit user') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('users.update', $users) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <x-input-label for="symbol" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" :value="old('name', $users->name)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        
        </div>

        <div>
            <x-input-label for="symbol" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" :value="old('email', $users->email)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        
        </div>

         <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-select-input id="role" name="role" class="mt-1 block w-full" required>
                @if($users->role == 'admin')
                    <option value="admin" selected>admin</option>  
                    <option value="user">user</option>  
                @else
                    <option value="admin">admin</option>  
                    <option value="user" selected>user</option>  
                @endif
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Cancel</a>
            
        </div>
    </form>
</section>
