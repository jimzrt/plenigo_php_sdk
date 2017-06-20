<?php

require_once __DIR__ . '/../../../src/plenigo/services/CompanyService.php';
require_once __DIR__ . '/../internal/utils/RestClientMock.php';

use \plenigo\services\CompanyService;

/**
 * CompanyServiceMock
 * 
 * <b>
 * Mock and override class for CompanyService
 * </b>
 */
class CompanyServiceMock extends CompanyService
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