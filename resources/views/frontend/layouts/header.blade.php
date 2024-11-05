<header class="fixed inset-x-0 top-0 m-auto w100 pt-3 z-20" >
    <div class="mx-auto flex max items-start justify-between container header-container">




        <div class="flex flex-col justify-between">
            <div class="site_logo"></div>
            <button class="relative flex items-center text-white btn-navbar">
                <div class="relative inline-block mr-2">
                    <img alt="menu" loading="lazy" width="0" height="0" class="" src="{{ asset( '/public/img/menu-icon.svg' ) }}" >
                </div>
                DANH MỤC SẢN PHẨM
            </button>
        </div>








        <div class="flex-1 px-5 searchbar">
            <div class="relative flex bg-white searchbar_wrap" >


                <div class="absolute  m-auto  w100 searchbar_wrap_con">
                    <form>
                        <div class="background_header_desktop flex">
                            <div class="relative w100" style="height: 40px;">
                                <i class="fa-solid fa-magnifying-glass  icon__search absolute   "></i>
                                <div class="w100 h100">
                                    <input name="search" id="txt_search_product" type="text" maxlength="150" autocomplete="off" class="w100" placeholder="Nhập tên sản phẩm cần tìm" value="">
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="/gio-hang">
                        <i id="cart" class="fa-solid fa-cart-shopping icon__cart absolute"></i>
                    </a>
                    <div id="cartQuantity" class="absolute text-center text-white">4</div>
                </div>

            </div>
        </div>





        <div class="flex flex-col items-end">
            <div id="btn_choose_location" class="relative flex w100 justify-end">
                <div class="flex items-center text-white after:-rotate-45  location-display" style="">
                    <span class="flex items-center span_giaoden">
                        <i class="fa-solid fa-location-dot icon__location"></i> Giao đến:
                    </span>
                    <span class="location_address_box">
                        <span class="location_address w100 ">P.Vũ Ninh, TP. Bắc ninh, Tỉnh Băc Ninh</span>
                    </span>
                </div>
            </div>
            <div class="flex">
                <a class="mt-2 px-2 py-1 flex items-center text-white header-login"
                    href="/dang-nhap">
                    <div class="relative inline-block mr-2" style="width: 24px; height: 24px;">
                        <img alt=""  width="0" height="0" class="" src="{{ asset( '/public/img/user.svg' ) }}"  >
                    </div>
                    <span>Đăng nhập</span>
                </a>
            </div>
        </div>



        
    </div>
</header>
 