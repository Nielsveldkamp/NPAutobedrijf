<script src="{{ asset('js/fileInput.js') }}" defer></script>

<x-guest-layout>
    <x-app-layout>

        <x-form-card>

            <form autocomplete="off" method="post" action="{{ route('auto.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- auto -->
                @error('kenteken')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="kenteken" :value="__('kenteken')" />
                <x-input maxlength="255" id="kenteken" class="block mt-2 w-full" type="text" name="kenteken"
                    :value="old('kenteken')" />
                
                @error('titel')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="titel" :value="__('titel')" />
                <x-input maxlength="255" id="titel" class="block mt-2 w-full" type="text" name="titel"
                    :value="old('titel')" autofocus />

                @error('vraagprijs')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="vraagprijs" :value="__('vraagprijs')" />
                <x-input maxlength="255" id="vraagprijs" class="block mt-2 w-full" type="text" name="vraagprijs"
                    :value="old('vraagprijs')" />

                @error('transmissie')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="transmissie" :value="__('transmissie')" />
                <x-input maxlength="255" id="transmissie" class="block mt-2 w-full" type="text" name="transmissie"
                    :value="old('transmissie')"  />

                @error('BTW')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="titel" :value="__('BTW')" />
                <input type="radio" name="BTW" value="ja, BTW"                {{ (empty(old('BTW'))) ? "" :(old('BTW') =="ja, BTW")?"checked":""}} > ja, BTW
                <input type="radio" name="BTW" value="nee, marge" class="ml-4"{{ (empty(old('BTW'))) ? "" :(old('BTW') =="nee, marge")?"checked":""}}  > nee, marge 
                
                @error('websites')
                <div class="alert text-sm text-red-600 alert-danger">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="websites" :value="__('andere websites')" />

                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="220" style="resize: none; max-height: 13rem; height:3rem;" id="voorbeeld_websites"
                class="block mt-2 w-full" type="text" name="websites">{{ old('websites') }}</textarea>

                @error('extraAccessoires')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="extraAccessoires" :value="__('Extra accessoires')" />
                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="800" style="resize: none; max-height: 300px; height:3rem;" id="omschrijving"
                    class="block mt-2 w-full" type="text" name="extraAccessoires">{{ old('extraAccessoires') }}</textarea>

                @error('omschrijving')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="omschrijving" :value="__('omschrijving')" />
                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="800" style="resize: none; max-height: 300px; height:3rem;" id="omschrijving"
                    class="block mt-2 w-full" type="text" name="omschrijving">{{ old('omschrijving') }}</textarea>

                @error('files.*')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="afbeeldingen" :value="__('afbeeldingen')" />
                <div class="file-area mt-2">
                    <input id="fileInput" type="file"  onchange="loadFile(event)" name="files[]" multiple accept="image/*">
                    <div class="file-dummy">
                        <span class="default">Click to select a file, or drag it here</span>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('submit') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
        <div class="row row-cols-1 row-cols-md-4 mt-4 imageflex"  style="padding-left:2%;">
            
        </div>
    </x-app-layout>
</x-guest-layout>
