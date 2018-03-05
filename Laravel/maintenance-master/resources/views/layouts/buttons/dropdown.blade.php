@yield('dropdown.extra.top')

<div class="btn-group dropdown">
    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @section('dropdown.head.content')
            Action
            <span class="caret"></span>
        @show
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        @yield('dropdown.body.content')
    </ul>
</div>

@yield('dropdown.extra.bottom')
