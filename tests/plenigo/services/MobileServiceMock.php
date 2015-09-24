<?php

require_once __DIR__ . '/../../../src/plenigo/services/MobileService.php';
require_once __DIR__ . '/../internal/utils/RestClientMock.php';

use \plenigo\services\MobileService;

/**
 * MobileServiceMock
 * 
 * <b>
 * Mock and override class for MobileService
 * </b>
 *
 * @category Test
 * @package  
 * @author   Sebastian Dieguez <s.dieguez@plenigo.com>
 * @link     http://plenigo.com
 */
class MobileServiceMock extends MobileService
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