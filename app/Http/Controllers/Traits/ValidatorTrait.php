<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait ValidatorTrait
{
    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return $this->errorUnprocessabeEntity($errors, 'UnprocessableEntity');
    }
}
