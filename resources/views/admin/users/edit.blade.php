<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <!-- ID Number -->
                        <div>
                            <x-label for="id_number" value="{{ __('ID Number') }}" />
                            <x-input id="id_number" class="block mt-1 w-full" type="text" name="id_number" :value="old('id_number', $user->id_number)" required />
                            <x-input-error for="id_number" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-label for="phone" value="{{ __('Phone') }}" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $user->phone)" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" />
                            <x-input-error for="address" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div>
                            <x-label for="role" value="{{ __('Role') }}" />
                            <select id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="" disabled>Select a role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="role" class="mt-2" />
                        </div>

                        <!-- Password (Optional) -->
                        <div>
                            <x-label for="password" value="{{ __('Password (Optional)') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                            <p class="text-sm text-gray-500 mt-1">Leave blank to keep current password.</p>
                            <x-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                        <x-button class="ml-4">
                            {{ __('Update User') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
