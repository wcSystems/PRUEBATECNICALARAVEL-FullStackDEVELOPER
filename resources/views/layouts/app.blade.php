<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FullStack DEVELOPER</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/transparent/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/sweetalert/dist/sweetalert.min.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    {{ \Carbon\Carbon::setLocale('es') }}
    <div class="page-cover" style="background-image: url('{{ asset('img/login-bg/login-bg-11.jpg') }}');"></div>
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <div id="header" class="header navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand"><b>PRUEBA TÉCNICA LARAVEL - FullStack DEVELOPER</b></a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="image image-icon bg-black text-grey-darker">
                            <i class="fa fa-user"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div id="sidebar" class="sidebar">
            <div data-scrollbar="true" data-height="100%">
                <ul class="nav">
                    <li class="nav-profile">
                        <a disabled>
                            <div class="image image-icon bg-black text-grey-darker">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="info">
                                {{ Auth::user()->name }}
                                <small></small>
                            </div>
                        </a>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="nav-header">Menú</li>
                    <li id="user-list" class="has-sub closed">
                        <a href="{{ route('users') }}">
                            <i class="fa fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-bg"></div>
        <div id="content" class="content">
            @yield('content')
        </div>
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/theme/transparent.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/min/moment.min.js') }}"></script>
    @yield('js')
</body>
</html>
