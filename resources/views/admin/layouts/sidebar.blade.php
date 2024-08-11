<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{ url('/dashboard') }}">
                <div class="logo-img">

                </div>
                <span class="text">AndironValley</span>
            </a>
            <button type="button" class="nav-toggle"><i data-toggle="expanded"
                    class="ik ik-toggle-right toggle-icon"></i></button>
            <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
        </div>
        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">

                    {{-- Welcomme Screen --}}
                    @if (auth()->check())
                        <div class="nav-lavel">Register</div>
                        <div class="nav-item active">
                            <a href="{{ route('my_welcome') }}"><i class="ik ik-bar-chart-2"></i>Welcome</a>
                        </div>
                    @else
                    @endif


                    {{-- Registration Assistant --}}
                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="nav-lavel">Register</div>
                        <div class="nav-item active">
                            <a href="{{ url('register') }}"><i class="ik ik-bar-chart-2"></i><span>Add
                                    Assistant</span></a>
                        </div>
                    @else
                    @endif


                    <div class="nav-lavel">Navigation</div>
                    {{-- Dashboard --}}
                    @if (auth()->check())
                        <div class="nav-item active">
                            <a href="{{ url('dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                        </div>
                    @else
                    @endif


                    {{-- Manage Topic --}}
                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="nav-item has-sub {{ request()->routeIs('topics*') ? 'open' : '' }}">
                            <a href="javascript:void(0)"><i class="ik ik-folder"></i><span>Manage Topic</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('topics.create') }}"
                                    class="menu-item {{ request()->routeIs('topics.create') ? 'active' : '' }}">Add
                                    Topic</a>
                                <a href="{{ route('topics.index') }}"
                                    class="menu-item {{ request()->routeIs('topics.index') ? 'active' : '' }}">View
                                    Topics</a>
                            </div>
                        </div>
                    @else
                    @endif



                    {{-- Date Time Management --}}
                    @if (auth()->check())
                        <div
                            class="nav-item has-sub {{ request()->routeIs('date-times.create') || request()->routeIs('date-times.index') || request()->routeIs('date-times.show') ? 'open' : '' }}">
                            <a href="javascript:void(0)" id="datetime_section"><i class="ik ik-clock"></i><span>DateTime
                                    Management</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('date-times.create') }}"
                                    class="menu-item {{ request()->routeIs('date-times.create') ? 'active' : '' }}">Add
                                    New Time</a>
                                <a href="{{ route('date-times.index') }}"
                                    class="menu-item {{ request()->routeIs('date-times.index') || request()->routeIs('date-times.show') ? 'active' : '' }}">View
                                    Times</a>
                            </div>
                        </div>
                    @else
                    @endif


                    {{-- Manual API News --}}
                    <div class="nav-lavel">Functionality</div>
                    @if (auth()->check())
                        <div
                            class="nav-item has-sub {{ request()->routeIs('manual.create.notification') || request()->routeIs('manual.show.notification') || request()->routeIs('manual.show.notification.single') ? 'open' : '' }}">
                            <a href="javascript:void(0)" id="manual_api_top_news_section"><i
                                    class="ik ik-bell"></i><span>Manual API News</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('manual.create.notification') }}"
                                    class="menu-item {{ request()->routeIs('manual.create.notification') ? 'active' : '' }}">Set
                                    Top News</a>
                                <a href="{{ route('manual.show.notification') }}"
                                    class="menu-item {{ request()->routeIs('manual.show.notification') || request()->routeIs('manual.show.notification.single') ? 'active' : '' }}">View
                                    Top Notifications</a>
                            </div>
                        </div>
                    @else
                    @endif


                    {{-- Send Notification --}}
                    @if (auth()->check() && auth()->user()->is_admin)
                        <div
                            class="nav-item has-sub {{ request()->routeIs('notifications.show') || request()->routeIs('scheduled.notifications') || request()->routeIs('create.notification') || request()->routeIs('single.notifications.show') ? 'open' : '' }}">
                            <a href="javascript:void(0)" id="send_push_notice_section"><i
                                    class="ik ik-send"></i><span>Send
                                    Notification</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('create.notification') }}"
                                    class="menu-item {{ request()->routeIs('create.notification') ? 'active' : '' }}">Create
                                    Notification</a>
                                <a href="{{ route('notifications.show') }}"
                                    class="menu-item {{ request()->routeIs('notifications.show') || request()->routeIs('single.notifications.show') ? 'active' : '' }}">View
                                    Notifications</a>
                                <a href="{{ route('scheduled.notifications') }}"
                                    class="menu-item {{ request()->routeIs('scheduled.notifications') ? 'active' : '' }}">View
                                    Scheduled Notifications</a>
                            </div>
                        </div>
                    @else
                    @endif


                    {{-- API Logs --}}

                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="nav-lavel">Analytics</div>
                        <div class="nav-item has-sub {{ request()->segment(2) === 'query' ? 'open' : '' }}">
                            <a href="javascript:void(0)" id="api_log_section"><i class="ik ik-list"></i><span>API
                                    Logs</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('api-logs.query', 'all-requests') }}"
                                    class="menu-item {{ request()->is('api-logs/query/all-requests') ? 'active' : '' }}">All
                                    API Calls</a>
                                <a href="{{ route('api-logs.query', 'successful-requests') }}"
                                    class="menu-item {{ request()->is('api-logs/query/successful-requests') ? 'active' : '' }}">Successful
                                    API Calls</a>
                                <a href="{{ route('api-logs.query', 'redirected-requests') }}"
                                    class="menu-item {{ request()->is('api-logs/query/redirected-requests') ? 'active' : '' }}">Redirected
                                    API Calls</a>
                                <a href="{{ route('api-logs.query', 'most-called-endpoints') }}"
                                    class="menu-item {{ request()->is('api-logs/query/most-called-endpoints') ? 'active' : '' }}">Most
                                    Called Endpoints</a>
                                <a href="{{ route('api-logs.query', 'unique-tokens') }}"
                                    class="menu-item {{ request()->is('api-logs/query/unique-tokens') ? 'active' : '' }}">Unique
                                    Token Calls</a>
                                <a href="{{ route('api-logs.query', 'calls-by-date') }}"
                                    class="menu-item {{ request()->is('api-logs/query/calls-by-date') ? 'active' : '' }}">API
                                    Calls Over Date</a>
                                <a href="{{ route('api-logs.query', 'calls-by-month') }}"
                                    class="menu-item {{ request()->is('api-logs/query/calls-by-month') ? 'active' : '' }}">API
                                    Calls Over Month</a>
                                <a href="{{ route('api-logs.query', 'daily-unique-tokens') }}"
                                    class="menu-item {{ request()->is('api-logs/query/daily-unique-tokens') ? 'active' : '' }}">Daily
                                    Unique Token Calls</a>
                                <a href="{{ route('api-logs.query', 'monthly-unique-tokens') }}"
                                    class="menu-item {{ request()->is('api-logs/query/monthly-unique-tokens') ? 'active' : '' }}">Monthly
                                    Unique Token Calls</a>
                                <a href="{{ route('api-logs.query', 'status-codes-summary') }}"
                                    class="menu-item {{ request()->is('api-logs/query/status-codes-summary') ? 'active' : '' }}">Status
                                    Codes Summary</a>
                                <a href="{{ route('api-logs.query', 'failed-requests') }}"
                                    class="menu-item {{ request()->is('api-logs/query/failed-requests') ? 'active' : '' }}">Failed
                                    API Calls</a>
                                <a href="{{ route('api-logs.query', 'error-codes') }}"
                                    class="menu-item {{ request()->is('api-logs/query/error-codes') ? 'active' : '' }}">Most
                                    Common Error Codes</a>
                                <a href="{{ route('api-logs.query', 'slowest-calls') }}"
                                    class="menu-item {{ request()->is('api-logs/query/slowest-calls') ? 'active' : '' }}">Slowest
                                    API Calls</a>
                            </div>
                        </div>
                    @else
                    @endif


                    {{-- Others --}}
                    @if (auth()->check() && auth()->user()->is_admin)
                        <div class="nav-lavel">Others</div>
                        <!-- New Sidebar Item for Delete Records -->
                        <div class="nav-item {{ request()->routeIs('delete-news.form') ? 'active' : '' }}">
                            <a href="{{ route('delete-news.form') }}"><i class="ik ik-trash-2"></i><span>Delete
                                    Records</span></a>
                        </div>
                    @else
                    @endif


                    <div class="nav-lavel">Logout</div>
                    @if (auth()->check())
                        <div class="nav-item has-sub">
                            <div class="nav-item active">
                                <div class="nav-item active">
                                    {{-- <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                        href="/logout"><i
                                            class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                                    <form id="logout-form" action="logout" method="POST" style="display: none;">
                                        @csrf
                                    </form> --}}



                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"><i
                                                class="ik ik-power"></i><span>Logout</span></a>
                                    </form>
                                </div>
                            </div>
                    @endif


                    <div class="nav-lavel">Designed By : Plaban Das</div>
                </nav>
            </div>
        </div>

    </div>
