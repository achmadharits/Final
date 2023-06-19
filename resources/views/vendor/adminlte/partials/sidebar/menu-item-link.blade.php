<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item text-white">

    <a class="nav-link {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
        href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
        {!! $item['data-compiled'] ?? '' !!}>

        <i
            class="text-white {{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>

        <p class="text-white">
            {{ $item['text'] }}

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </p>

    </a>

</li>
