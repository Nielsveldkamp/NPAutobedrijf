<style>
    body {
        min-height: 100vh;
        margin: 0;
        position: relative;
    }

    body::after {
        content: '';
        display: block;
        height: 100px;
    }
</style>
<div style="margin-top:45vh;">
    <div
        style="
        color:white;
        background-color:black;
        position: absolute;
        bottom: 0;
        width: 100%;
        min-height: 300px;">
        <div style="display:flex;" class="smallDisplayCollumn">
            <div style="width: 20%; margin-left: 2%; margin-top: 0.65%;">            
                <div style="margin-top:1vh;">
                    {{$contact_gegevens->adres}}
                </div>
                <div style="margin-top:1vh;">
                    {{$contact_gegevens->telefoonnummer}}
                </div>
                <div style="margin-top:1vh; margin-bottom:3vh; word-wrap: anywhere">
                    {{$contact_gegevens->email}}
                </div>
            </div>
            
            @if(!empty($contact_gegevens->adres) && isset($contact_gegevens->adres) && isset($contact_gegevens))
        
            <div style="width:80%">
                <x-google-maps-widget :adres="$contact_gegevens->adres">    
                </x-google-maps-widget>         
            </div>
            @endif
        </div>
    </div>
</div>
