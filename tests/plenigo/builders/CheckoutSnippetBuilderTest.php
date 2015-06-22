<?php

require_once( __DIR__ . '/../../../src/plenigo/PlenigoManager.php' );
require_once( __DIR__ . '/../../../src/plenigo/models/ProductBase.php' );
require_once( __DIR__ . '/../../../src/plenigo/builders/CheckoutSnippetBuilder.php' );
require_once(__DIR__ . '/../internal/utils/PlenigoTestCase.php');

use \plenigo\PlenigoManager;
use \plenigo\models\ProductBase;
use \plenigo\builders\CheckoutSnippetBuilder;

class CheckoutSnippetBuilderTest extends PlenigoTestCase {

    public function checkoutSnippetBuilderProvider() {
        $product = new ProductBase(
            'item-123', 'item-review', 1.5, 'USD'
        );
        $product->setCategoryId("New Category");
        $product->setSubscriptionRenewal(true);
        $product->setFailedPayment(true);

        return array(array($product));
    }

    public function checkoutProducTitleLongProvider() {
        $product = new ProductBase(
            'item-123',
            '0123456789012345678901234567890123456789'
            . '0123456789012345678901234567890123456789'
            . '012345678901234567890123456789', 1.5, 'USD'
        );

        return array(array($product));
    }

    public function checkoutProducPIDLongProvider() {
        $product = new ProductBase(
            '012345678901234567890123456789', 'Long Product ID', 1.5, 'USD'
        );

        return array(array($product));
    }

    /**
     * @dataProvider checkoutSnippetBuilderProvider
     */
    public function testBuild($product) {
        $checkout = new CheckoutSnippetBuilder($product);

        $plenigoCheckoutCode = $checkout->build();

        $this->assertRegExp("/^plenigo\\.checkout\\('\\w+'\\);$/", $plenigoCheckoutCode);
        $this->assertError(E_USER_NOTICE, "Building CHECKOUT");
    }

    /**
     * @dataProvider checkoutSnippetBuilderProvider
     */
    public function testBuildSettings($product) {
        $checkout = new CheckoutSnippetBuilder($product);

        $plenigoCheckoutCode = $checkout->build(array(
            'showBuyingAgainScreen' => true,
            'showCheckoutConfirmationScreen' => true,
            'testMode' => true
        ));

        $this->assertRegExp("/^plenigo\\.checkout\\('\\w+'\\);$/", $plenigoCheckoutCode);
        $this->assertError(E_USER_NOTICE, "Building CHECKOUT");
    }

    /**
     * @dataProvider checkoutSnippetBuilderProvider
     */
    public function testCheckCategory($product) {
        $checkout = new CheckoutSnippetBuilder($product);

        $plenigoCheckoutCode = $checkout->build();

        $this->assertEquals("New Category", $checkout->getProduct()->getCategoryId());

        $this->assertRegExp("/^plenigo\\.checkout\\('\\w+'\\);$/", $plenigoCheckoutCode);
        $this->assertError(E_USER_NOTICE, "Building CHECKOUT");
        $this->assertError(E_USER_NOTICE, "Checkout QUERYSTRING");
    }

    /**
     * @dataProvider checkoutProducTitleLongProvider
     */
    public function testBuildTitleLong($product) {
        $checkout = new CheckoutSnippetBuilder($product);

        $plenigoCheckoutCode = $checkout->build();

        $this->assertError(E_USER_NOTICE, "title is too long");
    }
}