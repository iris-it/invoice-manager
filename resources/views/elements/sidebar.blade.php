<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            @can('permission::access_user_section')
                <li class="header text-center">{{ trans('menu.user-role') }}</li>
                <li><a href="{{ action('VaultController@index') }}"><i class="fa fa-file-o text-aqua"></i> {{trans('menu.user-vaults-link')}}</a></li>
            @endcan


            @can('permission::access_manager_section')
                <li class="header text-center">{{ trans('menu.manager-role') }}</li>
                <li><a href="{{ action('Manager\VaultController@index') }}"><i class="fa fa-files-o text-aqua"></i> {{trans('menu.manager-vaults-link')}}</a></li>
            @endcan

            @can('permission::access_admin_section')
                <li class="header text-center">{{ trans('menu.admin-role') }}</li>
                <li><a href="{{ action('Admin\UserController@index') }}"><i class="fa fa-user-o text-aqua"></i> {{trans('menu.admin-users-link')}}</a></li>
                <li><a href="{{ action('Admin\RoleController@index') }}"><i class="fa fa-lock text-aqua"></i> {{trans('menu.admin-roles-link')}}</a></li>
                <li><a href="{{ action('Admin\PermissionController@index') }}"><i class="fa fa-lock text-aqua"></i> {{trans('menu.admin-permissions-link')}}</a></li>
            @endcan

        </ul>
    </section>
</aside>
