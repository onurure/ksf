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
                        <li><a href="{{ url('logout') }}"><span>Çıkış</span></a></li>
                        @endif
                        <li><a href="{{ url('logout') }}"><span>Çıkış</span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>