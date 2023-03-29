
<script src="{{ asset('/js/searchbarNav.js') }}"></script>

<div class="bg-gray-800 w-full">

    <form action="{{ route('auto.search') }}">
    @csrf
    <table class="searchBarT">

        <tr>
            <td>
            </td>
            <td>
                <select name="merk" id="merkSmall" class="SelectSmall" >
                <option class="" value="">merk</option>
                    @foreach($types as $merknaam => $merk)
                    <option value="{{$merknaam}}" @isset($_REQUEST['merk'])  @if($_REQUEST['merk']==$merknaam) selected @endif @endisset>{{$merknaam}}</option>
                    @endforeach
                </select>
                
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <select name="type" id="typeSmall" class="SelectSmall">
                <option class="" value="">model</option>
                    @foreach($types as $merknaam => $autos)
                        @foreach($autos as $auto)
                        <option class="{{$merknaam}}" value="{{$auto->type}}"  @isset($_REQUEST['type']) @if($_REQUEST['type']==$auto->type) selected @endif @endisset >{{$auto->type}}</option>
                        @endforeach
                    @endforeach
                </select>
            </td>
        </tr>

        <tr>
            <td>
            </td>
            <td>
                <select name="brandstof" id="brandstofSmall" class="SelectSmall">
                <option class="" value="">brandstof</option>
                    @foreach($brandstoffen as $brandstof => $autos)
                        <option id="{{$brandstof}}" value="{{$brandstof}}" @isset($_REQUEST['brandstof']) @if($_REQUEST['brandstof']==$brandstof) selected @endif @endisset >{{$brandstof}}</option>
                        
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <select name="carrosserie" id="carrosserieSmall" class="SelectSmall">
                <option class="" value="">carrosserie</option>
                    @foreach($carrosseries as $carrosserie => $autos)
                        <option id="{{$carrosserie}}" value="{{$carrosserie}}"
                         @isset($_REQUEST['carrosserie']) @if($_REQUEST['carrosserie']==$carrosserie) selected @endif @endisset >{{$carrosserie}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <span class="text-white ml-4"> 
                    prijs:
                </span>
            </td>
            <td>
                <input class="ml-3" type="number" name="vanaf" id="vanaf" placeholder="vanaf" 
                value=@if(isset($_REQUEST['vanaf']))"{{$_REQUEST['vanaf']}}" @else "" @endif>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input class="ml-3" type="number" name="tm" id="tm"  placeholder="t/m" value=@if(isset($_REQUEST['tm'])) "{{$_REQUEST['tm']}}" @else "" @endif>
            </td>
        </tr>

        <tr>
            <td>
            </td>
            <td>
                <button style="background-color:white; color:black;" type="submit" class=" searchbutton inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-6">
                    <span>Zoek</span>
                </button>
            </td>
        </tr>
    </table>
    </form>
</div>