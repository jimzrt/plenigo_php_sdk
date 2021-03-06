<?php

require_once __DIR__ . '/../../../src/plenigo/services/UserManagementService.php';
require_once __DIR__ . '/../internal/utils/RestClientMock.php';

use \plenigo\services\UserManagementService;

/**
 * UserManagementServiceMock
 * 
 * <b>
 * Mock and override class for UserManagementService
 * </b>
 */
class UserManagementServiceMock extends UserManagementService
{

    public static $requestResponse;

    public function __construct($request)
    {
        $this->request = RestClientMock::get('mock');
    }

    protected function getRequestResponse()
    {
        return static::$requestResponse;
    }
}