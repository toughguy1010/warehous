<div id="header">
    <div class="navbar-header container">
        <div class="user-wrap">
            @if (auth()->user())
                <div class="user-div">
                    <img src="{{ showImage('') }}" alt="">
                    <ul class="menu-dropdown">
                        <h5>Xin chào {{ auth()->user()->name }}</h5>
                        <div class="profile_info_details">
                            <li class="menu-dropdown-item">
                                <a href="#" class="menu-dropdown-link">Thông tin cá nhân
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="menu-dropdown-item">
                                <a href="#" class="menu-dropdown-link">
                                    Đặt lại mật khẩu
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="menu-dropdown-item">
                                <a href="" class="menu-dropdown-link">
                                    Đăng xuất
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            
                                    </svg>
                                </a>
                            </li>
                        </div>

                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>
