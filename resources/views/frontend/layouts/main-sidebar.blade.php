<!-- <div class="w-100_ h-100_ " id="leftNavbarContent2" >
    <ul class="menu-list list-cat w-100"  >
        @foreach($chinaCategories as $cat)
            <li class="menu menu-submenu w-100 bg-white" >
                <div style="padding: 0px 12px;">
                    <a href="#" class="menu-title" >{{ $cat->name }}</a>

                </div>
            </li>
        @endforeach

    </ul>
</div> -->


<div class="collapse navbar-collapse w-100_ h-100_ collapse show " id="leftNavbarContent" style="">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 menu-list list-cat w-100">
        @foreach($chinaCategories as $cat)
        <li class="nav-item menu menu-submenu w-100 bg-white" >
            <div style="padding: 0px 12px;">
                <a href="#" class="nav-link menu-title"  aria-current="page" >{{ $cat->name }}</a>
            </div>
        </li>
        @endforeach

    </ul>

</div>
