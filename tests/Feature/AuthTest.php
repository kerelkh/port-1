<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_login() {
        $this->get('/login')->assertStatus(200);
    }

    public function test_see_signin_text_in_page_login() {
        $this->get('/login')->assertSeeText('Sign In');
    }

    public function test_post_empty_input_should_give_error_username_password_required() {
        $this->post('/login', [
            'username' => '',
            'password' => '',
        ])->assertSessionHasErrors(['username', 'password']);
    }

    public function test_post_only_username_input_should_give_error_password_required() {
        $this->post('/login', [
            'username' => 'kerelka',
            'password' => '',
        ])->assertSessionHasErrors(['password']);
    }

    public function test_post_only_password_input_should_give_error_username_required() {
        $this->post('/login', [
            'username' => '',
            'password' => 'testing password',
        ])->assertSessionHasErrors(['username']);
    }

    public function test_post_wrong_username_and_password_should_redirect_back_and_has_session_error() {
        $this->post('/login', [
            'username' => 'thisusernameiswrong',
            'password' => 'thispasswordiswrong',
        ])->assertStatus(302)->assertSessionHasAll(['error']);
    }

    public function test_post_correct_password_should_redirect_to_dashboard() {
        $user = User::first();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'densus88'
        ])->assertRedirect('/dashboard');
    }

    public function test_authenticate_and_access_login_should_redirect_to_dashboard() {
        $user = User::first();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'densus88',
        ])->assertRedirect('/dashboard');

        $this->get('/login')->assertRedirect('/dashboard');
    }

    public function test_authenticate_and_logout_should_redirect_to_login() {
        $user = User::first();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'densus88',
        ])->assertStatus(302);

        $this->post('/logout')->assertRedirect('/login');

        $this->get('/login')->assertSeeText('Logout Successfully');
    }

    public function test_authenticate_logout_and_access_dashboard_should_redirect_to_login() {
        $user = User::first();

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'densus88',
        ])->assertStatus(302);

        $this->post('/logout')->assertRedirect('/login');

        $this->get('/dashboard')->assertRedirect('/login');
    }
}
