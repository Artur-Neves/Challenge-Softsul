<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "customer_name" => "required|string|max:255",
            "order_date" => "required|date",
            "delivery_date" => "required|date|after:order_date",
            "status" => ["required", Rule::enum(OrderStatus::class)],
        ];
    }
    public function messages(): array
    {
        return [
            "customer_name.required" => "O nome do cliente é obrigatório.",
            "customer_name.string" => "O nome do cliente deve ser do tipo alfa numérico.",
            "customer_name.max" => "O nome do cliente não pode exceder 255 caracteres.",
            "order_date.required" => "A data do pedido é obrigatória.",
            "order_date.date" => "A data do pedido deve ser uma data válida.",
            "delivery_date.required" => "A data de entrega é obrigatória.",
            "delivery_date.date" => "A data de entrega deve ser uma data válida.",
            "delivery_date.after" => "A data de entrega deve ser posterior à data do pedido.",
            "status.required" => "O status é obrigatório.",
            "status.*" => "O status deve ser um dos seguintes valores: " . implode(", ", OrderStatus::values()),
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
