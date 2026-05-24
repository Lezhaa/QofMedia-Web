<?php
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
?>

<?php if ($__env->exists($sidebarFile)) echo $__env->make($sidebarFile, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/vendor/adminlte/partials/sidebar/left-sidebar.blade.php ENDPATH**/ ?>