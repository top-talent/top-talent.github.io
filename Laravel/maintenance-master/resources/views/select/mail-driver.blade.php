{!!
    Form::select('mail_driver',[
        'smtp' => 'SMTP',
        'mail' => 'Mail',
        'sendmail' => 'SendMail',
        'mailgun' => 'Mailgun',
        'mandrill' => 'Mandrill',
        'log' => 'Log'
    ], (isset($driver) ? $driver : null)
    , [
        'class' => 'form-control'
    ])
!!}
