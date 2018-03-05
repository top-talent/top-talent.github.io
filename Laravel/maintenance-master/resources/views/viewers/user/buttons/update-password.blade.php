<a href=""
   data-target="#update-user-password-modal"
   data-toggle="modal"
   class="btn btn-app no-print">
    <i class="fa fa-key"></i> Update Password
</a>

<div class="modal fade" id="update-user-password-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Update Password</h4>
            </div>

            {!!
                Form::open([
                    'url' => route('maintenance.admin.users.password.update', [$user->id]),
                    'method' => 'PATCH',
                    'class' => 'form-horizontal ajax-form-post clear-form',
                    'data-status-target' => '#reset-password-status'
                ])
            !!}

            <div class="modal-body">

                <div id="reset-password-status"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Password:</label>

                    <div class="col-md-10">
                        {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'Enter Password']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm Password:</label>

                    <div class="col-md-10">
                        {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder' => 'Confirm Above Password']) !!}
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
