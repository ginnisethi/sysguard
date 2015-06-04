{!! BootstrapForm::text('name') !!}
{!! BootstrapForm::email('email') !!}
{!! BootstrapForm::password('password') !!}

<div class="form-group ">
    <label for="group" class="control-label col-sm-2 col-md-3">Group</label>
    <div class="col-sm-3 col-md-9">
    @foreach ($groups as $key => $value)
        <div class="checkbox">
            <label>
                <input name="group_ids[]" type="checkbox" value="{{ $key }}" {{ in_array($key, $userGroups) ? 'checked' : null }}> {{ $value }}
            </label>
        </div>
    @endforeach
    @if (!count($groups))
        -
    @endif
    </div>
</div>
