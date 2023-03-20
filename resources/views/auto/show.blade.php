<style>
    @media (max-width: 1024px) {
        .xl\:hidden {
            display: none;
        }
    }

    @media (min-width: 1024px) {
        .lg\:hidden {
            display: none;
        }
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('opdracht') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white">

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!------ ------ large screen ------ ------>
                    {{ $auto }}
                    {{ $files }}
                    <table style="width: 100%; table-layout: auto;" class="mt-3 xl:hidden">
                        <tr>
                            <td>aanpassen</td>
                            
                            <form autocomplete="off" method="post"
                                        action="{{ route('auto.delete', [$auto->merk, $auto->type, $auto->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                            <p class="fa fa-trash">verwijderen</p>
                                        </x-button>
                            </form>
                        </tr>
                        <tr>
                            <td>
                                @if (isset($files[0]))
                                    <img style="padding-bottom: 20px; max-height: 200px;"
                                        src="{{ asset('storage/' . $auto->kenteken . '/' . $files[1]->id) }}">
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: baseline;">
                                    <div class="  font-semibold ml-2 mb-2 mr-0">
                                        Titel:
                                    </div>
                                    <div style="word-wrap:anywhere;" class="ml-2">
                                        {{ $auto->titel }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: baseline;">
                                    <div class="  font-semibold ml-2 mb-2 mr-0">
                                        prijs:
                                    </div>
                                    <div style="word-wrap:anywhere;" class="ml-2">
                                        {{ $auto->vraagprijs }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            {{ $auto->omschrijving }}
                        </tr>
                        <tr>
                            <td>
                                <span>merk</span>
                                <span>{{ $auto->merk }}</span>

                            </td>
                            <td>
                                <span>model</span>
                                <span>{{ $auto->merk }}</span>

                            </td>
                        </tr>

                        <tr></tr>

                        <tr></tr>

                        <tr></tr>

                        <tr></tr>

                        <tr></tr>

                        <tr></tr>

                    </table>

                    <!-- ------------------------------------------------ small screen ------------------------------------------------------------------- -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
