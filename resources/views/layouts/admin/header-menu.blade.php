<div class="page-container">
    <!-- Header START -->
    <div class="header navbar">
        <div class="header-container">
            <ul class="nav-left">
                <li>
                    <a class="side-nav-toggle" href="javascript:void(0);">
                        <i class="ti-view-grid"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="user-info">
                            <span class="name pdd-right-5">{!! \Auth::user()->name !!}</span>
                            <i class="ti-angle-down font-size-10"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{!! route('user.profile') !!}">
                                <i class="ti-user pdd-right-10"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-power-off pdd-right-10"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="side-panel-toggle" href="javascript:void(0);">
                        <i class="ti-settings pdd-right-10"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Header END -->

    <!-- Content Wrapper START -->
    <div class="main-content">
        @if (Request::is('admin'))
            @yield('content')
        @else
            <div class="container-fluid">
                <div class="page-title">
                    <h4>@yield('pageTitle', 'Untitled')</h4>
                </div>
                 @if (\Session::has('success'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ \Session::get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                
                @if (\Session::has('error'))
                    <div class="row">
                        <div class="col-sm-12 alert-dismissable">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong> {{ \Session::get('error') }}
                            </div>
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
        @endif
    </div>
    <!-- Content Wrapper END -->

    <!-- Footer START -->
    <footer class="content-footer">
        <div class="footer">
            <div class="copyright">
                <span>Copyright © 2018 {!! date('Y') == '2018' ? '' : '- ' . date('Y')   !!} <a href="http://hendrign.id" target="_blank"><b class="text-dark">Hendri Gunawan</b></a>. All rights reserved.</span>
            </div>
        </div>
    </footer>
    <!-- Footer END -->

</div>