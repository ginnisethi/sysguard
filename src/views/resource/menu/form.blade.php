{!! BootstrapForm::text('name') !!}
{!! BootstrapForm::select('parent_id', 'Parent Menu', $menus) !!}
{!! BootstrapForm::text('code') !!}
{!! BootstrapForm::text('url') !!}
{!! BootstrapForm::text('order') !!}
{!! BootstrapForm::text('icon') !!}
{!! BootstrapForm::checkbox('enabled', 'Enabled', '1') !!}