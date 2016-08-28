<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PopulationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PopulationsTable Test Case
 */
class PopulationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PopulationsTable
     */
    public $Populations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.populations',
        'app.prefectures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Populations') ? [] : ['className' => 'App\Model\Table\PopulationsTable'];
        $this->Populations = TableRegistry::get('Populations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Populations);

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
