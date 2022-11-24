<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Checkout\CheckoutRequest;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function checkout(CheckoutRequest $req) {
        $userInfo = $req->user;
        $shippingInfo = $req->shippingDetail;
        $billingInfo = $req->billingDetail;
        $orderDetail = $req->orderDetail;

        // Todo: Inventory logic implementation
        $validation = $this->checkProductAvailabilities($orderDetail, $shippingInfo);
        if($validation == false)
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => "Inventory is not available."
            ]);

        // Todo: Caclulate the total cost with tax, shipping, total product price
        $prices = $this->calculateTotalPrice($orderDetail, $shippingInfo);

        // Todo: Payment Processing
        $validation = $this->checkPaymentProcessing($prices, $billingInfo);
        if($validation == false) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => "There is an issue on the payment processing."
            ]);
        }

        // Todo: Register Order info
        $orderObject = $this->registerOrder($userInfo, $prices, $shippingInfo, $billingInfo);

        // Todo: Run job or Queue for shipping, billing, email notification
        $this->processJobs();

        return response()->json([
            "success" => true,
            "data" => $orderObject,
            "message" => "A new order has been processed successfully."
        ]);
    }


    /**
     * Inventory checking
     * Check each product's availability(balance, available countries etc)
     */
    private function checkProductAvailabilities() {
        return true;
    }

    /**
     * Calculate the total price
     * Calculate the total sum of tax, shipping, product's price
     */
    private function calculateTotalPrice() {
        return [
            "tax" => 100,
            "shipping" => 150,
            "product_price" => 5000
        ];
    }

    /**
     * Payment Processing
     * Calculate the tax, shipping cost and
     */
    private function checkPaymentProcessing() {
        return true;
    }

    /**
     * Register Order
     * Register full order information including user, products, billing, shipping information
     */
    private function registerOrder() {
        $orderObject = null;
        return $orderObject;
    }

    /**
     * Process jobs
     * Run the shipping, billing, email jobs in the background
     */
    private function processJobs() {
        return true;
    }
}
