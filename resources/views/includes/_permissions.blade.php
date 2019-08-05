
<div id="accordion">
    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
    <div class="card card-primary">
        <div class="card-header d-flex p-0">
            <h4 class="card-title p-3">
                <a data-toggle="collapse" aria-expanded="true" data-parent="#accordion" href="#{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}">
                    {{ $title }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
                </a>
            </h4>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item">
                    @if(!isset($options))
                    @can('edit_roles')
                        {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
                    @endcan
                    @endif
                </li>
            </ul>
        </div>
        <div id="{{ isset($title) ? Str::slug($title) :  'permissionHeading' }}" class="panel-collapse collapse show">
            <div class="card-body">
                <div class="row">
                    @foreach($permissions as $perm)
                        <?php
                        $per_found = null;

                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                        ?>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ Str::contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
