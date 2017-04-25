<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-menu nav-collapse">
        <!-- SIDEBAR MENU -->
        <ul>
        @foreach (app('config')->get('self.siderbars') as $node1)
            @if(empty($node1['children']))
                <li class="active">
                    <a href="{{ url($node1['node']) }}">
                        <i class="fa fa-fw {{$node1['icon']}}"></i>
                        <span class="menu-text">{{ $node1['title'] }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @else
                <li class="has-sub open">
                    <a href="javascript:;" class="">
                        <i class="fa fa-fw {{ $node1['icon'] }}"></i>
                        <span class="menu-text">{{ $node1['title'] }}</span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub" style="display: block;">
                    @foreach($node1['children'] as $node2)
                        @if(empty($node2['children']))
                            <li>
                                <a href="{{ url(implode('/', [$node1['node'], $node2['node']])) }}">
                                    <i class="fa fa-fw {{$node2['icon']}}"></i>
                                    <span class="sub-menu-text">
                                        {{ $node2['title'] }}
                                    </span>
                                </a>
                            </li>
                        @else
                            <li class="has-sub-sub">
                                <a href="javascript:;" class="">
                                    <i class="fa fa-fw {{$node2['icon']}}"></i>
                                    <span class="menu-text">{{$node2['title']}}</span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-sub" style="display: block;">
                                @foreach($node2['children'] as $node3)
                                    <li>
                                        <a href="{{ action(implode('\\', [$node1['node'], $node2['node'], $node3['node']]).'Controller@index') }}">
                                            {{--<i class="fa fa-fw {{$node3['icon']}}"></i>--}}
                                            <span class="sub-menu-text">
                                                {{ $node3['title'] }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
        </ul>
        <!-- /SIDEBAR MENU -->
    </div>
</div>
<!-- /SIDEBAR -->