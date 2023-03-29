@push('head')
<script src="{{ asset('/js/searchbar.js') }}" defer></script>
@endpush
<div class="bg-gray-800 w-full xl:hidden">

    <form action="{{ route('auto.search') }}">
    @csrf
    <table class="searchBarT">

        <tr>
            <td>
                <select name="merk" id="merk" >
                <option class="" value="">merk</option>
                    @foreach($types as $merknaam => $merk)
                    <option value="{{$merknaam}}" @isset($_REQUEST['merk'])  @if($_REQUEST['merk']==$merknaam) selected @endif @endisset>{{$merknaam}}</option>
                    @endforeach
                </select>
                
            </td>
            <td>
                <select name="type" id="type">
                <option class="" value="">model</option>
                    @foreach($types as $merknaam => $autos)
                        @foreach($autos as $auto)
                        <option class="{{$merknaam}}" value="{{$auto->type}}"  @isset($_REQUEST['type']) @if($_REQUEST['type']==$auto->type) selected @endif @endisset >{{$auto->type}}</option>
                        @endforeach
                    @endforeach
                </select>
            </td>
            <td style="min-width:223px;"><span class="text-white"> prijs:</span> <span>
                <input type="number" name="vanaf" id="vanaf" placeholder="vanaf" 
                value=@if(isset($_REQUEST['vanaf']))"{{$_REQUEST['vanaf']}}" @else "" @endif></span>
            </td>
            <td>
                <input type="number" name="tm" id="tm"  placeholder="t/m" value=@if(isset($_REQUEST['tm'])) "{{$_REQUEST['tm']}}" @else "" @endif>
            </td>
            <td rowspan="2" >
                <button style="background-color:white; color:black;" type="submit" class=" searchbutton inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-6">
                    <span>Zoek</span>
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <select name="brandstof" id="brandstof">
                <option class="" value="">brandstof</option>
                    @foreach($brandstoffen as $brandstof => $autos)
                        <option class="{{$brandstof}}" value="{{$brandstof}}" @isset($_REQUEST['brandstof']) @if($_REQUEST['brandstof']==$brandstof) selected @endif @endisset >{{$brandstof}}</option>
                        
                    @endforeach
                </select>
            </td>
            <td colspan="2">
                <select name="carrosserie" id="carrosserie">
                <option class="" value="">carrosserie</option>
                    @foreach($carrosseries as $carrosserie => $autos)
                        <option class="{{$carrosserie}}" value="{{$carrosserie}}"
                         @isset($_REQUEST['carrosserie']) @if($_REQUEST['carrosserie']==$carrosserie) selected @endif @endisset >{{$carrosserie}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
    </form>
</div>