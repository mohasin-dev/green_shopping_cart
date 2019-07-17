<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('images/user/'. Auth::user()->image) }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">

                    <li>
                        <a href="#"><i class="material-icons">settings</i>Theme Settings</a>
                    </li>

                    <li role="seperator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}">
                        <i class="material-icons">apps</i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/sale*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sale.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Manage Order</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/coupon*') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupon.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Coupons</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/slider*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Slider</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subcategory*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subcategory.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Subcategory</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tag.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/size*') ? 'active' : '' }}">
                    <a href="{{ route('admin.size.index') }}">
                        <i class="material-icons">apps</i>
                        <span>size</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/color*') ? 'active' : '' }}">
                    <a href="{{ route('admin.color.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Colors</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/unit*') ? 'active' : '' }}">
                    <a href="{{ route('admin.unit.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Unit</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/testimonial*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonial.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Testimonial</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/client*') ? 'active' : '' }}">
                    <a href="{{ route('admin.client.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Clients/Patners</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscriber*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscriber') }}">
                        <i class="material-icons">apps</i>
                        <span>Subscribers</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/change-password') ? 'active' : '' }}">
                    <a href="{{ route('admin.change_password') }}">
                        <i class="material-icons">apps</i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/setting*') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.edit') }}">
                        <i class="material-icons">apps</i>
                        <span>Settings</span>
                    </a>
                </li>

               {{--  <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Product</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/skill*') ? 'active' : '' }}">
                    <a href="{{ route('admin.skill.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Skill</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/service*') ? 'active' : '' }}">
                    <a href="{{ route('admin.service.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Service</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/testimonial*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonial.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Testimonial</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/study*') ? 'active' : '' }}">
                    <a href="{{ route('admin.study.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Education</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/experience*') ? 'active' : '' }}">
                    <a href="{{ route('admin.experience.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Experience</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/counter*') ? 'active' : '' }}">
                    <a href="{{ route('admin.counter.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Counter</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/blog*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blog.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Blog</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscriber*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscriber.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Subscriber</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/social-link*') ? 'active' : '' }}">
                    <a href="{{ route('admin.social-link.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Social Link</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Profile</span>
                    </a>
                </li>
                {{-- <li class="{{ Request::is('admin/password*') ? 'active' : '' }}">
                    <a href="{{ route('admin.password.edit') }}">
                        <i class="material-icons">apps</i>
                        <span>Profile</span>
                    </a>
                </li> --}}
                {{-- <li class="header">System</li>

                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="material-icons">settings</i>
                        <span>Customize Settings</span>
                    </a>
                </li>  --}}

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            @if(Request::is('user*'))
            <li class="{{ Request::is('user/dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('user/profile*') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}">
                    <i class="material-icons">apps</i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="{{ Request::is('user/order*') ? 'active' : '' }}">
                <a href="{{ route('user.order') }}">
                    <i class="material-icons">apps</i>
                    <span>My Orders</span>
                </a>
            </li>
            <li class="{{ Request::is('user/change-password') ? 'active' : '' }}">
                <a href="{{ route('user.change_password') }}">
                    <i class="material-icons">apps</i>
                    <span>Change Password</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2017 - 2019 <a href="http://intezie.com">Developed By - Intezie Limited</a>.
        </div>
        <div class="version">
            <b>Version: </b> 5.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
