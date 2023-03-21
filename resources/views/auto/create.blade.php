<style>
    .-mb-4 {
        margin-bottom: -1rem;
    }

    .file-area {
        width: 100%;
        position: relative;
        font-size: 18px;
    }

    .file-area input[type=file] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-area .file-dummy {
        width: 100%;
        padding: 50px 30px;
        border: 2px dashed #ccc;
        background-color: #fff;
        text-align: center;
        transition: background 0.3s ease-in-out;
    }

    .file-area .file-dummy .success {
        display: none;
    }

    .file-area:hover .file-dummy {
        border: 2px dashed #1abc9c;
    }
    .img{
        height: 300px;
        width: 400px;
    }
    .imageFlex{
        width: 100%;
        display: flex;
    }
</style>
<script>
                    var loadFile = function(event) {
                        const imageFlex = document.querySelector('.imageflex');
                        imageFlex.textContent = '';
                        for (let index = 0; index < event.target.files.length; index++) {
                            const file = event.target.files[index];
                                imageDiv = document.createElement('div');
                                image = document.createElement('img');
                                imageDiv.classList.add("img");
                                imageDiv.classList.add("ml-12");
                                image.classList.add("img");
                                imageDiv.appendChild(image);
                                image.src = URL.createObjectURL(file);
                                imageFlex.appendChild(imageDiv);
                            }
                    };
                    </script>
<x-guest-layout>
    <x-app-layout>

        <x-form-card>



            <form autocomplete="off" method="post" action="{{ route('auto.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- auto -->
                @error('titel')
                    <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="titel" :value="__('titel')" />
                <x-input maxlength="255" id="titel" class="block mt-2 w-full" type="text" name="titel"
                    :value="old('titel')" autofocus />


                @error('kenteken')
                    <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="kenteken" :value="__('kenteken')" />
                <x-input maxlength="255" id="kenteken" class="block mt-2 w-full" type="text" name="kenteken"
                    :value="old('kenteken')" />
                
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
                <input type="radio" name="BTW" value="ja, BTW" > ja, BTW
                <input type="radio" name="BTW" value="nee, marge" class="ml-4"> nee, marge

                @error('omschrijving')
                <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="omschrijving" :value="__('omschrijving')" />
                <textarea oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' maxlength="800" style="resize: none; max-height: 300px; height:3rem;" id="omschrijving"
                    class="block mt-2 w-full" type="text" name="omschrijving">{{ old('omschrijving') }}</textarea>

                @error('files.*')
                    <div class="alert text-sm text-red-600 alert-danger mt-4 -mb-4">{{ $message }}</div>
                @enderror
                <x-label class="mt-4" for="website" :value="__('afbeeldingen')" />
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
        <div class="imageflex mt-4 mb-4 ">
        </div>
    </x-app-layout>
</x-guest-layout>
