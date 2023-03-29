<script src="{{ asset('js/fileInput.js') }}" defer></script>

<x-guest-layout>
    <x-app-layout>
        <x-form-card>

            <form autocomplete="off" method="post" action="{{ route('auto.update', $auto->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- auto -->
                <x-label class="mt-4" for="kenteken" :value="__('kenteken')" />
                <p maxlength="255" id="kenteken" class="block mt-2 w-full" >
                {{$auto->kenteken}}
                </p>
                
                @error('titel')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="titel" :value="__('titel')" />
                <x-input maxlength="255" id="titel" class="block mt-2 w-full" type="text" name="titel"
                value="{{ old('titel', $auto->titel) }}" autofocus />

                @error('vraagprijs')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="vraagprijs" :value="__('vraagprijs')" />
                <span style="margin-left:-1rem;">€</span>
                <input class="ml-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2"
                maxlength="255" id="vraagprijs" type="number" name="vraagprijs" value="{{ old('vraagprijs', $auto->vraagprijs) }}">
                
                @error('transmissie')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="transmissie" :value="__('transmissie')" />
                <x-input maxlength="255" id="transmissie" class="block mt-2 w-full" type="text" name="transmissie"
                 value="{{ old('transmissie', $auto->transmissie) }}"/>

                @error('BTW')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="titel" :value="__('BTW')" />
                <input type="radio" name="BTW" value="ja, BTW" {{(empty(old('BTW')) && $auto->BTW=="ja, BTW")?"checked" :(old('BTW') =="ja, BTW")?"checked":""}} > ja, BTW
                <input type="radio" name="BTW" value="nee, marge" class="ml-4"{{(empty(old('BTW')) && $auto->BTW=="nee, marge")?"checked" :(old('BTW') =="nee, marge")?"checked":""}}  > nee, marge 
                
                @error('websites')
                <div class="alert text-sm text-red-600 alert-danger">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="websites" :value="__('andere websites')" />
                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="220" style="resize: none; max-height: 13rem; height:3rem;" id="voorbeeld_websites"
                class="block mt-2 w-full" type="text" name="websites">@if(!empty(old('websites'))){{ old('websites')}}@elseif(!empty($auto->website)) {{implode( json_decode($auto->websites),"\n")}}@endif</textarea>

                @error('extraAccessoires')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="extraAccessoires" :value="__('Extra accessoires')" />
                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="400" style="resize: none; max-height: 300px; height:3rem;" id="omschrijving"
                    class="block mt-2 w-full" type="text" name="extraAccessoires">@if(old('extraAccessoires')){{old('extraAccessoires')}} @else {{$auto->extraAccessoires}} @endif</textarea>

                @error('omschrijving')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="omschrijving" :value="__('omschrijving')" />
                <textarea style="resize: none; max-height: 300px; height:15rem;" id="omschrijving"
                 class="block mt-2 w-full" type="text" name="omschrijving">{{ old('omschrijving', $auto->omschrijving) }}</textarea>

                @error('files.*')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="files" :value="__('afbeeldingen')" />
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
        <div>
            
            <b class="row row-cols-1 row-cols-md-4 mt-4 imageFlexHeader"  style="padding-left:2%;">
            </b>
            <div style="display: -ms-flexbox; margin:auto; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; justify-content: center;"class=" row-cols-1 row-cols-md-4 mt-4 ml-4 imageFlex">
          
            </div>
        </div>
        <b class="row row-cols-1 row-cols-md-4 mt-4"  style="padding-left:2%;">
            afbeeldingen
            </b>
            <div style="display: -ms-flexbox; margin:auto; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; justify-content: center;"class=" row-cols-1 row-cols-md-4 mt-4 ml-4 imageFlex">
          
        @foreach ($auto->files as $file)
            <div class="col mb-5">
                <div class="card">
                    <img class="img"
                        src="{{ asset('storage/' . $auto->kenteken . '/' . $file->name) }}"
                    alt="">
                    <div>
                    <form autocomplete="off" method="post"
                     action="{{ route('auto.deleteFile', [$auto->id, $file->id]) }}">
                     @csrf
                     @method('DELETE')
                        <x-button class="btn btn-danger ml-2" onclick="return confirm('weet u het?')">
                            <p class="fa fa-trash">verwijderen</p>
                        </x-button>
                    </form>
                </div>    
                </div>
                
            </div>
        @endforeach
        </div>
                        
       
    </x-app-layout>
</x-guest-layout>
