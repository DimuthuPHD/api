<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function apiRsponse($success = false, $errors = [], $data = [])
    {
        if ($success == false) {
            $errors = count($errors) <= 0 ? $errors['message'] = 'Api Error' : $errors;
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'data' => $data
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
