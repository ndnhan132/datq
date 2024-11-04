<div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar d-none" src="#" alt="User Image">
    <div>
        <p class="app-sidebar__user-name">{{ session('user')->display_name }}</p>
        <p class="app-sidebar__user-designation">USN</p>
    </div>
</div>
<ul class="app-menu">
    <li>
        <a class="app-menu__item active" href="{{ route('admin.getDashboard') }}">
            <i class="app-menu__icon fa fa-dashboard">
            </i><span class="app-menu__label">Dashboard</span>
        </a>
    </li>


    <li>
        <a class="app-menu__item" href="{{ route('admin.category.index') }}">
            <i class="app-menu__icon fa fa-pie-chart"></i>
            <span class="app-menu__label">Danh mục</span>
        </a>
    </li>
    <li class="treeview is-expanded">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Sản phẩm</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">  
            <li>
                <a class="treeview-item" href="{{ route('admin.product.index') }}"><i class="icon fa fa-circle-o"></i>
                    Danh sách
                </a>
            </li>
            <li>
                <a class="treeview-item" href="{{ route('admin.product.create') }}" rel="noopener">
                    <i class="icon fa fa-circle-o"></i>
                    Thêm mới
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="app-menu__item" href="#">
            <i class="app-menu__icon fa fa-pie-chart"></i>
            <span class="app-menu__label">Hình ảnh</span>
        </a>
    </li>

    <!--
    
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Forms</span><i
                class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item" href="form-components.html"><i class="icon fa fa-circle-o"></i> Form
                    Components</a></li>
            <li><a class="treeview-item" href="form-custom.html"><i class="icon fa fa-circle-o"></i> Custom
                    Components</a>
            </li>
            <li><a class="treeview-item" href="form-samples.html"><i class="icon fa fa-circle-o"></i> Form Samples</a>
            </li>
            <li><a class="treeview-item" href="form-notifications.html"><i class="icon fa fa-circle-o"></i> Form
                    Notifications</a></li>
        </ul>
    </li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables</span><i
                class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item" href="table-basic.html"><i class="icon fa fa-circle-o"></i> Basic Tables</a>
            </li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon fa fa-circle-o"></i> Data
                    Tables</a>
            </li>
        </ul>
    </li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i
                class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>
            <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>
            <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen
                    Page</a></li>
            <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>
            <li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a>
            </li>
            <li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a>
            </li>
            <li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>
            <li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>
        </ul>
    </li>
    <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-file-code-o"></i><span
                class="app-menu__label">Docs</span></a></li> -->
</ul>