<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'room_id' => ['required', 'exists:rooms,id'],
        ])->validate();

        // create new user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'room_id' => $input['room_id'],
        ]);

        // check if avatar was selected
        if (request()->hasFile('avatar')) {

            $avatar = request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->storeAs('avatars', $user->id . '_' . $avatar, '');
            $user->update(['avatar' => $avatar]);
        }

        return $user;
    }
}
