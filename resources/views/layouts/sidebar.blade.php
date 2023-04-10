<nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="index.html">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            <img class="img-avatar img-avatar32" src="/assets/media/avatars/avatar15.jpg" alt="">
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="be_pages_generic_profile.html">
                                <img class="img-avatar" src="/assets/media/avatars/avatar15.jpg" alt="">
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="be_pages_generic_profile.html">{{ Auth::user()->id }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Dashboard Utama</span></li>
                            <li>
                                <a href="{{route('home')}}"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
                            <li>
                                <a href="be_pages_dashboard.html"><i class="fa fa-stethoscope"></i><span class="sidebar-mini-hide">Kunjungan</span></a>
                            </li>
                            <li>
                                <a href="be_pages_dashboard.html"><i class="si si-book-open"></i><span class="sidebar-mini-hide">Kegiatan</span></a>
                            </li>
                            <li>
                                <a href="{{route('penjadwalan.index')}}"><i class="si si-calendar"></i><span class="sidebar-mini-hide">Penjadwalan</span></a>
                            </li>
                            <li>
                                <a href="{{route('exception.index')}}"><i class="si si-envelope-letter"></i><span class="sidebar-mini-hide">Exception</span></a>
                            </li>
                            
                            <li class="nav-main-heading"><span class="sidebar-mini-hidden">Data Master</span></li>
                            <li>
                                <a href="be_pages_dashboard.html"><i class="si si-users"></i><span class="sidebar-mini-hide">Master Pasien</span></a>
                            </li>
                            <li class="nav-main-heading"><span class="sidebar-mini-hidden">Kelola Simpus</span></li>
                            <li>
                                <a href="{{route('desa.index')}}"><i class="si si-map"></i><span class="sidebar-mini-hide">Master Desa</span></a>
                            </li>                            <li>
                                <a href="{{route('petugas.index')}}"><i class="fa fa-user-md"></i><span class="sidebar-mini-hide">Master Petugas</span></a>
                            </li>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>