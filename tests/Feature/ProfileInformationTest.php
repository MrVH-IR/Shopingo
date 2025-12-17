<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

//        $this->assertEquals($user->name, $component->state['name']);
//        $this->assertEquals($user->email, $component->state['email']);
        $component->assertSet('state.name', $user->name);
        $component->assertSet('state.email', $user->email);
    }

    public function test_profile_information_can_be_updated(): void
    {
//        $this->actingAs($user = User::factory()->create());
//        $user = User::factory()->create([
//            'email_verified_at' => now(),
//        ]);
//        $this->actingAs($user);
//
////        Livewire::test(UpdateProfileInformationForm::class)
////            ->set('state', ['name' => 'Test Name', 'email' => 'test@example.com'])
////            ->call('updateProfileInformation');
//        Livewire::test(UpdateProfileInformationForm::class)
//            ->set('state.name', 'Test Name')
//            ->set('state.email', 'test@example.com')
//            ->call('updateProfileInformation')
//            ->assertHasNoErrors();
//
//        $this->assertEquals('Test Name', $user->fresh()->name);
//        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
