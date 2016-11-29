@if($role)
    @if($role->name =='admin')
        <a href="{{action('Admin\RoleController@show', $role->id)}}"><span class="label label-danger animated flash">{{$role->name}}</span></a>
    @elseif($role->name =='manager')
        <a href="{{action('Admin\RoleController@show', $role->id)}}"><span class="label label-warning animated flash">{{$role->name}}</span></a>
    @else
        <a href="{{action('Admin\RoleController@show', $role->id)}}"><span class="label label-info animated flash">{{$role->name}}</span></a>
    @endif

@else
    <span class="label label-primary animated flash">{{trans('role.no-role')}}</span>
@endif