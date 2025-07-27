<?php

/**
 * @package VoguePayView
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-2023
 */

namespace Modules\VoguePay\Views;

use Modules\VoguePay\Entities\VoguePay;
use Modules\Gateway\Contracts\PaymentViewInterface;
use Modules\Gateway\Services\GatewayHelper;
use Modules\Gateway\Traits\ApiResponse;

class VoguePayView implements PaymentViewInterface
{
    use ApiResponse;

    /**
     * Payment view
     *
     * @param String $key
     * @return view|redirectResponse
     */
    public static function paymentView($key)
    {
        $helper = GatewayHelper::getInstance();
        try {
            $vogue_pay = VoguePay::firstWhere('alias', 'voguepay')->data;

            return view('voguepay::pay', [
                'merchantId' => $vogue_pay->merchantId,
                'instruction' => $vogue_pay->instruction,
                'purchaseData' => $helper->getPurchaseData($key)
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('This payment gateway is not available at this moment')]);
        }
    }
}
