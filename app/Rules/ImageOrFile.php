<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ImageOrFile implements Rule
{
    private $data;
    private bool $nullable;
    private string $type;
    private string $size;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data = null, $nullable = false, $type = 'jpg,jpeg,png', $size = '20048')
    {
        $this->data = $data;
        $this->nullable = $nullable;
        $this->type = $type;
        $this->size = $size;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check is string or UploadedFile type
        $tmp = ($this->data == null || !is_string($value));

        $validator = Validator::make([
            $attribute => $value
        ], [
            $attribute => ($tmp) ? ($this->nullable ? 'nullable' : 'required').'|image|mimes:' . $this->type . '|max:' . $this->size : ($this->nullable ? 'nullable' : 'required').'|string'
        ]);

        return !$validator->fails();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Une image doit être renseignée. Elle doit respecter un des types suivant : '.$this->type. ' et une taille maximum de 2 Mo';
    }
}
