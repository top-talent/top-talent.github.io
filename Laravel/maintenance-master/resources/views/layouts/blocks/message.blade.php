<div class="item">

    <img src="{{ asset('img/user.jpg') }}" alt="user image" class="online"/>

    <p class="message">
    @yield('message.body.content')

    <div class="tools pull-right">
        @yield('message.tools.content')
    </div>
    </p>

</div>
