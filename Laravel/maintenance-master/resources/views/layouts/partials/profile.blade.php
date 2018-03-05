@if(auth()->check() && $user = auth()->user())
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i>
            <span>Profile <i class="caret"></i></span>
        </a>
        <ul class="dropdown-menu">

            <!-- Menu Body -->
            <li class="user-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->fullname }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    </tbody>
                </table>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-right">
                    <a href="{{ route('maintenance.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
            </li>

        </ul>
    </li>
@endif