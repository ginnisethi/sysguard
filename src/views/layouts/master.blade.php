<!DOCTYPE html>
<html>
<head>
    @include('sysguard::partials.head')
    @yield('custom-head')
</head>
<body class="skin-blue">
    <div class="wrapper">     
        @include('sysguard::partials.header')
        
        @include('sysguard::partials.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                @yield('content-header')
            </section>

            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('sysguard::partials.footer')

    </div>
    @include('sysguard::partials.foot-script')
    @yield('custom-foot')
    @include('sysguard::partials.modal-delete')
</body>
</html>