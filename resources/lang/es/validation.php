<?php

return [
  'accepted' => 'El campo :attribute debe ser aceptado.',
  'active_url' => 'El campo :attribute no es una URL válida.',
  'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
  'alpha' => 'El campo :attribute solo puede contener letras.',
  'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
  'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
  'array' => 'El campo :attribute debe ser un arreglo.',
  'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
  'between' => [
      'numeric' => 'El campo :attribute debe estar entre :min y :max.',
      'file' => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
      'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
      'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
  ],
  'boolean' => 'El campo :attribute debe ser verdadero o falso.',
  'confirmed' => 'El campo :attribute no coincide con la confirmación.',
  'date' => 'El campo :attribute no es una fecha válida.',
  'date_format' => 'El campo :attribute no coincide con el formato :format.',
  'different' => 'Los campos :attribute y :other deben ser diferentes.',
  'digits' => 'El campo :attribute debe tener :digits dígitos.',
  'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
  'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
  'exists' => 'El campo :attribute seleccionado no es válido.',
  'image' => 'El campo :attribute debe ser una imagen.',
  'in' => 'El campo :attribute seleccionado no es válido.',
  'integer' => 'El campo :attribute debe ser un número entero.',
  'max' => [
      'numeric' => 'El campo :attribute no debe ser mayor a :max.',
      'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
      'string' => 'El campo :attribute no debe ser mayor a :max caracteres.',
      'array' => 'El campo :attribute no debe tener más de :max elementos.',
  ],
  'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
  'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
  'min' => [
      'numeric' => 'El campo :attribute debe ser al menos :min.',
      'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
      'string' => 'El campo :attribute debe tener al menos :min caracteres.',
      'array' => 'El campo :attribute debe tener al menos :min elementos.',
  ],
  'not_in' => 'El campo :attribute seleccionado no es válido.',
  'not_regex' => 'El formato del campo :attribute no es válido.',
  'numeric' => 'El campo :attribute debe ser un número.',
  'regex' => 'El formato del campo :attribute no es válido.',
  'required' => 'El campo :attribute es obligatorio.',
  'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
  'same' => 'Los campos :attribute y :other deben coincidir.',
  'size' => [
      'numeric' => 'El campo :attribute debe ser :size.',
      'file' => 'El archivo :attribute debe pesar :size kilobytes.',
      'string' => 'El campo :attribute debe tener :size caracteres.',
      'array' => 'El campo :attribute debe contener :size elementos.',
  ],
  'unique' => 'El campo :attribute ya ha sido tomado.',
  'url' => 'El formato del campo :attribute no es válido.',

  'custom' => [
      'correoElectronico' => [
          'unique' => 'El correo ya está en uso. Inggrese otro correo',
          'required' => 'El correo es obligatorio',

      ],
  ],

  'attributes' => [
      'name' => 'nombre',
      'apellidos' => 'apellidos',
      'correoElectronico' => 'correo electrónico',
      'password' => 'contraseña',
      'password_confirmation' => 'confirmación de contraseña',
      'tipoIdentificacion' => 'tipo de identificación',
      'identificacion' => 'número de identificación',
      'idGenero' => 'género',
      'fechaNacimiento' => 'fecha de nacimiento',
      'telefonoConvencional' => 'teléfono convencional',
      'telefonoCelular' => 'teléfono celular',
      'direccion' => 'dirección',
      'idCiudadResidencia' => 'ciudad de residencia',
  ],
];
