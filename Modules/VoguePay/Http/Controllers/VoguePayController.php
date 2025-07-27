<?php

namespace Modules\VoguePay\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Addons\Entities\Addon;
use Modules\VoguePay\Entities\VoguePay;
use Modules\VoguePay\Entities\VoguePayBody;
use Modules\VoguePay\Http\Requests\VoguePayRequest;

class VoguePayController extends Controller
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
            $module = VoguePay::first()->data;
        } catch (\Exception $e) {
            $module = null;
        }
        $addon = Addon::findOrFail('voguepay');
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
     * @param AuthorizeNetRequest $request
     *
     * @return mixed
     */
    public function store(VoguePayRequest $request)
    {
        $voguePayBody = new VoguePayBody($request);
        VoguePay::updateOrCreate(
            ['alias' => 'voguepay'],
            [
                'name' => 'VoguePay',
                'instruction' => $request->instruction,
                'status' => $request->status,
                'sandbox' => $request->sandbox,
                'image' => 'thumbnail.png',
                'data' => json_encode($voguePayBody)
            ]
        );

        return back()->with(['AddonStatus' => 'success', 'AddonMessage' => __('Vogue Pay settings updated.')]);
    }

}
