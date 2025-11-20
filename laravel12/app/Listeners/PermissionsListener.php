<?php

namespace App\Listeners;

use App\Events\AuthenticationEvent;
use App\Http\Controllers\PermissionController;

class PermissionsListener
{
    public function __construct() {}

    public function handle(AuthenticationEvent $event): void {
        PermissionController::loadPermissions($event->data);
    }
}