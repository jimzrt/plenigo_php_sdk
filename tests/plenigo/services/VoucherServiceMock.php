<?php

require_once __DIR__ . '/../../../src/plenigo/services/VoucherService.php';
require_once __DIR__ . '/../internal/utils/RestClientMock.php';

use \plenigo\services\VoucherService;

/**
 * VoucherServiceMock
 * 
 * <b>
 * Mock and override class for VoucherService
 * </b>
 */
class VoucherServiceMock extends VoucherService
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