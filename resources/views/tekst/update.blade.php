<style>
    textarea:focus {
        outline: none;
    }
</style>
<x-guest-layout>
    <x-app-layout>
        <div class="min-h-eightyPscreen flex flex-col items-center pt-6 sm:pt-0">
            <div class="pt-6"></div>
            <div class="pt-6"></div>


            <div style="height:60vh;"
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form autocomplete="off" method="post"
                    action="{{ route('tekst.store', ['tekst' => $tekst->id]) }}">
                    @csrf
                    @method('PUT')

                    <!-- algemeneInfo -->

                    <x-label for="tekst" :value="__('tekst')" />

                    <textarea maxlength="6400" autofocus style="height:45vh;" id="tekst" class="block mt-2 w-full" type="text"
                        name="tekst">{{ $tekst->tekst }}</textarea>



                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('submit') }}
                        </x-button>
                    </div>
                </form>
            </div>

        </div>

    </x-app-layout>
</x-guest-layout>
