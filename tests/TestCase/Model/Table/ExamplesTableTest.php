<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamplesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamplesTable Test Case
 */
class ExamplesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamplesTable
     */
    public $Examples;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Examples') ? [] : ['className' => ExamplesTable::class];
        $this->Examples = TableRegistry::getTableLocator()->get('Examples', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Examples);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
