<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <a href="/admin">
                <img src="admin_assets/images/logo.svg">
            </a>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>{{__("Main Menu")}}</li>
                <li class="sidebar-item @yield('dashboard') ">
                    <a href="/admin" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>{{__("Dashboard")}}</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub @yield('manage_products')">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>{{__("Manage Products")}}</span>
                    </a>
                    <ul class="submenu ">
                        @can('categories')
                        <li>
                            <a href="admin/categories">{{__("Categories")}}</a>
                        </li>
                        <li>
                            <a href="admin/subcategories">{{__("SubCategories")}}</a>
                        </li>
                        @endcan
                        @can('brands')
                        <li>
                            <a href="admin/brands">{{__("Brands")}}</a>
                        </li>
                        @endcan
                        @can('products')
                        <li>
                            <a href="admin/products">{{__("Products")}}</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @role('admin')
                <li class='sidebar-title'>{{__("Staff")}}</li>
                <li class="sidebar-item @yield('manage_staff') ">
                    <a href="/admin/staff" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>{{__("Staff")}}</span>
                    </a>
                </li>
                @endrole
                @can('clients')
                <li class='sidebar-title'>{{__("Clients")}}</li>
                <li class="sidebar-item @yield('manage_clients') ">
                    <a href="/admin/clients" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>{{__("Clients")}}</span>
                    </a>
                </li>
                @endcan
                @can('orders')
                <li class="sidebar-item @yield('manage_orders') ">
                    <a href="/admin/orders" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>{{__("Orders")}}</span>
                    </a>
                </li>
                @endcan
                @can('discounts')
                <li class="sidebar-item @yield('manage_discounts') ">
                    <a href="/admin/discounts" class='sidebar-link'>
                        <i data-feather="percent" width="20"></i>
                        <span>{{__("Discounts")}}</span>
                    </a>
                </li>
                @endcan
                <li class="sidebar-item @yield('manage_chats') ">
                    <a href="/admin/chats" class='sidebar-link'>
                        <i data-feather="message-circle" width="20"></i>
                        <span>{{__("Chat")}}</span>
                    </a>
                </li>
                <li class='sidebar-title'>{{__("Information")}}</li>
                <li class="sidebar-item  has-sub @yield('info')">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="info" width="20"></i>
                        <span> Website</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="/admin/banners">{{__("Banners")}}</a>
                        </li>
                        <li>
                            <a href="/admin/bannersfeatured">{{__("Banners Collection")}}</a>
                        </li>
                        <li>
                            <a href="/admin/news">{{__("News")}}</a>
                        </li>
                        <li>
                            <a href="/admin/info">{{__("Information")}}</a>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>