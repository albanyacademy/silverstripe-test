<?php

namespace UncleCheese\BetterButtons\Tests\Actions;

use SilverStripe\Dev\SapphireTest;
use UncleCheese\BetterButtons\Actions\BetterButtonCustomAction;

class BetterButtonCustomActionTest extends SapphireTest
{
    /**
     * @var BetterButtonCustomAction
     */
    private $button;

    /**
     * Instantiate the test button
     *
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->button = new BetterButtonCustomAction('foo', 'bar');
    }

    /**
     * Test that setRedirectType will throw an exception if you provide an unrecognised redirect type
     *
     * @expectedException Exception
     * @expectedExceptionMessage Redirect type must use either the GOBACK or REFRESH constants
     * on BetterButtonCustomAction
     */
    public function testSetRedirectThrowsExceptionOnInvalidType()
    {
        $this->button->setRedirectType(12345);
    }

    /**
     * Test that a valid redirect type can be set and retrieved
     */
    public function testSetAndGetRedirectType()
    {
        $this->button->setRedirectType(BetterButtonCustomAction::REFRESH);
        $this->assertSame(BetterButtonCustomAction::REFRESH, $this->button->getRedirectType());
    }

    /**
     * Test that the redirect URL can be set and retrieved
     */
    public function testSetAndGetRedirectUrl()
    {
        $this->button->setRedirectURL('leftandmain.com');
        $this->assertSame('leftandmain.com', $this->button->getRedirectURL());
    }
}
