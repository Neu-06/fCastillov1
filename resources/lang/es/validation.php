<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'unique' => 'El campo :attribute ya está registrado.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'exists' => 'El campo :attribute no es válido.',

    'attributes' => [
        'ci' => 'CI',
        'nombre' => 'nombre',
        'correo' => 'correo electrónico',
        'contrasena' => 'contraseña',
        'id_rol' => 'rol',
    ],
];
