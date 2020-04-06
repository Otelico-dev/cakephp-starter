<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExampleCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExampleCategoriesTable Test Case
 */
class ExampleCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExampleCategoriesTable
     */
    public $ExampleCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ExampleCategories',
        'app.Examples',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExampleCategories') ? [] : ['className' => ExampleCategoriesTable::class];
        $this->ExampleCategories = TableRegistry::getTableLocator()->get('ExampleCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExampleCategories);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
