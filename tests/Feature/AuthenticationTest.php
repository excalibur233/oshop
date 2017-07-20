<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;


     /**
      * @test
      */
     public function a_guest_will_be_redirect_to_the_login_page()
     {
         $this->get('/home')->assertRedirect('/login');
     }
}
