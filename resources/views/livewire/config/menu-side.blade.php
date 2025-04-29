<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @foreach($this->dataMenu as $key => $menu)
                @php
                    $requestUrl = '';
                    $active = '';
                    foreach ($menu['children'] as $subMenu) {
                        if(request()->fullUrl() === route($subMenu['route'])){
                            $requestUrl = 'menu-open';
                            $active = 'active';
                            break;
                        }
                    }
                @endphp
                <li class="nav-item {{ $requestUrl}} ">
                    @if(count($menu['children']) > 0)
                        @can($menu['permission'])
                        <a href="{{ route($menu['route']) }}" class="nav-link {{$active}}">
                            <i class="nav-icon {{$menu['icon']}}"></i>
                            <p>{{$menu['name']}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @foreach($menu['children'] as $subMenu)
                                @if(count($subMenu['children']) > 0)
                                    @can($subMenu['permission'])
                                    <a href="{{ route($subMenu['route']) }}" class="nav-link ml-2 {{ activeRoute(route( $subMenu['route'])) }}">
                                        <i class="nav-icon {{$subMenu['icon']}}"></i>
                                        <p>{{$subMenu['name']}}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    @endcan
                                @else
                                    <li class="nav-item">
                                        @can($subMenu['permission'])
                                        <a href="{{ route($subMenu['route']) }}" class="nav-link ml-2 {{ activeRoute(route( $subMenu['route'])) }}">
                                            <i class="nav-icon {{$subMenu['icon']}}"></i>
                                            <p>{{$subMenu['name']}}</p>
                                        </a>
                                    </li>
                                    @endcan
                                @endif
                            @endforeach
                        </ul>
                    @else
                        @can($menu['permission'])
                        <a href="{{ route($menu['route']) }}" class="nav-link {{ activeRoute(route( $menu['route'])) }}">
                            <i class="nav-icon {{$menu['icon']}}"></i>
                            <p>{{$menu['name']}}</p>
                        </a>
                        @endcan
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
