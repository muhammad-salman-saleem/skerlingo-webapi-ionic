<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MatchOldPassword implements Rule
{
    /**

     * Determine if the validation rule passes.

     *

     * @param  string  $attribute

     * @param  mixed  $value

     * @return bool

     */

    public function passes($attribute, $value)

    {

        return Hash::check($value, Auth::guard()->user()->password);
    }



    /**

     * Get the validation error message.

     *

     * @return string

     */

    public function message()

    {

        return 'Votre mot de passe est incorrect.';
    }
}
