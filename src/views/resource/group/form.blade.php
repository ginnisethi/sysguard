{!! BootstrapForm::text('name') !!}
{!! BootstrapForm::text('code') !!}
{!! BootstrapForm::text('level') !!}

<div class="form-group ">
    <label for="menu" class="control-label col-sm-2 col-md-3">Menu</label>
    <div class="col-sm-3 col-md-9">
    @foreach ($menus as $key => $value)
        <div class="checkbox">
            <label>
                <input name="menu_ids[]" type="checkbox" value="{{ $key }}" {{ in_array($key, $groupMenus) ? 'checked' : null }}> {{ $value }}
            </label>
        </div>
    @endforeach
    @if (!count($menus))
        -
    @endif
    </div>
</div>

<div class="form-group ">
    <label for="permission" class="control-label col-sm-2 col-md-3">Permission</label>
    <div class="col-sm-3 col-md-9">
    @foreach ($permissions as $key => $value)
        <div class="checkbox">
            <label>
                <input name="permission_ids[]" type="checkbox" value="{{ $key }}" {{ in_array($key, $groupPermissions) ? 'checked' : null }}> {{ $value }}
            </label>
        </div>
    @endforeach
    @if (!count($permissions))
        -
    @endif
    </div>
</div>