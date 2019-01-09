<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">
            @if(auth()->user()->is_admin==1)
                <li><a href="{{ url('admin') }}"><span>Kullanıcılar</span></a></li>
                <li><a href="{{ url('admin/companies') }}"><span>Şirketler</span></a></li>
            @else
                <li><a href="{{ url('parameters') }}"><span>Parametreler</span></a></li>
            @endif
            <li><a href="{{ url('logout') }}"><span>Çıkış</span></a></li>
        </ul>
        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>