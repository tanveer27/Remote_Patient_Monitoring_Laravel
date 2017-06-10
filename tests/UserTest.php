<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $baseUrl = 'http://localhost';
    /** @test */
    public function it_authenticate_a_user()
    {
        //$user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        //$this->post('/api/authenticate', ['email' => $user->email, 'password' => 'foo'])
            //->seeJsonStructure(['token']);
        $this->post('/api/authenticate', ['email' => 'tanveer27@gmail.com', 'password' => 'faahd123'])
            ->seeJson(['token']);
    }
    /** @test */
    public function it_register_a_user()
    {
        //$user = factory(App\User::class)->create(['password' => bcrypt('foo')]);

        //$this->post('/api/authenticate', ['email' => $user->email, 'password' => 'foo'])
        //->seeJsonStructure(['token']);
        $this->get('/api/registerPatient');

    }
}
