<div class="card">

    @if ($header)
    <div class="card-header">
        <h4>{{ $header }}</h4>
    </div>    
    @endif
    
    <div class="card-body">
        {{ $slot }}
    </div>

    @if ($footer)
    <div class="card-footer bg-whitesmoke">
        {{ $footer }}
    </div>    
    @endif
    
</div>