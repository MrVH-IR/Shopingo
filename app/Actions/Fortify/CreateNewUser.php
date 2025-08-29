<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'national_code' => ['required', 'integer', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'slug' => ['required', 'string', 'max:255', 'unique:users'],
            'profile_photo_path' => ['required', 'string', 'max:400'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'national_code' => $input['national_code'] ?? null,
            'slug' => Str::slug($input['slug']) . '-' . Str::random(5),
            'profile_photo_path' => $input['profile_photo_path'] ?? null,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
