<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserBuildingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserBuildingsTable Test Case
 */
class UserBuildingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserBuildingsTable
     */
    public $UserBuildings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserBuildings',
        'app.Users',
        'app.Buildings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserBuildings') ? [] : ['className' => UserBuildingsTable::class];
        $this->UserBuildings = TableRegistry::getTableLocator()->get('UserBuildings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserBuildings);

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
