<div class="box box-solid box-@section('widget.color')default @show @section('widget.collapse')collapsed-box @show">
    @section('widget.head')
        <div class="box-header">
            <h3 class="box-title">@yield('widget.title.content')</h3>
            <div class="box-tools pull-right">
                @section('widget.tools.content')
                    <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                @show
            </div>
        </div>
    @show

    @section('widget.body')
        <div class="box-body">
            @yield('widget.body.content')
        </div><!-- /.box-body -->
    @show
</div>
