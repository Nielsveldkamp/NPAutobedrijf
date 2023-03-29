<x-app-layout>
<x-search-bar></x-search-bar>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <div class="p-6">

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
                            style="width: 100%; border: 1px solid black; border-radius: 20px; border-collapse: separate;  table-layout: auto; height:197px; margin-left:auto;
                            margin-right:auto;width:58vW;"
                            class="mt-6 mb-4 xl:hidden">
                            @if(isset($auto->mainFile))
                            <tr>
                                <td rowspan="4" style="width:30%">
                                    
                                    <img style="height:96%; margin-left:3%; padding-right:4%;" src="{{ asset('storage/' . $auto->kenteken . '/' . $auto->mainFile->name) }}" alt="">
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2"style="width:30%;">
                                    <div  class="text-xl ml-2" >
                                        <div>
                                            <a style ="word-wrap:anywhere;" class="underline " href="/autos/{{ $auto->merk }}/{{ $auto->type }}/{{ $auto->id }}"
                                            >{{ $auto->titel }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ml-2">
                                    <b>Merk: </b>
                                    {{$auto->merk}}
                                    </div>
                                </td>
                                <td>
                                    <b>Model</b>
                                    {{$auto->type}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;"><b style="margin-right:2%;" class="text-xl">
                                    Prijs:  €
                                    {{$auto->vraagprijs}}
                                    </b>
                                </td>
                            </tr>
                        </table>

                        <!------ ------ small screen ------ ------>

                        <table
                            style="width: 100%; border: 1px solid black; border-radius: 20px; border-collapse: separate; table-layout: auto; overflow:auto;"
                            class="text-xl mt-3 lg:hidden bg-white">

                            @if(isset($auto->mainFile))
                            <tr>
                                <td rowspan="4" style="width:30%">
                                    
                                    <img style="height:96%; margin-left:3%; padding-right:4%;" src="{{ asset('storage/' . $auto->kenteken . '/' . $auto->mainFile->name) }}" alt="">
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2"style="width:30%;">
                                    <div  class="text-xl ml-2" >
                                        <div>
                                            <a style ="word-wrap:anywhere;" class="underline " href="/autos/{{ $auto->merk }}/{{ $auto->type }}/{{ $auto->id }}"
                                            >{{ $auto->titel }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="ml-2">
                                    <b>Merk: </b>
                                    {{$auto->merk}}
                                    </div>
                                </td>
                                <td>
                                    <b>Model</b>
                                    {{$auto->type}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: right;"><b style="margin-right:2%;" class="text-xl">
                                    Prijs:  €
                                    {{$auto->vraagprijs}}
                                    </b>
                                </td>
                            </tr>
                        </table>
                        
                        <!------ ------ ------ ------>
                    @endforeach
                        
                    </div>
                </div>
            </div>
        </div>        
        <div style="margin-right:auto;margin-left:auto; width:max-content; min-width:20%;">
            {{ $autos->withQueryString()->links() }}
</div>
</x-app-layout>
