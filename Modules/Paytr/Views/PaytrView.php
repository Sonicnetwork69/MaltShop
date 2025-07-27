<?php

/**
 * @package PaytrView
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 05-04-2023
 */

namespace Modules\Paytr\Views;

use Modules\Paytr\Entities\Paytr;
use Modules\Gateway\Contracts\PaymentViewInterface;
use Modules\Gateway\Services\GatewayHelper;
use Modules\Gateway\Traits\ApiResponse;

class PaytrView implements PaymentViewInterface
{
    use ApiResponse;

    /**
     * Paytr payment view
     *
     * @param String $key
     * @return view|redirectResponse
     */
    public static function paymentView($key)
    {
        $helper = GatewayHelper::getInstance();
        try {
            $paytr = Paytr::firstWhere('alias', 'paytr')->data;

            return view('paytr::pay', [
                'merchantId' => $paytr->merchantId,
                'merchantKey' => $paytr->merchantKey,
                'merchantSalt' => $paytr->merchantSalt,
                'instruction' => $paytr->instruction,
                'purchaseData' => $helper->getPurchaseData($key)
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('Purchase data not found.')]);
        }
    }

    /**
     * Paytr payment response
     *
     * @param String $key
     * @return Array
     */
    public static function paymentResponse($key)
    {
        $helper = GatewayHelper::getInstance();

        $paytr = Paytr::firstWhere('alias', 'paytr')->data;
        return [
            'merchantId' => $paytr->merchantId,
            'merchantKey' => $paytr->merchantKey,
            'merchantSalt' => $paytr->merchantSalt,
            'instruction' => $paytr->instruction,
            'purchaseData' => $helper->getPurchaseData($key)
        ];
    }
}
