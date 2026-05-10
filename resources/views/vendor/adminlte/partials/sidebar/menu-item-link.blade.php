{{-- Cek apakah ini item menu dengan link --}}
@if(isset($item['url']))
    <li class="nav-item">
        <a href="{{ $item['url'] }}" 
           class="nav-link {{ request()->url() == $item['url'] ? 'active' : '' }} {{ $item['class'] ?? '' }}" 
           {{ isset($item['target']) ? 'target='.$item['target'] : '' }}
           {{ isset($item['id']) ? 'id='.$item['id'] : '' }}>
            @if(isset($item['icon']))
                <i class="nav-icon {{ $item['icon'] }}"></i>
            @else
                <i class="nav-icon fas fa-circle"></i>
            @endif
            <p>
                {{ $item['text'] }}
                @if(isset($item['label']))
                    <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                        {{ $item['label'] }}
                    </span>
                @endif
            </p>
        </a>
    </li>
@endif