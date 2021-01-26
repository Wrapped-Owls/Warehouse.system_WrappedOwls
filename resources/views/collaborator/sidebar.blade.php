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
                    <i class="fa fa-keyboard-o"></i>Actions
                </a>
                <ul class="sub-links">
                    <li><a href="{{ route('changeData.index') }}">Edit profile</a></li>
                    <li><a href="{{ route('item.index') }}">Request item</a></li>
                </ul>
            </div>
        </div>
    </aside>
</div>
