<div class="col-md-1 container-fluid">
    <aside class="sidebar-left-collapse">
        <h2 align="center">
            <a href="{{ url('/home') }}" class="company-logo">
                <img class="img" src="{{ asset('img/logo.png') }}" alt=""/>
            </a>
        </h2>
        <div class="sidebar-links">
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>User
                </a>
                <ul class="sub-links">
                    @if((auth()->user()->access_level) > 2)
                        <li><a href="{{ route('register') }}">Add</a></li>
                        <li><a href="{{ route('activities.index') }}">Activity logs</a></li>
                    @endif
                    <li><a href="{{ route('changeData.index') }}">Edit profile</a></li>
                    <li><a href="{{ route('user.index') }}">Management</a></li>
                </ul>
            </div>
            <div class="link-red">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Product
                </a>
                <ul class="sub-links">
                    @if((auth()->user()->access_level) >  2)
                        <li><a href="{{ route('product.create') }}">Add</a></li>
                    @endif
                    <li><a href="{{ route('product.index') }}">List</a></li>
                </ul>
            </div>
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Items
                </a>
                <ul class="sub-links">
                    <li><a href="{{ route('inout.index') }}">List</a></li>
                    <li><a href="{{ route('request_admin') }}">Direct request</a></li>
                </ul>
            </div>
            @if((auth()->user()->access_level) >  2)
                <div class="link-red">
                    <a href="#">
                        <i class="fa fa-keyboard-o"></i>Area
                    </a>
                    <ul class="sub-links">
                        <li><a href="{{ route('area.create') }}">Add</a></li>
                        <li><a href="{{ route('area.index') }}">List</a></li>
                        <li><a href="{{ route('inout.create') }}">Associate product</a></li>
                    </ul>
                </div>
            @endif
            <div class="link-blue">
                <a href="#">
                    <i class="fa fa-keyboard-o"></i>Records
                </a>
                <ul class="sub-links">
                    <li><a href="{{ route('approved_requests') }}">Requests</a></li>
                    @if((auth()->user()->access_level) >  2)
                        <li><a href="{{ route('reportPage') }}">Reports</a></li>
                    @endif
                </ul>
            </div>
            @if((auth()->user()->access_level) > 2)
                <div class="link-red">
                    <a href="{{ route('backup.index') }}">
                        <i class="fa fa-keyboard-o"></i>Backup
                    </a>
                </div>
            @endif

        </div>
    </aside>
</div>
