{{-- Render menu item berdasarkan tipe --}}
@if(isset($item['header']) && $item['header'])
    {{-- Header --}}
    <li class="nav-header">{{ $item['text'] }}</li>
@elseif(isset($item['submenu']) && is_array($item['submenu']))
    {{-- Treeview (menu dengan submenu) --}}
    <li class="nav-item has-treeview {{ $item['topnav'] ?? false ? '' : '' }}">
        <a href="#" class="nav-link {{ $item['class'] ?? '' }}">
            @if(isset($item['icon']))
                <i class="nav-icon {{ $item['icon'] }}"></i>
            @else
                <i class="nav-icon fas fa-circle"></i>
            @endif
            <p>
                {{ $item['text'] }}
                <i class="right fas fa-angle-left"></i>
                @if(isset($item['label']))
                    <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                        {{ $item['label'] }}
                    </span>
                @endif
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach($item['submenu'] as $subitem)
                @include('adminlte::partials.sidebar.menu-item-link', ['item' => $subitem])
            @endforeach
        </ul>
    </li>
@elseif(isset($item['url']))
    {{-- Single menu item --}}
    @include('adminlte::partials.sidebar.menu-item-link', ['item' => $item])
@endif