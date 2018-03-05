<a class="btn btn-app"
   data-toggle="modal" data-target="#create-reading-modal"
>
    <i class="fa fa-dashboard"></i> Add a Meter
</a>

<div class="modal fade" id="create-reading-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Create a new Meter</h4>
            </div>

            {!!
                Form::open([
                    'url'=>route('maintenance.assets.meters.store', [$asset->id]),
                    'class'=>'form-horizontal ajax-form-post clear-form',
                    'data-status-target' => '#asset-meter-status',
                    'data-refresh-target' => '#asset-meters-table',
                ])
            !!}

            <div class="modal-body">

                <div id="asset-meter-status"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>

                    <div class="col-md-10">
                        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter a Name']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Reading</label>

                    <div class="col-md-10">
                        {!! Form::text('reading', null, ['class'=>'form-control', 'placeholder'=>'Enter the Current Reading']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Comment</label>

                    <div class="col-md-10">
                        {!! Form::text('comment', null, ['class'=>'form-control', 'placeholder'=> 'Enter a Comment for Reading']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Metric</label>

                    <div class="col-md-10">
                        @include('select.metric')
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
