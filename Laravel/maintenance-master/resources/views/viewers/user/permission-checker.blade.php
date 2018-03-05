<legend>Permission Checker</legend>

<div id="access-response"></div>

{!!
    Form::open([
        'url'=>route('maintenance.admin.users.check-access', [$user->id]),
        'class'=>'form-horizontal ajax-form-post',
        'data-status-target'=>'#access-response'
    ])
!!}


<div class="form-group">
    <label class="col-sm-2 control-label">Permission</label>

    <div class="col-md-4">
        {!! Form::text('permission', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Check', ['class'=>'btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}

<div class="clearfix"></div>
