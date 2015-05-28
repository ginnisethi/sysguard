<!DOCTYPE html>
<html>
<head>
    @include('sysguard::partials.head')
    @yield('custom-head')
</head>
<body class="skin-blue">
    <div class="wrapper">     
        <div class="content-wrapper">
            <section class="content-header">
                @yield('content-header')
            </section>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>
    @yield('custom-foot')
</body>
</html>