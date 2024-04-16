<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        @php
            $settings = App\Models\Settings::first(); // Fetch the settings
        @endphp

        <div class="app-brand">
            <a href="{{ route('AdminDashboard') }}">
                <img src="{{ asset('admin/settings/logo/' . $settings->website_logo) }}" alt=""
                    style="width: 50px; border-radius:50%;">
                <span class="brand-name">{{ $settings->website_name }}</span>
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="{{ request()->route()->getName() == 'AdminDashboard' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('AdminDashboard') }}">
                        <i class="mdi mdi-briefcase-account-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li class="section-title">
                    Elements
                </li>

                <li class="{{ request()->route()->getName() == 'adminCategoryList' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('adminCategoryList') }}">
                        <i class="mdi mdi-wechat"></i>
                        <span class="nav-text">Category</span>
                    </a>
                </li>

                <li class="{{ request()->route()->getName() == 'adminSubcategoryList' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('adminSubcategoryList') }}">
                        <i class="mdi mdi-wechat"></i>
                        <span class="nav-text">SubCategory</span>
                    </a>
                </li>

                <li class="{{ request()->route()->getName() == 'adminBrandList' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('adminBrandList') }}">
                        <i class="mdi mdi-wechat"></i>
                        <span class="nav-text">Brand</span>
                    </a>
                </li>

                <li class="{{ request()->route()->getName() == 'adminProductList' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('adminProductList') }}">
                        <i class="mdi mdi-wechat"></i>
                        <span class="nav-text">Product</span>
                    </a>
                </li>

                <li class="section-title">
                    Systems
                </li>

                <li class="{{ request()->route()->getName() == 'adminOperatingSystemList' ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('adminOperatingSystemList') }}">
                        <i class="mdi mdi-wechat"></i>
                        <span class="nav-text">Operating Systems</span>
                    </a>
                </li>
            </ul>


        </div>

        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <ul class="d-flex">
                    <li>
                        <a href="{{ route('adminSettings') }}"><i class="mdi mdi-settings"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
