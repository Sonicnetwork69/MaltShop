<?php

/**
 * @package PaytrController
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 05-04-2023
 */

namespace Modules\Paytr\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Paytr\Http\Requests\PaytrRequest;
use Modules\Addons\Entities\Addon;
use Modules\Paytr\Entities\{
    Paytr,
    PaytrBody
};

class PaytrController extends Controller
{
    /**
     * Returns form for the edit modal
     *
     * @param \Illuminate\Http\Request
     *
     * @return JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            $module = Paytr::first()->data;
        } catch (\Exception $e) {
            $module = null;
        }

        $addon = Addon::findOrFail('paytr');

        return response()->json(
            [
                'html' => view('gateway::partial.form', compact('module', 'addon'))->render(),
                'status' => true
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaytrRequest $request
     *
     * @return mixed
     */
    public function store(PaytrRequest $request)
    {
        $paytrBody = new PaytrBody($request);
        Paytr::updateOrCreate(
            ['alias' => 'paytr'],
            [
                'name' => 'Paytr',
                'instruction' => $request->instruction,
                'status' => $request->status,
                'sandbox' => $request->sandbox,
                'image' => 'thumbnail.png',
                'data' => json_encode($paytrBody)
            ]
        );

        return back()->with(['AddonStatus' => 'success', 'AddonMessage' => __('Paytr settings updated.')]);
    }
}
