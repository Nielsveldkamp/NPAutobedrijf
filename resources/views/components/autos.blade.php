<div>
    <div style="text-align: center; font-size: 40px;">
    <b>Nieuws</b>
    </div>
    @if($berichten->isempty())
    <div class="mt-8" style="text-align: center;">  
    er is geen nieuws
    </div>
    @endif
    @foreach ($autos as $auto)
    <div class="mt-8">
        <table style=" width: 100%; border: 1px solid black; border-radius: 20px; border-collapse: separate; table-layout: auto;  " class="mt-8 px-4">
            <tr>
                <td class="text-xl font-semibold" style="width:30%; word-wrap: anywhere;">
                    <div>
                        {{ $auto->titel }}
                    </div>
                </td>
            </tr>
        </table>
        </div>
    @endforeach
</div>
