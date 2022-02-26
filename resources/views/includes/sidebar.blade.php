<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{asset('assets/img/users/user.png')}}" alt="" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{Auth::user()->nama}}
                        <small><span class="label label-primary">{{(Auth::user()->type==1)?'SUPER ADMIN':'USER'}}</span></small>
                    </div>
                </a>
            </li>

        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Menus</li>

            <!-- begin sidebar minify button -->
            <!-- end sidebar minify button -->
            @foreach(Auth::user()->menus() as $parent)
            @if($parent->status==1)
            <li class="has-sub {{Session::get('parent') == $parent->nm_menu ? 'active':''}}">
                @if($parent->nm_menu!='Dashboard')
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa {{$parent->icon}}"></i>
                    <span>{{$parent->nm_menu}}</span>
                </a>
                <ul class="sub-menu">
                    @foreach(Auth::user()->menus() as $child)
                    @if ($child->status==0 AND $child->kd_parent==$parent->kd_menu)
                    <li class="{{Session::get('child') == $child->nm_menu ? 'active':''}}"><a href="{{url($child->route)}}">{{$child->nm_menu}} </a></li>
                    @endif
                    @endforeach
                </ul>
                @else
                <a href="{{$parent->route}}">

                    <i class="fa {{$parent->icon}}"></i>
                    <span>{{$parent->nm_menu}}</span>
                </a>
                @endif

            </li>

            @endif
            @endforeach
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>

        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>