
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}">Enertrack v2.0</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->Username }} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a @if(Request::is('/')) class="active" @endif href="{{ URL::to('') }}"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                </li>
                <li @if(Request::is('mo') or Request::is('mo/create')) class="active" @endif>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Maitres d'ouvrage<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('mo')) class="active" @endif href="{{ URL::to('mo') }}">Liste</a>
                        </li>
                        <li>
                            <a @if(Request::is('mo/create')) class="active" @endif href="{{ URL::to('mo/create') }}">Nouveau</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li @if(Request::is('moan') or Request::is('moan/create')) class="active" @endif>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Budgets et fréquentations<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('moan')) class="active" @endif href="{{ URL::to('moan') }}">Liste</a>
                        </li>
                        <li>
                            <a @if(Request::is('moan/create')) class="active" @endif href="{{ URL::to('moan/create') }}">Nouveau</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li  @if(Request::is('contact') or Request::is('contact/create')) class="active" @endif>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Contacts<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('contact')) class="active" @endif href="{{ URL::to('contact') }}">Liste</a>
                        </li>
                        <li>
                            <a @if(Request::is('contact/create')) class="active" @endif href="{{ URL::to('contact/create') }}">Nouveau</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li  @if(Request::is('patrimoine') or Request::is('patrimoine/create')) class="active" @endif>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Patrimoines<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('patrimoine')) class="active" @endif href="{{ URL::to('patrimoine') }}">Liste</a>
                        </li>
                        <li @if(Request::is('patrimoine') or Request::is('patrimoine/batiment/create')) class="active" @endif>
                            <a href="#">Nouveau <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a @if(Request::is('patrimoine/batiment/create')) class="active" @endif href="{{ URL::to('patrimoine/batiment/create') }}">Nouveau batiment</a>
                                </li>
                                <li>
                                    <a @if(Request::is('patrimoine/eclairage/create')) class="active" @endif href="{{ URL::to('patrimoine/eclairage/create') }}">Nouveau poste d'éclairage</a>
                                </li>
                                <li>
                                    <a @if(Request::is('patrimoine/vehicule/create')) class="active" @endif href="{{ URL::to('patrimoine/vehicule/create') }}">Nouveau véhicule</a>
                                </li>
                                <li>
                                    <a @if(Request::is('patrimoine/posteproduction/create')) class="active" @endif href="{{ URL::to('patrimoine/posteproduction/create') }}">Nouveau poste de production</a>
                                </li>
                                <li>
                                    <a @if(Request::is('patrimoine/autreposte/create')) class="active" @endif href="{{ URL::to('patrimoine/autreposte/create') }}">Nouveau poste</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li @if(Request::is('compteur') or Request::is('compteur/create')) class="active" @endif>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Compteurs<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('compteur')) class="active" @endif href="{{ URL::to('compteur') }}">Liste</a>
                        </li>
                        <li>
                            <a @if(Request::is('compteur/create')) class="active" @endif href="{{ URL::to('compteur/create') }}">Nouveau</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="blank.html">Blank Page</a>
                        </li>
                        <li>
                            <a href="login.html">Login Page</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>