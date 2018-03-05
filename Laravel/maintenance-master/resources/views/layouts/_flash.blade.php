@if(session()->has('flash_message'))
    <script type="text/javascript">
        swal({
            title: "{!! session('flash_message.title') !!}",
            text: "{!! session('flash_message.message') !!}",
            type: "{!!session('flash_message.level') !!}",
            @if(session('flash_message.timer')) timer: "{!! session('flash_message.timer') !!}" @endif
        });
    </script>
@endif
