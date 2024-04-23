<div class="col-lg-3">
    <div class="custom-card">
        <a href="{{ route('content', ['content' => $c->id]) }}">
            <div class="custom-card_image">
                <img src="{{ asset($c->image) }}" alt="">
            </div>
        </a>
        <h5>{{ $c->title_rus }}</h5>
        <div class="description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati quaerat optio repellat
            temporibus architecto cumque ipsam hic, totam accusamus eius ea officiis itaque doloremque
            a, adipisci incidunt illum natus. Unde.
        </div>
        <div class="text-secondary small">Длительность:
            @if ($c->duration >= 3600)
                {{ gmdate('H:i:s', $c->duration) }}
            @else
                {{ gmdate('i:s', $c->duration) }}
            @endif
        </div>
    </div>
</div>
