<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Username Attribute
    |--------------------------------------------------------------------------
    |
    | The username attribute is an array of the html input name and the LDAP
    | attribute to discover the user by. The reason for this is to hide
    | the attribute that you're using to login users.
    |
    | For example, if your input name is `username` and you'd like users
    | to login by their `samaccountname` attribute, then keep the
    | configuration below. However, if you'd like to login users
    | by their emails, then change `samaccountname` to `mail`.
    | and `username` to `email`.
    |
    */

    'username_attribute' => ['email' => 'mail'],

    /*
    |--------------------------------------------------------------------------
    | Login Attribute
    |--------------------------------------------------------------------------
    |
    | The login attribute is the name of the active directory user property
    | that you use to log users in. For example, if your company uses
    | email, then insert `mail`.
    |
    */

    'login_attribute' => env('ADLDAP_LOGIN_ATTRIBUTE'),

    /*
    |--------------------------------------------------------------------------
    | Bind User to Model
    |--------------------------------------------------------------------------
    |
    | The bind User to Model option allows you to access the Adldap user model
    | instance on your laravel database model to be able run operations
    | or retrieve extra attributes on the Adldap user model instance.
    |
    | If this option is true, you must insert the trait:
    |
    |   `Adldap\Laravel\Traits\AdldapUserModelTrait`
    |
    | Onto your User model configured in `config/auth.php`.
    |
    | Then use `Auth::user()->adldapUser` to access.
    |
    */

    'bind_user_to_model' => env('ADLDAP_BIND_USER_TO_MODEL'),

    /*
    |--------------------------------------------------------------------------
    | Sync Attributes
    |--------------------------------------------------------------------------
    |
    | Attributes specified here will be added / replaced on the user model
    | upon login, automatically synchronizing and keeping the attributes
    | up to date.
    |
    | The array key represents the Laravel model key, and the value
    | represents the Active Directory attribute to set it to.
    |
    | The users email is already synchronized and does not need to be
    | added to this array.
    |
    */

    'sync_attributes' => [

        'fullname' => 'cn',

        'from_ad' => 'App\Handlers\LdapAttributeHandler@fromAd',

    ],

    /*
    |--------------------------------------------------------------------------
    | Select Attributes
    |--------------------------------------------------------------------------
    |
    | Attributes to select upon the user on authentication and binding.
    |
    | If no attributes are given inside the array, all attributes on the
    | user are selected.
    |
    */

    'select_attributes' => [

        //

    ],

];
