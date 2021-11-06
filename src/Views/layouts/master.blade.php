<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{
        trans('installer_messages.title') }}</title>
    <link rel="icon" type="image/png" href="{{ installerPublicPath('installer/img/favicon/favicon-16x16.png') }}"
        sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ installerPublicPath('installer/img/favicon/favicon-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ installerPublicPath('installer/img/favicon/favicon-96x96.png') }}"
        sizes="96x96" />
    <link href="{{ installerPublicPath('installer/css/style.min.css') }}" rel="stylesheet" />
    @yield('style')
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
    </script>
</head>

<body>
    <div class="master">
        <div class="box">
            <div class="header">
                <h1 class="header__title">@yield('title')</h1>
            </div>
            <ul class="step">
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('installer::final') }}">
                    <i class="step__icon fa fa-server" aria-hidden="true"></i>
                </li>
                <li class="step__divider"></li>
                <li
                    class="step__item {{ isActive('installer::environment')}} {{ isActive('installer::environmentWizard')}} {{ isActive('installer::environmentClassic')}}">
                    @if(Request::is('install/environment') || Request::is('install/environment/wizard') ||
                    Request::is('install/environment/classic') )
                    <a href="{{ route('installer::environment') }}">
                        <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('installer::permissions') }}">
                    @if(Request::is('install/permissions') || Request::is('install/environment') ||
                    Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                    <a href="{{ route('installer::permissions') }}">
                        <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-key" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('installer::requirements') }}">
                    @if(Request::is('install') || Request::is('install/requirements') ||
                    Request::is('install/permissions') || Request::is('install/environment') ||
                    Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                    <a href="{{ route('installer::requirements') }}">
                        <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-list" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
                <li class="step__item {{ isActive('installer::welcome') }}">
                    @if(Request::is('install') || Request::is('install/requirements') ||
                    Request::is('install/permissions') || Request::is('install/environment') ||
                    Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                    <a href="{{ route('installer::welcome') }}">
                        <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    </a>
                    @else
                    <i class="step__icon fa fa-home" aria-hidden="true"></i>
                    @endif
                </li>
                <li class="step__divider"></li>
            </ul>
            <div class="main">
                @if (session('message'))
                <p class="text-center alert">
                    <strong>
                        @if(is_array(session('message')))
                        {{ session('message')['message'] }}
                        @else
                        {{ session('message') }}
                        @endif
                    </strong>
                </p>
                @endif
                @if(session()->has('errors'))
                <div class="alert alert-danger" id="error_alert">
                    <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                    <h4>
                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                        {{ trans('installer_messages.forms.errorTitle') }}
                    </h4>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @yield('container')
            </div>
        </div>
    </div>
    @yield('scripts')
    <script type="text/javascript">
        var x = document.getElementById('error_alert');
            var y = document.getElementById('close_alert');
            y.onclick = function() {
                x.style.display = "none";
            };
    </script>
</body>

</html>