<?php

/*
 * Default Groups configuration file.
 */
return [

    /*
     * LDAP AD groups to assign Sentry groups to upon login.
     */
    'ldap' => [

        /*
         * The following AD groups will be given
         * the administrators group upon login.
         */
        'administrators' => [
            'IT Dept',
        ],

        /*
         * The following AD groups will be given
         * the workers group upon login.
         */
        'workers' => [
            'Maintenance',
        ],

    ],

];
