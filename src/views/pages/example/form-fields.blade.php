{!! BootstrapForm::text('name') !!}
{!! BootstrapForm::password('password') !!}
{!! BootstrapForm::password('password_confirmation', 'Password Confirmation') !!}
{!! BootstrapForm::email('email') !!}
{!! BootstrapForm::text('favorite_number', 'Favorite Number') !!}
{!! BootstrapForm::text('birthdate') !!}
{!! BootstrapForm::textarea('story') !!}
{!! BootstrapForm::radios('gender', 'Gender', ['l' => 'Laki-laki', 'p' => 'Perempuan']) !!}
{!! BootstrapForm::text('photo', 'Photo URL') !!}
{!! BootstrapForm::text('start_date', 'Start Date') !!}
{!! BootstrapForm::text('end_date', 'End Date') !!}
{!! BootstrapForm::text('wakeup_time', 'Wake Up Time') !!}
{!! BootstrapForm::text('last_login', 'Last Login') !!}
{!! BootstrapForm::submit('Save'); !!}