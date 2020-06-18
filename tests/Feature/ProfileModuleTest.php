<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileModuleTest extends TestCase
{
  use RefreshDatabase;
  
  /**
   * @test
   */
  function it_create_profile_when_register_user()
  {
    
    $response = $this->get('/');

    $response->assertStatus(200);
  }
}
