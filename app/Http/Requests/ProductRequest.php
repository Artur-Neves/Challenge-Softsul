<?php

namespace App\Http\Requests;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "user_name" => "required|string|max:255",
            "order_date" => "required|date_format:Y-m-d H:i:s",
            "delivery_date" => "required|date_format:Y-m-d H:i:s|after:order_date",
            "status" =>["required", Rule::enum(ProductStatus::class)],
        ];
    }
    public function messages(): array
    {
        return [
            "user_name.required" => "O nome do usuário é obrigatório.",
            "user_name.string" => "O nome do usuário deve ser do tipo alfa numérico.",
            "user_name.max" => "O nome do usuário não pode exceder 255 caracteres.",
            "order_date.required" => "A data do pedido é obrigatória.",
            "order_date.date_format" => "A data do pedido deve estar no formato Y-m-d H:i:s.",
            "delivery_date.required" => "A data de entrega é obrigatória.",
            "delivery_date.date_format" => "A data de entrega deve estar no formato Y-m-d H:i:s.",
            "delivery_date.after" => "A data de entrega deve ser posterior à data do pedido.",
            "status.required" => "O status é obrigatório.",
            "status.*" => "O status deve ser um dos seguintes valores: " . implode(", ", ProductStatus::values()),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], 422));
    }
}