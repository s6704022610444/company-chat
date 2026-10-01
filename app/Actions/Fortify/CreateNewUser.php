<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        $firstName = trim($input['first_name'] ?? '');
        $lastName = trim($input['last_name'] ?? '');

        // Fallback for name if first_name / last_name submitted or legacy name submitted
        if (empty($firstName) && !empty($input['name'])) {
            $parts = explode(' ', trim($input['name']), 2);
            $firstName = $parts[0];
            $lastName = $parts[1] ?? '';
        }

        $fullName = trim($firstName . ' ' . $lastName);

        Validator::make(array_merge($input, [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => $fullName,
        ]), [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ], [
            'first_name.required' => 'กรุณากรอกชื่อจริง',
            'last_name.required' => 'กรุณากรอกนามสกุล',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.unique' => 'อีเมลนี้ถูกใช้งานแล้ว',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ])->validate();

        return User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => $fullName,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'position' => 'พนักงาน',
        ]);
    }
}
