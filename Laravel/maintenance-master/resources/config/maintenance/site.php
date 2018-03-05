<?php

/**
 * Maintenance Application Site Configuration.
 */

return [
    /*
     * Prefix of the application (ex. http://www.example.com/maintenance/)
     */
    'prefix' => '/',

    /*
     * Title of the backend Application
     */
    'title' => [
        'main'   => 'Maintenance',
        'client' => 'Maintenance',
        'admin'  => 'Admin Panel',
    ],

    /*
     * Enter the API calendar keys you'd like to use for each different calendar.
     *
     * For example, if using Google calendar you could enter 'primary' on each entry below to use the same
     * calendar for every entry.
     */
    'calendars' => [
        'work-orders' => 'mycalendar@group.calendar.google.com',
        'inventories' => 'mycalendar@group.calendar.google.com',
        'assets'      => 'mycalendar@group.calendar.google.com',
    ],

    /*
     * LDAP Settings
     */
    'ldap' => [
        /*
         * Enables use of LDAP for logging in. You must publish the config
         * file of Stevebauman\Corp and fill in your settings to use LDAP.
         */
        'enabled' => true,

        'user_sync' => [

            /*
             * Enables the maintenance seeder to add LDAP users to the web database so they are visble
             * for assigning work orders and managing permissions.
             */
            'enabled' => true,

            /*
             * Filters for the user sync. Set enabled to false to allow all users detected on LDAP to be added
             */
            'filters' => [

                'enabled' => true,

                /*
                 * User groups to allow **MUST BE ARRAY IF ENABLED - FALSE OTHERWISE**
                 */
                'groups' => ['Maintenance', 'User Accounts'],

                /*
                 * User types to allow **MUST BE ARRAY IF ENABLED - FALSE OTHERWISE**
                 */
                'types' => ['Managers', 'Students'],
            ],
        ],
    ],
];
