
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::to('/') }}"> Jiha Tinou (Enertrack 2.0)</a>
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
                            <i class="fa fa-comment fa-fw"></i> Nouveau batiment
                            <span class="pull-right text-muted small">4 minutes environ</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 Nouveaux compteurs
                            <span class="pull-right text-muted small">12 minutes environ</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Nouvelle facture
                            <span class="pull-right text-muted small">4 minutes environ</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> Nouvel éclairage
                            <span class="pull-right text-muted small">4 minutes environ</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Serveur redemarrer
                            <span class="pull-right text-muted small">4 minutes environ</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>Voir toutes les alertes</strong>
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
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile utilisateur</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Déconnection</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
        <li>
            <img src="{{ URL::to('/') }}/cua.png" alt="Logo Commune Urbaine Agadir" style="height:35px;" />
        </li>
        <li >
            <img alt="Brand" src="{{ URL::to('/') }}/jihatinou.jpg" style="height:35px;width:35px;" >
            
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a @if(Request::is('/')) class="active" @endif href="{{ URL::to('') }}"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                </li>
                @if(Auth::user()->hasRole('FACTURE'))
                <li @if(Request::is('tbge/facture') or Request::is('tbge/facture/create') or Request::is('tbge/facture/*/edit')) class="active" @endif>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Factures<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('tbge/facture') or Request::is('tbge/facture/*/edit')) class="active" @endif href="{{ URL::to('tbge/facture') }}">Liste des factures enregistrées</a>
                        </li>
                        <li>
                            <a @if(Request::is('tbge/facture/create')) class="active" @endif href="{{ URL::to('tbge/facture/create') }}">Ajouter une facture</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif
                @if(Auth::user()->hasRole('COMPTEUR'))
                <li @if(Request::is('tbge/compteur') or Request::is('tbge/compteur/create') or Request::is('tbge/compteur/*/edit')) class="active" @endif>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Compteurs<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('tbge/compteur') or Request::is('tbge/compteur/*/edit')) class="active" @endif href="{{ URL::to('tbge/compteur') }}">Liste des compteurs enregistrés</a>
                        </li>
                        <li>
                            <a @if(Request::is('tbge/compteur/create')) class="active" @endif href="{{ URL::to('tbge/compteur/create') }}">Ajouter un compteur</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif
                @if(Auth::user()->hasRole('BATIMENT') || Auth::user()->hasRole('ECLAIRAGE') || Auth::user()->hasRole('ESPACEVERT') ||Auth::user()->hasRole('VEHICULE') || Auth::user()->hasRole('POSTEPRODUCTION'))
                <li  @if(Request::is('patrimoine') or Request::is('tbge/patrimoine/*') or Request::is('patrimoine/*/create') or Request::is('tbge/patrimoine/*/create') or Request::is('patrimoine/*/*/edit') or Request::is('tbge/patrimoine/*/*/edit')) class="active" @endif>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Patrimoines<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::user()->hasRole('ECLAIRAGE'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/eclairage')  or Request::is('tbge/patrimoine/eclairage/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/eclairage') }}">Liste des postes d'éclairages</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('ARRIVEEAU'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/arriveeau')  or Request::is('tbge/patrimoine/arriveeau/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/arriveeau') }}">Liste des points d'arrivée d'eau</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('ESPACEVERT'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/espacevert')  or Request::is('tbge/patrimoine/espacevert/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/espacevert') }}">Liste des espaces verts</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('VEHICULE'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/vehicule')  or Request::is('tbge/patrimoine/vehicule/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/vehicule') }}">Liste des véhicules</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('BATIMENT'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/batiment')  or Request::is('tbge/patrimoine/batiment/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/batiment') }}">Liste des batiments</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('POSTEPRODUCTION'))
                        <li>
                            <a @if(Request::is('tbge/patrimoine/posteproduction')  or Request::is('tbge/patrimoine/posteproduction/*/edit')) class="active" @endif href="{{ URL::to('tbge/patrimoine/posteproduction') }}">Liste des postes de production</a>
                        </li>
                        @endif
                        <li @if(Request::is('tbge/patrimoine') or Request::is('tbge/patrimoine/*/create')) class="active" @endif>
                            <a href="#">Ajouter ... <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                @if(Auth::user()->hasRole('ECLAIRAGE'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/eclairage/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/eclairage/create') }}">Ajouter un poste d'éclairage</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('ARRIVEEAU'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/arriveeau/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/arriveeau/create') }}">Ajouter un point d'arrivée d'eau</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('ESPACEVERT'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/espacevert/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/espacevert/create') }}">Ajouter un espace vert</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('VEHICULE'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/vehicule/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/vehicule/create') }}">Ajouter un véhicule</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('BATIMENT'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/batiment/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/batiment/create') }}">Ajouter un batiment</a>
                                </li>
                                @endif
                                @if(Auth::user()->hasRole('POSTEPRODUCTION'))
                                <li>
                                    <a @if(Request::is('tbge/patrimoine/posteproduction/create')) class="active" @endif href="{{ URL::to('tbge/patrimoine/posteproduction/create') }}">Ajouter un poste de production</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif
                @if(Auth::user()->hasRole('ADMIN'))
                <li @if(Request::is('admin/user') or Request::is('admin/user/create') or Request::is('admin/user/*/edit')) class="active" @endif>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Utilisateurs<sspan class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a @if(Request::is('admin/user') or Request::is('admin/user/*/edit')) class="active" @endif href="{{ URL::to('admin/user') }}">Liste des utilisateurs</a>
                        </li>
                        <li>
                            <a @if(Request::is('admin/user/create')) class="active" @endif href="{{ URL::to('admin/user/create') }}">Ajouter un utilisateur</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif
                <li>
                    <a href="{{URL::to('contact/11')}}"><i class="fa fa-sitemap fa-fw"></i> Contacter un administrateur</a>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>