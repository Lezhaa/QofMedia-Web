@php
    $user = Auth::user();
    
    if ($user && $user->hasRole('admin_qofmedia')) {
        $sidebarFile = 'adminlte::partials.sidebar.sidebar-admin';
    } elseif ($user && $user->hasRole('admin_studio')) {
        $sidebarFile = 'adminlte::partials.sidebar.sidebar-studio';
    } elseif ($user && $user->hasRole('admin_apparel')) {
        $sidebarFile = 'adminlte::partials.sidebar.sidebar-apparel';
    } else {
        $sidebarFile = 'adminlte::partials.sidebar.sidebar-default';
    }
@endphp

@includeIf($sidebarFile)