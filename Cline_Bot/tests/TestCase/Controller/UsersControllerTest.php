<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected array $fixtures = [
        'app.Users',
    ];

    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->enableCsrfToken();
    }

    /**
     * Tear Down the test case.
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Test login method
     *
     * @return void
     * @uses \App\Controller\UsersController::login()
     */
    public function testLogin(): void
    {
        $this->get('/login');
        $this->assertResponseOk();
        $this->assertResponseContains('Login');
    }

    /**
     * Test register method
     *
     * @return void
     * @uses \App\Controller\UsersController::register()
     */
    public function testRegister(): void
    {
        $this->get('/register');
        $this->assertResponseOk();
        $this->assertResponseContains('Register');
    }

    /**
     * Test dashboard method requires authentication
     *
     * @return void
     * @uses \App\Controller\UsersController::dashboard()
     */
    public function testDashboardRequiresAuthentication(): void
    {
        $this->get('/dashboard');
        $this->assertResponseCode(302);
        $this->assertRedirect('/login?redirect=%2Fdashboard');
    }
}
