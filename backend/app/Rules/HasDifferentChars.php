<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasDifferentChars implements Rule
{
    protected $chars_count;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $chars_count = 5)
    {
        $this->chars_count = $chars_count;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (count(array_unique(str_split($value))) < $this->chars_count) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Your password must contains $this->chars_count different characters or more.";
    }
}
