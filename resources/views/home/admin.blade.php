<div class="card w-1/2 mx-2 px-">
    <div class="card-header">
        <h3 class="card-title">Bienvenido al Sistema de PPS de la UTN Frro</h3>
    </div>
    <div class="card-body">
        @foreach($buttons as $button)
            <div class="mt-5 text-center">
                <a href="{{ $button['route'] }}" class="button">{{$button['text']}}</a>
            </div>
        @endforeach

    </div>
</div>
