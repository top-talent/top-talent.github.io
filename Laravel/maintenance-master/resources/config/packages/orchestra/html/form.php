<?php

return [

    /*
    |----------------------------------------------------------------------
    | Default Error Message String
    |----------------------------------------------------------------------
    |
    | Set default error message string format for Orchestra\Form.
    |
    */

    'format' => '<span class="label label-danger">:message</span>',

    /*
    |----------------------------------------------------------------------
    | Default Submit Button String
    |----------------------------------------------------------------------
    |
    | Set default submit button string or language replacement key for
    | Orchestra\Form.
    |
    */

    'submit' => 'orchestra/foundation::label.submit',

    /*
    |----------------------------------------------------------------------
    | Default View Layout
    |----------------------------------------------------------------------
    |
    | Orchestra\Html\Form would require a View to parse the provided form
    | instance.
    |
    */

    'view' => 'components.form',

    /*
    |----------------------------------------------------------------------
    | Layout Configuration
    |----------------------------------------------------------------------
    |
    | Set default attributes for Orchestra\Html\Form.
    |
    */

    'templates' => [
        'input'    => ['class' => 'col-md-12 input-with-feedback'],
        'password' => ['class' => 'col-md-12 input-with-feedback'],
        'select'   => ['class' => 'col-md-12 input-with-feedback'],
        'textarea' => ['class' => 'col-md-12 input-with-feedback'],
    ],

    /*
    |----------------------------------------------------------------------
    | Presenter
    |----------------------------------------------------------------------
    |
    | Set default presenter class for Orchestra\Html\Form.
    |
    */

    'presenter' => Orchestra\Html\Form\BootstrapThreePresenter::class,

];
