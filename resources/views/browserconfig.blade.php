<?xml version="1.0" encoding="utf-8"?>
<browserconfig>
    <msapplication>
        <tile>
            @foreach([70, 150, 310] as $size)
            <square{{ $size }}x{{ $size }}logo src="{{ route('favicons.png_custom', ['width' => $size, 'height' => $size]) }}"/>
            @endforeach
            <wide310x150logo src="{{ route('favicons.png_custom', ['width' => 310, 'height' => 150]) }}"/>
        </tile>
    </msapplication>
</browserconfig>