<?php

namespace App\Http\Requests\Api\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'user' => ['required', 'array'],

            'user.email' => ['required'],
            'user.name' => ['required'],

            'user.phone' => ['sometimes'],
            'user.country' => ['required', 'size:2'],
            'user.state' => ['sometimes'],

            'billingDetail' => ['required', 'array'],
            'billingDetail.cc_name' => ['sometimes'],
            'billingDetail.cc_type' => ['sometimes'],
            'billingDetail.cc_number' => ['sometimes'],
            'billingDetail.cc_exp_date' => ['sometimes'],
            'billingDetail.cc_cvv' => ['sometimes'],
            'billingDetail.billing_address' => ['sometimes'],
            'billingDetail.billing_address_line2' => ['sometimes'],
            'billingDetail.billing_state' => ['sometimes'],
            'billingDetail.billing_city' => ['sometimes'],
            'billingDetail.billing_country' => ['sometimes'],
            'billingDetail.billing_zipcode' => ['sometimes'],

            'shippingDetail' => ['required', 'array'],
            'shippingDetail.shipping_address' => ['sometimes'],
            'shippingDetail.shipping_address_line2' => ['sometimes'],
            'shippingDetail.shipping_state' => ['sometimes'],
            'shippingDetail.shipping_city' => ['sometimes'],
            'shippingDetail.shipping_country' => ['sometimes'],
            'shippingDetail.shipping_zipcode' => ['sometimes'],

            'orderDetails' => ['required', 'array'],
            'orderDetails.*.product_id' => ['nullable', 'exists:products,id'],
            'orderDetails.*.quantity' => ['required', 'integer']
        ];
    }
}
