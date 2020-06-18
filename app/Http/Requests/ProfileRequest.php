<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'direccion' => '',
      'historial' => '',
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];
  }

  public function messages()
  {
    return [
      'direccion.required' => 'Tienes que ingresar tu direccion Si desea actualizar'
    ];
  }
}
