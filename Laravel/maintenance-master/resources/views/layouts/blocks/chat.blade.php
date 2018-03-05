<div class="box box-solid">
    {{--
        Body attributes need to be defined inside the child view because of blade
        rendering blank spaces
    --}}
    <div @yield('chat.body.attributes') class="box-body chat">
        <!-- chat item -->
        @yield('chat.body.content')
    </div>
    <!-- /.chat -->

    <div class="box-footer">
        @yield('chat.foot.content')
    </div>
</div>
