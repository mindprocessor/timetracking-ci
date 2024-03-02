<?php

use Track\Controllers\Htmx\HxHomeController;
use Track\Controllers\HomeController;
use Track\Controllers\AuthController;
use Track\Controllers\AdminController;

use Track\Controllers\Portal\PortalHomeController;
use Track\Controllers\Portal\PortalTimelogController;
use Track\Controllers\Portal\PortalReportController;
use Track\Controllers\Portal\PortalAuthController;

use Track\Controllers\Admin\AdminHomeController;
use Track\Controllers\Admin\AdminTimelogController;
use Track\Controllers\Admin\AdminReportsController;
use Track\Controllers\Admin\AdminUsersController;

use Track\Controllers\Htmx\HxAdminController;


$routes->add('auth/login', [PortalAuthController::class , 'login']);
$routes->add('auth/logout', [PortalAuthController::class, 'logout']);

$routes->group('', ['filter'=>'secure'], function($routes){

    /**home */
    $routes->get('/', [PortalHomeController::class, 'index']);
    $routes->get('checkin', [PortalHomeController::class, 'checkIn']);
    $routes->add('checkout/id/(:num)', [PortalHomeController::class, 'checkOut']);
    $routes->get('breakin/cid/(:num)/mode/(:alpha)', [PortalHomeController::class, 'breakIn']);
    $routes->get('breakout/id/(:num)', [PortalHomeController::class, 'breakOut']);

    /**timelog */
    $routes->add('timelogs', [PortalTimelogController::class, 'timelogs']);
    $routes->get('timelog/id/(:num)', [PortalTimelogController::class, 'recordDetails']);

    /**incident report */
    $routes->add('incident-report', [PortalReportController::class, 'incidentReport']);

});


$routes->group('admin', ['filter'=>'secure_admin'], function($routes){
    
    /**home */
    $routes->get('/', [AdminHomeController::class, 'checkinUsers']);

    /**timelog */
    $routes->get('timelogs', [AdminTimelogController::class, 'timelogs']);

    /**reports */
    $routes->get('reports', [AdminReportsController::class, 'reports']);

    /**users */
    $routes->get('users', [AdminUsersController::class, 'users']);
    $routes->get('user/id/(:num)', [AdminUsersController::class, 'user']);
    $routes->add('user/edit/id/(:num)', [AdminUsersController::class, 'editRecord']);
    $routes->add('user/change-password/id/(:num)', [AdminUsersController::class, 'changePassword']);
    $routes->add('user/add', [AdminUsersController::class, 'addRecord']);
    $routes->add('user/delete/id/(:num)', [AdminUsersController::class, 'deleteRecord']);
    $routes->add('user/activate/id/(:num)', [AdminUsersController::class, 'activateUser']);
    $routes->add('user/deactivate/id/(:num)', [AdminUsersController::class, 'deactivateUser']);

    /**HTMX routes */
    $routes->get('htmx/timesheet/(:num)', [HxAdminController::class, 'timesheet']);
    $routes->post('htmx/filter/timelog', [HxAdminController::class, 'filterTimelog']);
    $routes->get('htmx/test', [HxAdminController::class, 'test']);
});


/**please comment this or remove if tables are created */
$routes->get('/create/tables', [\Track\Controllers\Admin\AdminDBController::class, 'createTables']);