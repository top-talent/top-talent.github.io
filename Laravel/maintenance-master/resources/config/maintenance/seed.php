<?php

return [

    /*
     * The maintenance application installation seeds. They are completely optional.
     */
    'priorities' => [
        [
            'name'  => 'Low',
            'color' => 'default',
        ],
        [
            'name'  => 'Medium',
            'color' => 'warning',
        ],
        [
            'name'  => 'High',
            'color' => 'danger',
        ],
        [
            'name'  => 'Requested',
            'color' => 'default',
        ],
    ],

    'statuses' => [
        [
            'name'  => 'Open',
            'color' => 'danger',
        ],
        [
            'name'  => 'Closed',
            'color' => 'success',
        ],
        [
            'name'  => 'In Progress',
            'color' => 'warning',
        ],
        [
            'name'  => 'Requested',
            'color' => 'default',
        ],
    ],

    'metrics' => [
        [
            'name'   => 'Pieces',
            'symbol' => 'Pc',
        ],
        [
            'name'   => 'Grams',
            'symbol' => 'G',
        ],
        [
            'name'   => 'Kilograms',
            'symbol' => 'Kg',
        ],
        [
            'name'   => 'Tonnes',
            'symbol' => 'T',
        ],
        [
            'name'   => 'Millilitres',
            'symbol' => 'mL',
        ],
        [
            'name'   => 'Litres',
            'symbol' => 'L',
        ],
    ],

];
