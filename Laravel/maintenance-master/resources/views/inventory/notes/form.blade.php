<div class="modal-body">

    <div id="stock-location-status"></div>

    <div class="form-group">
        <label class="col-sm-1 control-label">Content</label>

        <div class="col-md-8">
            {!! Form::textarea('content', (isset($note) ? htmlspecialchars($note->content) : null), ['class'=>'form-control']) !!}

            <span class="label label-danger">{{ $errors->first('content', ':message') }}</span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>

</div>
