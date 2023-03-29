<style>

    .row{
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: 0px !important;
    margin-left: 0px !important;
    justify-content: center;
    }
    .card{
        height:100%;
    }
    .col{
        height: 191px;
    }
    .img{
        height: 191px;
    }
    
</style>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!------ ------ large screen ------ ------>

                    <table style="width: 95%; table-layout: auto;" class="mt-3 ml-12 xl:hidden">
                        <tr>
                            @auth
                            <td  style=" width: 80%;">
                                <a  style="float:right;" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn mr-2"
                                href="{{route('auto.change', $auto)}}" class="btn mr-2">
                                    <p class="fa fa-trash">aanpassen</p>
                                </a>
                            </td>
                            
                            <td>
                                <form style="margin-block-end: 0em;" autocomplete="off" method="post"
                                            action="{{ route('auto.delete', [$auto->merk, $auto->type, $auto->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-button class="btn btn-danger ml-2" onclick="return confirm('weet u het zeker?')">
                                                <p class="fa fa-trash">verwijderen</p>
                                            </x-button>
                                </form>
                            
                            </td>
                            
                            @endauth
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if (isset($auto->mainFile))
                                    <img style="padding-bottom: 20px; max-height: 400px; min-width: 40vw; margin: auto;"
                                        src="{{ asset('storage/' . $auto->kenteken . '/' . $auto->mainFile->name) }}">
                            </td>
                            @endif
                        </tr>
                        <tr style="font-size: 2em;">
                            <td style="max-width:85%; width:100%;">
                                <div style="display: flex; align-items: baseline;">
                                    
                                    <b style="word-wrap:anywhere;">
                                        {{ $auto->titel }}
                                    </b>
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: baseline;">
                                    
                                    <b >
                                        € {{ $auto->vraagprijs }}
                                    </b>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$auto->omschrijving}}
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <table style="width: 100%; table-layout: auto;" class="mt-3 xl:hidden">
                                
                                    <tr style="font-size: 1.2em;">
                                        <td>
                                            <b class=" flc mb-2">
                                                prijs:
                                            </b>
                                        </td>
                                        <td>
                                            <span >
                                                € {{ $auto->vraagprijs }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">merk</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->merk }}</span>

                                        </td>
                                        <td>
                                            <b class="flc">model</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->type }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">brandstof</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->brandstof }}</span>
                                        </td>
                                        <td>
                                            <b class="flc">aantal zitplaatsen</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->stoelen }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">bouwjaar</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->bouwjaar}}</span>
                                        </td>
                                        <td>
                                            <b class="flc">aantal deuren</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->deuren}}-deurs</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">kenteken</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->kenteken }}</span>
                                        </td>
                                        <td>
                                            <b class="flc">kleur</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->kleur }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">transmissie</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->transmissie }}</span>
                                        </td>
                                        <td>
                                            <b class="flc">verbruik</b>
                                        </td>
                                        <td>
                                            @if($auto->verbruik==0)
                                            <span>-</span>
                                            @else
                                            <span>	(±) 1 op &nbsp{{ round(100/$auto->verbruik,0) }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>BTW auto</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->BTW }}</span>
                                        </td>
                                        <td>
                                            <b class="flc">cilinderinhoud</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->cilinderinhoud }} cc</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>APK</b>
                                        </td>
                                        <td>
                                            <span class="flc">
                                            @if(date("Y-m-d")<$auto->apkVervaldatum)ja, tot @else nee, vervallen vanaf @endif {{$auto->apkVervaldatum}}</span>
                                        </td>
                                        <td>
                                            <b class="flc">carrosserie</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->carrosserie }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">gewicht</b>
                                        </td>
                                        <td>
                                            <span>{{$auto->gewicht}} kg</span>
                                        </td>
                                        <td>
                                            <b class="flc">energielabel</b>
                                        </td>
                                        <td>
                                            <span  class="flc nrg-{{ strtolower($auto->zuinigHeidsLabel)}}">
                                                <span class="text">
                                                {{ $auto->zuinigHeidsLabel}}
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(!empty($auto->netMaxVermogen))
                                        <td>
                                            <b class="flc">vermogen</b>
                                        </td>
                                        <td>
                                            <span>{{$auto->netMaxVermogen}} Kw ({{floor($auto->netMaxVermogen*1.35962)}} pk)</span>
                                        </td>
                                        @endif
                                        @if(!empty($auto->netMaxVermogenElektrisch))
                                        <td>
                                            <b class="flc">vermogen elektrisch</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->netMaxVermogenElektrisch}} Kw ({{floor($auto->netMaxVermogenElektrisch*1.35962)}} pk)</span>
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @if( $auto->extraAccessoires)
                        <tr>
                            <td>
                                <b>
                                    Extra accessoires
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$auto->extraAccessoires}}
                            </td>
                        </tr>
                        @endif
                        @if($auto->websites)
                        <tr>
                            <td>
                                <b>
                                    Andere website:
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @foreach(json_decode($auto->websites) as $website)
                                <a class="mr-4" href="{{$website}}">{{$website}}</a>
                                @endforeach
                            </td>
                        </tr>
                        @endif
                    </table>

                    <div class="row row-cols-1 row-cols-md-4 mt-8">
                        @foreach ($auto->files as $file)
                        @if($file !=$auto->files[0])
                            <div class="col ">
                                <div class="card">
                                    <img class="img"
                                        src="{{ asset('storage/' . $auto->kenteken . '/' . $file->name) }}"
                                    alt="">
                                </div>
                            </div>
                        
                        @endif
                        @endforeach
                    </div>
                    
                    <!-- ------------------------------------------------ small screen ------------------------------------------------------------------- -->
                    
                    <table style="width: 95%; table-layout: auto; margin:auto;" class="mt-3 lg:hidden">
                        <tr>
                            @auth
                            <td  style=" width: 10%;">
                                <table>
                                    <tr>
                                        <td>
                                            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn mr-2"
                                            href="{{route('auto.change', $auto)}}" class="btn mr-2">
                                            <p class="fa fa-trash">aanpassen</p>
                                            </a>
                                        </td>
                                        <td>
                                            <form style="margin-block-end: 0em;" autocomplete="off" method="post"
                                                        action="{{ route('auto.delete', [$auto->merk, $auto->type, $auto->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button class="btn btn-danger ml-2" onclick="return confirm('weet u het zeker?')">
                                                            <p class="fa fa-trash">verwijderen</p>
                                                        </x-button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            
                            @endauth
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if (isset($auto->mainFile))
                                    <img style="padding-bottom: 20px; max-height: 400px; min-width: 40vw; margin: auto;"
                                        src="{{ asset('storage/' . $auto->kenteken . '/' . $auto->mainFile->name) }}">
                            </td>
                            @endif
                        </tr>
                        <tr style="font-size: 2em;">
                            <td style="max-width:85%; width:100%;">
                                <div style="display: flex; align-items: baseline;">
                                    
                                    <b style="word-wrap:anywhere;">
                                        {{ $auto->titel }}
                                    </b>
                                </div>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: baseline;"> 
                                    <b >
                                        € {{ $auto->vraagprijs }}
                                    </b>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$auto->omschrijving}}
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <table style="width: 100%; table-layout: auto;" class="mt-3 lg:hidden">
                                
                                    <tr style="font-size: 1.2em;">
                                        <td>
                                            <b class=" flc mb-2">
                                                prijs:
                                            </b>
                                        </td>
                                        <td>
                                            <span >
                                                € {{ $auto->vraagprijs }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">merk</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->merk }}</span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">model</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->type }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">brandstof</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->brandstof }}</span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">aantal zitplaatsen</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->stoelen }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">bouwjaar</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->bouwjaar}}</span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">aantal deuren</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->deuren}}-deurs</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">kenteken</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->kenteken }}</span>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <b class="flc">kleur</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->kleur }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">transmissie</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->transmissie }}</span>
                                        </td> 
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <b class="flc">verbruik</b>
                                        </td>
                                        <td>
                                            @if($auto->verbruik==0)
                                            <span>-</span>
                                            @else
                                            <span>	(±) 1 op &nbsp{{ round(100/$auto->verbruik,0) }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>BTW auto</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->BTW }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">cilinderinhoud</b>
                                        </td>
                                        <td>
                                            <span>{{ $auto->cilinderinhoud }} cc</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>APK</b>
                                        </td>
                                        <td>
                                            <span class="flc">
                                            @if(date("Y-m-d")<$auto->apkVervaldatum)ja, tot @else nee, vervallen vanaf @endif {{$auto->apkVervaldatum}}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">carrosserie</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->carrosserie }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">gewicht</b>
                                        </td>
                                        <td>
                                            <span>{{$auto->gewicht}} kg</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b class="flc">energielabel</b>
                                        </td>
                                        <td>
                                            <span  class="flc nrg-{{ strtolower($auto->zuinigHeidsLabel)}}">
                                                <span class="text">
                                                {{ $auto->zuinigHeidsLabel}}
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(!empty($auto->netMaxVermogen))
                                        <td>
                                            <b class="flc">vermogen</b>
                                        </td>
                                        <td>
                                            <span>{{$auto->netMaxVermogen}} Kw ({{floor($auto->netMaxVermogen*1.35962)}} pk)</span>
                                        </td>
                                    </tr>

                                        @endif
                                        @if(!empty($auto->netMaxVermogenElektrisch))
                                    <tr>
                                        <td>
                                            <b class="flc">vermogen elektrisch</b>
                                        </td>
                                        <td>
                                            <span class="flc">{{ $auto->netMaxVermogenElektrisch}} Kw ({{floor($auto->netMaxVermogenElektrisch*1.35962)}} pk)</span>
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @if( $auto->extraAccessoires)
                        <tr>
                            <td>
                                <b>
                                    Extra accessoires
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{$auto->extraAccessoires}}
                            </td>
                        </tr>
                        @endif
                        @if($auto->websites)
                        <tr>
                            <td>
                                <b>
                                    Andere website:
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @foreach(json_decode($auto->websites) as $website)
                                <a class="mr-4" href="{{$website}}">{{$website}}</a>
                                @endforeach
                            </td>
                        </tr>
                        @endif
                    </table>

                    <div class="row row-cols-1 row-cols-md-4 mt-8">
                        @foreach ($auto->files as $file)
                        @if($file !=$auto->files[0])
                            <div class="col ">
                                <div class="card">
                                    <img class="img"
                                        src="{{ asset('storage/' . $auto->kenteken . '/' . $file->name) }}"
                                    alt="">
                                </div>
                            </div>
                        
                        @endif
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
