<?php $sidebar_menus = [
    [
        'display' => 'Dashboard',
        'route' => 'admin.dashboard',
        'imag_path' => 'admin/images/dashboard_icon.svg',
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'sub_menus' => null,
    ],
    [
        'display' => 'Agent',
        'route' => 'admin.transactions.index',
        'imag_path' => 'admin/images/lottery.png',
        'icon' => 'bi bi-cash-coin',
        'sub_menus' => [
            [
                'display' => 'Create Agent',
                'route' => 'admin.agent.pendings',
                'imag_path' => null,
                'icon' => 'bi bi-cash-coin',
                'sub_menus' => null,
            ],
        ],
    ],
    [
        'display' => '2D Manager',
        'route' => 'admin.twod_manager.index',
        'imag_path' => 'admin/images/2d.svg',
        'icon' => null,
        'sub_menus' => [
            [
                'display' => 'Types',
                'route' => 'admin.twod_types.index',
                'imag_path' => null,
                'icon' => 'bi bi-card-list',
                'sub_menus' => null,
            ],
            [
                'display' => 'Schedules',
                'route' => 'admin.twod_schedules.index',
                'imag_path' => null,
                'icon' => 'bi bi-card-list',
                'sub_menus' => null,
            ],
            [
                'display' => 'Sections',
                'route' => 'admin.twod_sections.index',
                'imag_path' => null,
                'icon' => 'bi bi-card-list',
                'sub_menus' => null,
            ],
            [
                'display' => 'Winning Number Page',
                'route' => 'admin.twod_bet_slips.index',
                'imag_path' => null,
                'icon' => 'bi bi-check-circle',
                'sub_menus' => null,
            ],
            // [
            //     'display' => '2D Number setting',
            //     'route' => 'admin.twod_number_setting.index',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-gear',
            //     'sub_menus' => null,
            // ],
            // [
            //     'display' => '2D History',
            //     'route' => 'admin.twod_history.index',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-clock-history',
            //     'sub_menus' => null,
            // ],
        ],
    ],
    [
        'display' => '3D Manager',
        'route' => 'admin.threed.bet_slip.index',
        'imag_path' => 'admin/images/3d.svg',
        'icon' => null,
        'sub_menus' => [
            [
                'display' => 'Default Setting',
                'route' => 'admin.threed.default_settings.index',
                'imag_path' => null,
                'icon' => 'bi bi-box-fill',
                'sub_menus' => null,
            ],
            [
                'display' => 'Section',
                'route' => 'admin.threed.section.index',
                'imag_path' => null,
                'icon' => 'bi bi-calendar-month',
                'sub_menus' => null,
            ],
            // [
            //     'display' => '3D History',
            //     'route' => 'admin.threed_history.index',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-clock-history',
            //     'sub_menus' => null,
            // ],
        ],
    ],
    [
        'display' => 'ThaiLottery',
        'route' => 'admin.thaid.section.index',
        'imag_path' => 'admin/images/lottery.png',
        'icon' => null,
        'sub_menus' => [
            [
                'display' => 'Section',
                'route' => 'admin.thaid.section.index',
                'imag_path' => null,
                'icon' => 'bi bi-calendar-month',
                'sub_menus' => null,
            ],
            // [
            //     'display' => 'Number(Tickets) Detail',
            //     'route' => 'admin.thai_lottery_number_detail.index',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-card-list',
            //     'sub_menus' => null,
            // ],
            // [
            //     'display' => 'Section',
            //     'route' => 'admin.thaidsection.list',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-check-circle',
            //     'sub_menus' => null,
            // ],
            // [
            //     'display' => 'Price',
            //     'route' => 'admin.thaidprice.list',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-gear',
            //     'sub_menus' => null,
            // ],
            // [
            //     'display' => 'Thai lottery History',
            //     'route' => 'admin.thai_lottery_history.index',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-clock-history',
            //     'sub_menus' => null,
            // ],
            //  [
            //     'display' => 'Winner',
            //     'route' => 'admin.thaid.winner',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-clock-history',
            //     'sub_menus' => null,
            // ],
            //  [
            //     'display' => 'Winner List',
            //     'route' => 'admin.winner.list',
            //     'imag_path' => null,
            //     'icon' => 'bi bi-clock-history',
            //     'sub_menus' => null,
            // ],
        ],
    ],
    [
        'display' => 'Payment',
        'route' => 'admin.transactions.index',
        'imag_path' => 'admin/images/lottery.png',
        'icon' => 'bi bi-cash-coin',
        'sub_menus' => [
            [
                'display' => 'Deposit/Withdraw',
                'route' => 'admin.payment.listdandw',
                'imag_path' => null,
                'icon' => 'bi bi-cash-coin',
                'sub_menus' => null,
            ],
        ],
    ],
    [
        'display' => 'Customers Manager',
        'route' => 'admin.customers.index',
        'imag_path' => 'admin/images/user.svg',
        'icon' => null,
        'sub_menus' => null,
    ],
    [
        'display' => 'Support Manager',
        'route' => 'admin.support.index',
        'imag_path' => 'admin/images/user.svg',
        'icon' => null,
        'sub_menus' => null,
    ],
    [
        'display' => 'Transactions',
        'route' => 'admin.agents.index',
        'imag_path' => null,
        'icon' => 'bi bi-person-square',
        'sub_menus' => null,
    ],
    [
        'display' => 'Calendar',
        'route' => 'admin.calendar.index',
        'imag_path' => null,
        'icon' => 'bi bi-person-square',
        'sub_menus' => null,
    ],
    [
        'display' => 'Closing Days',
        'route' => 'admin.closing-days.index',
        'imag_path' => 'admin/images/lottery.png',
        'icon' => null,
        'sub_menus' => null,
    ],
];
?>



