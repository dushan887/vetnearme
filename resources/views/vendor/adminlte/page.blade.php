@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper" id=admin-app>

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                          <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-envelope-o"></i>
                              <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header">You have 4 messages</li>
                              <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                  <li><!-- start message -->
                                    <a href="{{ url('/admin/mailbox/message') }}">
                                      <div class="pull-left">
                                        <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                      </h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis distinctio, eum velit accusamus a cumque molestiae, aspernatur deleniti itaque tempora ut ipsa. Doloribus veritatis incidunt expedita repellendus soluta maiores harum.</p>
                                    </a>
                                  </li>
                                  <!-- end message -->
                                  <li>
                                    <a href="{{ url('/admin/mailbox/message') }}">
                                      <div class="pull-left">
                                        <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                      </h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit quisquam, corporis modi dicta sed. Non, ex vitae in doloribus voluptas sequi, expedita animi veritatis, nulla vero nisi culpa exercitationem explicabo.</p>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/mailbox/message') }}">
                                      <div class="pull-left">
                                        <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                      </h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum et, ut illo expedita ipsa praesentium totam, architecto minima labore eligendi obcaecati, dolor sapiente possimus dolorem. Vero quidem itaque, qui fugit.</p>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/mailbox/message') }}">
                                      <div class="pull-left">
                                        <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                      </h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate in tempore veritatis qui non! Quo repellendus, numquam totam, aspernatur deserunt hic earum a. Hic error facilis ipsam. Assumenda fugit, eaque.</p>
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/mailbox/message') }}">
                                      <div class="pull-left">
                                        <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                                      </div>
                                      <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                      </h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate delectus quisquam repellendus, ipsam temporibus provident, deserunt officia! Dignissimos, impedit? Asperiores quas, assumenda. Architecto aperiam, assumenda. Blanditiis, iure odit cum deleniti!</p>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                              <li class="footer"><a href="{{ url('/admin/mailbox') }}">See All Messages</a></li>
                            </ul>
                          </li>
                          <!-- Notifications: style can be found in dropdown.less -->
                          <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-bell-o"></i>
                              <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header">You have 10 notifications</li>
                              <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                  <li>
                                    <a href="{{ url('/admin/notifications/notification') }}">
                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/notifications/notification') }}">
                                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                      page and may cause design problems
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/notifications/notification') }}">
                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/notifications/notification') }}">
                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ url('/admin/notifications/notification') }}">
                                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                  </li>
                                </ul>
                              </li>
                              <li class="footer"><a href="{{ url('/admin/notifications/notification') }}">View all</a></li>
                            </ul>
                          </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <img src="http://via.placeholder.com/160x160" class="user-image" alt="User Image">
                              <span class="hidden-xs">Name Surname</span>
                            </a>
                            <ul class="dropdown-menu">
                              <!-- User image -->
                              <li class="user-header">
                                <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">

                                <p>
                                  Name Surname - Position
                                  <small>Member since April 2018</small>
                                </p>
                              </li>
                              <!-- Menu Body -->
                              <li class="user-body">
                                <div class="row">
                                  <div class="col-xs-4 text-left">
                                    <a href="{{ url('/admin/user') }}"> <img src="http://via.placeholder.com/160x160" class="img-responsive" alt="Clinic Image"></a>
                                  </div>
                                  <div class="col-xs-8 text-left">
                                    <small>Practice</small><br />
                                    <a href="#"  class="lead"><strong>Clinic Name</strong></a>
                                  </div>
                                </div>
                                <!-- /.row -->
                              </li>
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                <div class="row" style="margin-right: -10px;margin-left: -10px;">
                                    <div class="col-xs-6">
                                      <a href="{{ url('/admin/user') }}" class="btn btn-default btn-flat btn-block "><i class="fa fa-fw fa-user"></i>  My Profile</a>
                                    </div>
                                    <div class="col-xs-6">
                                        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                            <a class="btn btn-default btn-flat btn-block"
                                                href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" >
                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-default btn-flat btn-block"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                            </a>
                                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                @if(config('adminlte.logout_method'))
                                                    {{ method_field(config('adminlte.logout_method')) }}
                                                @endif
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </div>
                                </div>
                              </li>
                            </ul>
                          </li>
                        <li>

                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                 <!-- Sidebar user panel -->
                  <div class="user-panel">
                    <div class="pull-left image">
                      <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                      <p>Name Surname</p>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                  </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper clearfix">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <admin-alerts></admin-alerts>
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif

        </div>
        <!-- /.content-wrapper -->
    <admin-modal></admin-modal>
    </div>

    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
