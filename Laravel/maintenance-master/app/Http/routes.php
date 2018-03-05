<?php

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
*/

/* @var Router $router */
$router->group(['middleware' => ['web']], function (Router $router) {
    $router->group(['as' => 'maintenance.'], function (Router $router) {
        // Welcome Route
        $router->get('/', ['as' => 'welcome.index', 'uses' => 'WelcomeController@index']);

        // Permission Denied Route
        $router->get('permission-denied', ['as' => 'permission-denied.index', 'uses' => 'PermissionDeniedController@getIndex']);

        // Authentication Routes
        $router->group(['prefix' => 'login', 'as' => 'login.', 'middleware' => ['guest']], function (Router $router) {
            $router->get('/', ['as' => 'index', 'uses' => 'AuthController@login']);

            $router->post('/', ['as' => 'authenticate', 'uses' => 'AuthController@authenticate']);
        });

        $router->group(['middleware' => ['auth']], function (Router $router) {
            $router->get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
        });

        // Registration Routes
        $router->group(['prefix' => 'register'], function (Router $router) {
            $router->get('/', ['as' => 'register', 'uses' => 'AuthController@getRegister']);

            $router->post('/', ['as' => 'register', 'uses' => 'AuthController@postRegister']);
        });

        // Client Routes
        $router->group(['prefix' => 'client', 'as' => 'client.', 'namespace' => 'Client', 'middleware' => ['auth']], function (Router $router) {
            $router->group(['namespace' => 'WorkRequest', 'as' => 'work-requests.'], function (Router $router) {
                $router->resource('work-requests', 'Controller', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);

                $router->resource('work-requests.updates', 'UpdateController', [
                    'only' => [
                        'store',
                        'destroy',
                    ],
                    'names' => [
                        'store'   => 'updates.store',
                        'destroy' => 'updates.destroy',
                    ],
                ]);
            });
        });

        // Management Routes
        $router->group(['prefix' => 'management', 'middleware' => ['auth']], function (Router $router) {
            $router->get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

            // Event Routes
            $router->group(['namespace' => 'Event', 'as' => 'events.'], function (Router $router) {
                $router->resource('events', 'Controller', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);

                $router->resource('events.report', 'ReportController', [
                    'except' => [
                        'index',
                        'show',
                    ],
                    'names' => [
                        'store'   => 'report.store',
                        'edit'    => 'report.edit',
                        'update'  => 'report.update',
                        'destroy' => 'report.destroy',
                    ],
                ]);
            });

            // Work Request Routes
            $router->group(['namespace' => 'WorkRequest', 'as' => 'work-requests.'], function (Router $router) {
                $router->resource('work-requests', 'WorkRequestController', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);

                $router->resource('work-requests.updates', 'UpdateController', [
                    'only' => [
                        'store',
                        'destroy',
                    ],
                    'names' => [
                        'store'   => 'updates.store',
                        'destroy' => 'updates.destroy',
                    ],
                ]);
            });

            // Work Order Routes
            $router->group(['as' => 'work-orders.', 'namespace' => 'WorkOrder'], function (Router $router) {
                $router->group(['prefix' => 'work-orders'], function (Router $router) {
                    $router->get('assigned', ['as' => 'assigned.index', 'uses' => 'WorkOrderAssignedController@index']);

                    // Work Order Priority Routes
                    $router->resource('priorities', 'WorkOrderPriorityController', [
                        'except' => [
                            'show',
                        ],
                        'names' => [
                            'index'   => 'priorities.index',
                            'create'  => 'priorities.create',
                            'store'   => 'priorities.store',
                            'show'    => 'priorities.show',
                            'edit'    => 'priorities.edit',
                            'update'  => 'priorities.update',
                            'destroy' => 'priorities.destroy',
                        ],
                    ]);

                    // Work Order Status Routes
                    $router->resource('statuses', 'WorkOrderStatusController', [
                        'except' => [
                            'show',
                        ],
                        'names' => [
                            'index'   => 'statuses.index',
                            'create'  => 'statuses.create',
                            'store'   => 'statuses.store',
                            'show'    => 'statuses.show',
                            'edit'    => 'statuses.edit',
                            'update'  => 'statuses.update',
                            'destroy' => 'statuses.destroy',
                        ],
                    ]);

                    // Work Order Category Routes
                    $router->resource('categories', 'CategoryController', [
                        'except' => [
                            'show',
                        ],
                        'names' => [
                            'index'   => 'categories.index',
                            'create'  => 'categories.create',
                            'store'   => 'categories.store',
                            'edit'    => 'categories.edit',
                            'update'  => 'categories.update',
                            'destroy' => 'categories.destroy',
                        ],
                    ]);

                    $router->get('categories/create/{categories}', ['as' => 'categories.nodes.create', 'uses' => 'CategoryController@create']);

                    $router->post('categories/create/{categories?}', ['as' => 'categories.nodes.store', 'uses' => 'CategoryController@store']);

                    // Nested Work Order Routes
                    $router->group(['prefix' => '{work_orders}'], function (Router $router) {
                        // Work Order Session Routes
                        $router->get('sessions', ['as' => 'sessions.index', 'uses' => 'WorkOrderSessionController@index']);

                        $router->post('sessions/start', ['as' => 'sessions.start', 'uses' => 'WorkOrderSessionController@start']);

                        $router->post('sessions/end', ['as' => 'sessions.end', 'uses' => 'WorkOrderSessionController@end']);

                        // Work Order Comment Routes
                        $router->resource('comments', 'WorkOrderCommentController', [
                            'only' => [
                                'store',
                                'destroy',
                            ],
                            'names' => [
                                'store'   => 'comments.store',
                                'destroy' => 'comments.destroy',
                            ],
                        ]);

                        // Work Order Assignment Routes
                        $router->resource('assignments', 'AssignmentController', [
                            'only' => [
                                'index',
                                'create',
                                'store',
                                'destroy',
                            ],
                            'names' => [
                                'index'   => 'assignments.index',
                                'create'  => 'assignments.create',
                                'store'   => 'assignments.store',
                                'destroy' => 'assignments.destroy',
                            ],
                        ]);

                        // Work Order Report Routes
                        $router->resource('report', 'WorkOrderReportController', [
                            'except' => [
                                'index',
                            ],
                            'names' => [
                                'create'  => 'report.create',
                                'store'   => 'report.store',
                                'show'    => 'report.show',
                                'edit'    => 'report.edit',
                                'update'  => 'report.update',
                                'destroy' => 'report.destroy',
                            ],
                        ]);

                        // Work Order Attachment Routes
                        $router->get('attachments/{attachments}/download', ['as' => 'attachments.download', 'uses' => 'WorkOrderAttachmentController@download']);

                        $router->resource('attachments', 'WorkOrderAttachmentController', [
                            'names' => [
                                'index'   => 'attachments.index',
                                'create'  => 'attachments.create',
                                'store'   => 'attachments.store',
                                'show'    => 'attachments.show',
                                'edit'    => 'attachments.edit',
                                'update'  => 'attachments.update',
                                'destroy' => 'attachments.destroy',
                            ],
                        ]);

                        // Work Order Notification Routes
                        $router->resource('notifications', 'NotificationController', [
                            'only' => [
                                'store',
                                'update',
                            ],
                            'names' => [
                                'store'  => 'notifications.store',
                                'update' => 'notifications.update',
                            ],
                        ]);

                        // Work Order Event Routes
                        $router->resource('events', 'EventController', [
                            'names' => [
                                'index'   => 'events.index',
                                'create'  => 'events.create',
                                'store'   => 'events.store',
                                'show'    => 'events.show',
                                'edit'    => 'events.edit',
                                'update'  => 'events.update',
                                'destroy' => 'events.destroy',
                            ],
                        ]);

                        // Work Order Part Routes
                        $router->group(['prefix' => 'parts', 'as' => 'parts.'], function (Router $router) {
                            $router->get('/', ['as' => 'index', 'uses' => 'WorkOrderPartController@index']);

                            $router->group(['prefix' => '{inventory}/stocks'], function (Router $router) {
                                $router->get('/', ['as' => 'stocks.index', 'uses' => 'WorkOrderPartStockController@index']);

                                $router->get('{stocks}/take', ['as' => 'stocks.take', 'uses' => 'WorkOrderPartStockController@getTake']);

                                $router->post('{stocks}/take', ['as' => 'stocks.take', 'uses' => 'WorkOrderPartStockController@postTake']);

                                $router->get('{stocks}/put-back', ['as' => 'stocks.put', 'uses' => 'WorkOrderPartStockController@getPut']);

                                $router->post('{stocks}/put-back', ['as' => 'stocks.put', 'uses' => 'WorkOrderPartStockController@postPut']);
                            });
                        });
                    });
                });

                // Work Order Routes
                $router->resource('work-orders', 'WorkOrderController', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);
            });

            // Asset Routes
            $router->group(['as' => 'assets.', 'namespace' => 'Asset'], function (Router $router) {
                $router->group(['prefix' => 'assets'], function (Router $router) {
                    // Asset Event Routes
                    $router->resource('events', 'EventController', [
                        'names' => [
                            'index'   => 'events.index',
                            'create'  => 'events.create',
                            'store'   => 'events.store',
                            'show'    => 'events.show',
                            'edit'    => 'events.edit',
                            'update'  => 'events.update',
                            'destroy' => 'events.destroy',
                        ],
                    ]);

                    // Category Routes
                    $router->resource('categories', 'CategoryController', [
                        'except' => [
                            'show',
                        ],
                        'names' => [
                            'index'   => 'categories.index',
                            'create'  => 'categories.create',
                            'store'   => 'categories.store',
                            'edit'    => 'categories.edit',
                            'update'  => 'categories.update',
                            'destroy' => 'categories.destroy',
                        ],
                    ]);

                    $router->get('categories/json', ['as' => 'categories.json', 'uses' => 'CategoryController@getJson']);

                    $router->get('categories/create/{categories}', ['as' => 'categories.nodes.create', 'uses' => 'CategoryController@create']);

                    $router->post('categories/create/{categories?}', ['as' => 'categories.nodes.store', 'uses' => 'CategoryController@store']);

                    $router->post('categories/move/{categories?}', ['as' => 'categories.nodes.move', 'uses' => 'CategoryController@postMoveCategory']);

                    // Nested Asset Routes
                    $router->group(['prefix' => '{assets}'], function (Router $router) {
                        // Asset Work Order Routes
                        $router->get('work-orders', ['as' => 'work-orders.index', 'uses' => 'WorkOrderController@index']);

                        $router->get('work-orders/attachable', ['as' => 'work-orders.attach.index', 'uses' => 'WorkOrderController@attach']);

                        $router->post('work-orders/{work_orders}/attach', ['as' => 'work-orders.attach.store', 'uses' => 'WorkOrderController@store']);

                        $router->post('work-orders/{work_orders}/detach', ['as' => 'work-orders.attach.remove', 'uses' => 'WorkOrderController@remove']);

                        // Asset Manual Routes
                        $router->get('manuals/{manuals}/download', ['as' => 'manuals.download', 'uses' => 'ManualController@download']);

                        $router->resource('manuals', 'ManualController', [
                            'names' => [
                                'index'   => 'manuals.index',
                                'create'  => 'manuals.create',
                                'store'   => 'manuals.store',
                                'show'    => 'manuals.show',
                                'edit'    => 'manuals.edit',
                                'update'  => 'manuals.update',
                                'destroy' => 'manuals.destroy',
                            ],
                        ]);

                        // Asset Image Routes
                        $router->get('images/{images}/download', ['as' => 'images.download', 'uses' => 'ImageController@download']);

                        $router->resource('images', 'ImageController', [
                            'names' => [
                                'index'   => 'images.index',
                                'create'  => 'images.create',
                                'store'   => 'images.store',
                                'show'    => 'images.show',
                                'edit'    => 'images.edit',
                                'update'  => 'images.update',
                                'destroy' => 'images.destroy',
                            ],
                        ]);

                        // Asset Meter Routes
                        $router->group(['prefix' => 'meters', 'as' => 'meters.', 'namespace' => 'Meter'], function (Router $router) {
                            $router->resource('', 'Controller', [
                                'names' => [
                                    'index'   => 'index',
                                    'create'  => 'create',
                                    'store'   => 'store',
                                    'show'    => 'show',
                                    'edit'    => 'edit',
                                    'update'  => 'update',
                                    'destroy' => 'destroy',
                                ],
                            ]);

                            $router->resource('readings', 'ReadingController', [
                                'only' => [
                                    'store',
                                    'destroy',
                                ],
                                'names' => [
                                    'store'   => 'readings.store',
                                    'destroy' => 'readings.destroy',
                                ],
                            ]);
                        });
                    });
                });

                // Asset Routes
                $router->resource('assets', 'Controller', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);
            });

            // Inventory Routes
            $router->group(['as' => 'inventory.', 'namespace' => 'Inventory'], function (Router $router) {
                $router->group(['prefix' => 'inventory'], function (Router $router) {
                    // Inventory Category Routes
                    $router->get('categories/json', ['as' => 'categories.json', 'uses' => 'CategoryController@getJson']);

                    $router->get('categories/create/{categories}', ['as' => 'categories.nodes.create', 'uses' => 'CategoryController@create']);

                    $router->post('categories/move/{categories?}', ['as' => 'categories.nodes.move', 'uses' => 'CategoryController@postMoveCategory']);

                    $router->post('categories/create/{categories?}', ['as' => 'categories.nodes.store', 'uses' => 'CategoryController@store']);

                    $router->resource('categories', 'CategoryController', [
                        'except' => [
                            'show',
                        ],
                        'names' => [
                            'index'   => 'categories.index',
                            'create'  => 'categories.create',
                            'store'   => 'categories.store',
                            'edit'    => 'categories.edit',
                            'update'  => 'categories.update',
                            'destroy' => 'categories.destroy',
                        ],
                    ]);

                    // Nested Inventory Routes
                    $router->group(['prefix' => '{inventory}'], function (Router $router) {
                        $router->patch('sku/regenerate', ['as' => 'sku.regenerate', 'uses' => 'InventorySkuController@regenerate']);

                        // Inventory Variant Routes
                        $router->resource('variants', 'InventoryVariantController', [
                            'only' => [
                                'create',
                                'store',
                            ],
                            'names' => [
                                'create' => 'variants.create',
                                'store'  => 'variants.store',
                            ],
                        ]);

                        // Inventory Event Routes
                        $router->resource('events', 'EventController', [
                            'names' => [
                                'index'   => 'events.index',
                                'create'  => 'events.create',
                                'store'   => 'events.store',
                                'show'    => 'events.show',
                                'edit'    => 'events.edit',
                                'update'  => 'events.update',
                                'destroy' => 'events.destroy',
                            ],
                        ]);

                        // Inventory Note Routes
                        $router->resource('notes', 'NoteController', [
                            'except' => [
                                'index',
                            ],
                            'names' => [
                                'create'  => 'notes.create',
                                'store'   => 'notes.store',
                                'show'    => 'notes.show',
                                'edit'    => 'notes.edit',
                                'update'  => 'notes.update',
                                'destroy' => 'notes.destroy',
                            ],
                        ]);

                        // Inventory Stock Routes
                        $router->group(['as' => 'stocks.'], function (Router $router) {
                            $router->resource('stocks', 'StockController', [
                                'names' => [
                                    'index'   => 'index',
                                    'create'  => 'create',
                                    'store'   => 'store',
                                    'show'    => 'show',
                                    'edit'    => 'edit',
                                    'update'  => 'update',
                                    'destroy' => 'destroy',
                                ],
                            ]);

                            // Nested Inventory Stock Routes
                            $router->group(['prefix' => 'stocks/{stocks}'], function (Router $router) {
                                // Inventory Stock Movement Routes
                                $router->resource('movements', 'StockMovementController', [
                                    'only' => [
                                        'index',
                                        'show',
                                    ],
                                    'names' => [
                                        'index' => 'movements.index',
                                        'show'  => 'movements.show',
                                    ],
                                ]);

                                $router->group(['prefix' => 'movements', 'as' => 'movements.'], function (Router $router) {
                                    // Nested Inventory Stock Movement Routes
                                    $router->group(['prefix' => '{movements}'], function (Router $router) {
                                        $router->post('rollback', ['as' => 'rollback', 'uses' => 'StockMovementController@rollback']);
                                    });
                                });
                            });
                        });
                    });
                });

                // Inventory Routes
                $router->resource('inventory', 'InventoryController', [
                    'names' => [
                        'index'   => 'index',
                        'create'  => 'create',
                        'store'   => 'store',
                        'show'    => 'show',
                        'edit'    => 'edit',
                        'update'  => 'update',
                        'destroy' => 'destroy',
                    ],
                ]);
            });

            // Location Routes
            $router->get('locations/json', ['as' => 'locations.json', 'uses' => 'LocationController@getJson']);

            $router->post('locations/move/{categories?}', ['as' => 'locations.nodes.move', 'uses' => 'LocationController@postMoveCategory']);

            $router->post('locations/create/{categories?}', ['as' => 'locations.nodes.store', 'uses' => 'LocationController@store']);

            $router->resource('locations', 'LocationController', [
                'except' => [
                    'show',
                ],
                'names' => [
                    'index'   => 'locations.index',
                    'create'  => 'locations.create',
                    'store'   => 'locations.store',
                    'edit'    => 'locations.edit',
                    'update'  => 'locations.update',
                    'destroy' => 'locations.destroy',
                ],
            ]);

            $router->get('locations/create/{categories}', ['as' => 'locations.nodes.create', 'uses' => 'LocationController@create']);

            // Metric Routes
            $router->resource('metrics', 'MetricController', [
                'names' => [
                    'index'   => 'metrics.index',
                    'create'  => 'metrics.create',
                    'store'   => 'metrics.store',
                    'show'    => 'metrics.show',
                    'edit'    => 'metrics.edit',
                    'update'  => 'metrics.update',
                    'destroy' => 'metrics.destroy',
                ],
            ]);
        });
    });
});
