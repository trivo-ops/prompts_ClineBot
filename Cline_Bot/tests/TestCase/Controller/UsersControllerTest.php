<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
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


    /**
     * Test login method
     *
     * @return void
     * @uses \App\Controller\UsersController::login()
     */
    public function testLogin(): void
    {
        $this->get('/users/login');
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
        $this->get('/users/register');
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
        $this->get('/users/dashboard');
        $this->assertResponseCode(302);
        $this->assertRedirect('/users/login?redirect=%2Fusers%2Fdashboard');
    }
}
