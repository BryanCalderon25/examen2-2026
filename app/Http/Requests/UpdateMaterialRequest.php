<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unidadMedida' => 'sometimes|required|string',
            'descripcion'  => 'sometimes|required|string',
            'ubicacion'    => 'sometimes|required|string',
            'categoria_id' => 'sometimes|required|exists:categorias,idCategoria',
            
            // Reglas para la relación con Unidad a través de MaterialUnidad
            'unidades' => 'sometimes|array',
            'unidades.*.unidad_id' => 'required_with:unidades|exists:unidades,id',
            'unidades.*.cantidad' => 'required_with:unidades|integer|min:0',
        ];
    }
}