<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="" class="brand-link text-center p-0 pt-3">
        <img src="{{ asset('admin/images/logo.svg') }}" alt="AdminLTE Logo" style="height: 30px">
        <br>
        <h6 class="text-white font-weight-bold">Lottery Tickets System</h6>
    </a>

    <!-- Sidebar -->
    <div class="sidebar pt-3">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($sidebar_menus as $key => $menu)
                    <li class="nav-item">
                        <div
                            class="nav-link d-flex justify-content-between menu-open {{ Request::routeIs($menu['route']) ? 'bg-light' : '' }}">

                            <a href="{{ route($menu['route']) }}">
                                @if ($menu['imag_path'])
                                    <img src="{{ asset($menu['imag_path']) }}" alt="AdminLTE Logo" style="height: 30px">
                                @else
                                    &nbsp;<i style="font-size: 25px;position: relative;top:10px"
                                        class="{{ $menu['icon'] }}"></i>
                                @endif
                                <p class="ml-2">{{ $menu['display'] }}
                                </p>
                            </a>
                            @if ($menu['sub_menus'])
                                <button onclick="showSubMenu('{{ $key }}_menu')" class="btn btn-sm">
                                    <i class="bi bi-caret-down-fill text-info"></i></button>
                            @endif
                        </div>

                        {{-- sub-menu --}}
                        @if ($menu['sub_menus'])
                            <ul class="nav d-none" id="{{ $key }}_menu">
                                @foreach ($menu['sub_menus'] as $sub_menu)
                                    <li class="nav-item {{ Request::routeIs($sub_menu['route']) ? 'bg-light' : '' }}">
                                        <a href="{{ route($sub_menu['route']) }}" class="nav-link text-info">
                                            <i class="ml-4 {{ $sub_menu['icon'] }}"></i>
                                            <p class="ml-1">{{ $sub_menu['display'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </li>
                @endforeach


                <!-- Logout link -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right mr-2 ml-1" style="font-size: 26px"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </div>

</aside>

<script>
    function showSubMenu(id) {
        var elementToToggle = document.getElementById(id);
        console.log(elementToToggle);
        elementToToggle.classList.toggle('d-none');
    }
</script>
