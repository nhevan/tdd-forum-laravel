<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * accespts or creaates a new user and signs him/her in
     * @param  [type] $user [description]
     */
    public function signIn($user = null)
    {
    	$user = $user ?: factory('App\User')->create();

    	$this->be($user);
    }
}
