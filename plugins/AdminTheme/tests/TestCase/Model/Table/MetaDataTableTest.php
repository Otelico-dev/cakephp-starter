<?php
namespace AdminTheme\Test\TestCase\Model\Table;

use AdminTheme\Model\Table\MetaDataTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminTheme\Model\Table\MetaDataTable Test Case
 */
class MetaDataTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminTheme\Model\Table\MetaDataTable
     */
    public $MetaData;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.AdminTheme.MetaData',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MetaData') ? [] : ['className' => MetaDataTable::class];
        $this->MetaData = TableRegistry::getTableLocator()->get('MetaData', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MetaData);

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
