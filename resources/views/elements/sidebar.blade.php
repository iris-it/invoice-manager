<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            @can('permission::access_user_section')
                <li class="header text-center">{{ trans('menu.user-role') }}</li>
                <li><a href="{{ action('VaultController@index') }}">{{trans('menu.user-vaults-link')}}</a></li>
            @endcan


            @can('permission::access_manager_section')
                <li class="header text-center">{{ trans('menu.manager-role') }}</li>
                <li><a href="{{ action('Manager\VaultController@index') }}">{{trans('menu.manager-vaults-link')}}</a></li>
            @endcan

            @can('permission::access_admin_section')
                <li class="header text-center">{{ trans('menu.admin-role') }}</li>
                <li><a href="{{ action('Admin\UserController@index') }}">{{trans('menu.admin-users-link')}}</a></li>
                <li><a href="{{ action('Admin\RoleController@index') }}">{{trans('menu.admin-roles-link')}}</a></li>
                <li><a href="{{ action('Admin\PermissionController@index') }}">{{trans('menu.admin-permissions-link')}}</a></li>
            @endcan

        </ul>
    </section>
</aside>
