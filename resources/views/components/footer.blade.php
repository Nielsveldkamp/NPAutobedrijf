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
<div>
    <div
        style="
        color:white;
        background-color:black;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 100px;">
        <div style=" margin-left: 3%; margin-top: 2%">
            <div>
                {{$contact_gegevens->adres}}
            </div>
            <div>
                {{$contact_gegevens->telefoonnummer}}
            </div>
            <div style="word-wrap: anywhere">
                {{$contact_gegevens->email}}
            </div>
        </div>
    </div>
</div>
