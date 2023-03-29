<x-guest-layout>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('contact gegevens') }}
            </h2>
        </x-slot>

        <x-form-card>

            <form autocomplete="off" method="post"
                action="{{ route('contactGegevens.store', ['contactGegevens' => $contactGegevens->id]) }}">
                @csrf
                @method('PUT')

                <!-- algemeneInfo -->
                <div>
                    @error('telefoonnummer')
                        <div class="alert text-sm text-red-600 alert-danger mt-4">{{ $message }}</div>
                    @enderror
                    <x-label for="telefoonnummer" :value="__('telefoon nummer')" />
                    <x-input maxlength="15" id="telefoonnummer" class="block mt-2 w-full" type="text" name="telefoonnummer"
                        :value="$contactGegevens->telefoonnummer" autofocus />

                </div>
                
                <div>
                     @error('adres')
                        <div class="alert text-sm text-red-600 alert-danger mt-4">{{ $message }}</div>
                    @enderror
                    <x-label for="adres" :value="__('adres')" />
                    <x-input maxlength="255" id="adres" class="block mt-2 w-full" type="text" name="adres" :value="$contactGegevens->adres"
                        autofocus />
                </div>
                
                <div>
                     @error('email')
                        <div class="alert text-sm text-red-600 alert-danger mt-4 ">{{ $message }}</div>
                    @enderror
                    <x-label for="email" :value="__('email')" />
                    <x-input maxlength="255" id="email" class="block mt-2 w-full" type="text" name="email" :value="$contactGegevens->email"
                        autofocus />

                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('submit') }}
                    </x-button>
                </div>
            </form>
        </x-form-card>

    </x-app-layout>
</x-guest-layout>
