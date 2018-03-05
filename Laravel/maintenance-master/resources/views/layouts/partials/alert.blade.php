<div class="row">
    <div class="col-md-12">
        <div id="alert-container">
            @if (isset($errors) && $errors->any())
                <div class="notifications alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
                    @if ($message = $errors->first(0, ':message'))
                        {{ $message }}
                    @else
                        There were errors with the form you've sent.
                    @endif
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="notifications alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
                    {!! $message !!}
                </div>
            @endif

            @if(Session::get('message'))
                <div class="alert alert-{{ Session::get('messageType') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i
                                class="fa fa-minus-square"></i></button>
                    {!! Session::get('message') !!}
                </div>
            @endif
        </div>
    </div>
</div>
