<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\ExamplesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Admin\ExamplesController Test Case
 *
 * @uses \App\Controller\Admin\ExamplesController
 */
class ExamplesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Examples',
        'app.ExampleCategories',
    ];

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test setDataTableBeforeAjaxFunction method
     *
     * @return void
     */
    public function testSetDataTableBeforeAjaxFunction()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test setDataTableAfterAjaxFunction method
     *
     * @return void
     */
    public function testSetDataTableAfterAjaxFunction()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getDataTablesContent method
     *
     * @return void
     */
    public function testGetDataTablesContent()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
