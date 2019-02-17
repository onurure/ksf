<header class="header">
    <div class="container-fluid">
        <nav class="navbar">
            <!-- Begin Topbar -->
            <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                <!-- Begin Logo -->
                <div class="horizontal-menu">
                    <div class="container-fluid">
                        <div class="row">
                            <nav class="navbar navbar-light navbar-expand-lg main-menu">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        @if(auth()->user()->is_admin==1)
                                            <li><a href="{{ url('admin/users') }}"><span>Kullanıcılar</span></a></li>
                                            <li><a href="{{ url('admin') }}"><span>Şirketler</span></a></li>
                                        @else
                                            <li><a href="{{ url('safeaccount') }}"><span>Kasa Yönetimi</span></a></li>
                                            <li><a href="{{ url('incoming') }}"><span>Gelir Yönetimi</span></a></li>
                                            <li><a href="{{ url('parameters') }}"><span>Parametreler</span></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- End Logo -->
                <!-- Begin Navbar Menu -->
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                    <!-- User -->
                    <li class="nav-item dropdown">
                        <a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                            <img src="{{auth()->user()->photo}}" onerror="this.src='images/default.png'" class="avatar rounded-circle" style="margin-right:10px;">
                        </a>
                        <ul aria-labelledby="user" class="user-size dropdown-menu">
                            <li>
                                <a href="javascript:;">
                                    {{auth()->user()->email}}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('sifre')}}" class="dropdown-item"> 
                                    Şifre Değiştir
                                </a>
                            </li>
                            <li><a href="{{ url('logout') }}"><span>Çıkış</span></a></li>
                        </ul>
                    </li>
                    <!-- End User -->
                </ul>
                <!-- End Navbar Menu -->
            </div>
            <!-- End Topbar -->
        </nav>
    </div>
</header>