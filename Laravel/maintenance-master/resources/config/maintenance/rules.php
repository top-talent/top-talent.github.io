<?php

/**
 * The maintenance application rules. The rules indicate
 * the result of certain functionality throughout the application.
 */
return [

    /*
     * User rules
     */
    'users' => [

        /*
         * If enabled, users will be sent an email when registering for an account, or and account
         * is created in the administration panel and 'activated' is not checked
         */
        'require_activation_by_email' => false,
    ],

    /*
     * Notification rules
     */
    'notifications' => [

        /*
         * Set this to true if you would like to send a notification to the user
         * who caused the notification to be generated
         */
        'prevent_sending_to_source' => true,

    ],

    /*
     * Meter rules
     */
    'meters' => [

        /*
         * Set this to true if you want to prevent a new reading from being created
         * if they equal the same number. This can be handy if you only want new
         * records when the reading actually changes.
         */
        'prevent_duplicate_entries' => true,

    ],

    /*
     * Work Order rules
     */
    'work-orders' => [

        /*
         * Set enabled to true if you want to prevent a lot of work order updates
         * (technician or customer) from being created. Set the minutes apart
         * they must be submitted by.
         *
         * Ex. If a technician posts an update, he cannot create another update for
         * 5 minutes.
         *
         */
        'prevent_spam_updates' => [
            'enabled'       => 'true',
            'minutes_apart' => '5',
        ],

        /*
         * Set this to true if you'd like to automatically generate
         * a work order from a submitted work request.
         */
        'auto_generate_from_request' => true,

    ],

    /*
     * Work Request rules
     */
    'work-requests' => [

        /*
         * The status for the work order that's generated when a work request
         * is created
         */
        'submission_status' => [
            'name'  => 'Requested',
            'color' => 'default',
        ],

        /*
         * The priority for the work order that's generated when a work request
         * is created
         */
        'submission_priority' => [
            'name'  => 'Requested',
            'color' => 'default',
        ],

    ],
];
