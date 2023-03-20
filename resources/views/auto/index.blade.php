<style>
    @media (max-width: 1024px){
    .xl\:hidden{ display:none;}
    }
    @media (min-width: 1024px){
    .lg\:hidden{ display:none;}
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
                    @if($autos->isempty())
                    <div style=" text-align: center;"> er zijn geen autos 
                         @if(Request::route('merk') != "")
                            <span>
                                van
                              {{Request::route('merk')}}
                            </span>
                            @endif
                      </div>
                    @endif
                    @foreach ($autos as $auto)
                    
                        <!------ ------ large screen ------ ------>
                        <table
                            style="width: 100%; border: 1px solid black; border-radius: 20px; border-collapse: separate;  table-layout: auto;"
                            class="mt-3 xl:hidden">
                            <tr>
                                <td class="text-xl overflow:auto;" style="width:30%;">
                                    <div style="display: flex; align-items: baseline;">
                                        <div>
                                            <a style ="word-wrap:anywhere;" class="underline ml-2" href="/autos/{{ $auto->merk }}/{{ $auto->type }}/{{ $auto->id }}">
                                                {{ $auto->titel }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                        </table>

                        <!------ ------ small screen ------ ------>

                        <table
                            style="width: 100%; border: 1px solid black; border-radius: 20px; border-collapse: separate; table-layout: auto; overflow:auto;"
                            class="text-xl mt-3 lg:hidden">

                        </table>
                        
                        <!------ ------ ------ ------>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
