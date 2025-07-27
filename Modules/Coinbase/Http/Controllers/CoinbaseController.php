<?php

namespace Modules\Coinbase\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Addons\Entities\Addon;
use Modules\Coinbase\Entities\Coinbase;
use Modules\Coinbase\Entities\CoinbaseBody;
use Modules\Coinbase\Http\Requests\CoinbaseRequest;

class CoinbaseController extends Controller
{

    public function store(CoinbaseRequest $request)
    {
        $coinbaseBody = new CoinbaseBody($request);

        Coinbase::updateOrCreate(
            ['alias' => moduleConfig('coinbase.alias')],
            [
                'name' => moduleConfig('coinbase.name'),
                'instruction' => $request->instruction,
                'status' => $request->status,
                'sandbox' => $request->sandbox,
                'image' => 'thumbnail.png',
                'data' => json_encode($coinbaseBody)
            ]
        );

        return back()->with(['AddonStatus' => 'success', 'AddonMessage' => __('Coinbase settings updated.')]);
    }

    public function edit(Request $request)
    {
        try {
            $module = Coinbase::first()->data;
        } catch (\Exception $e) {
            $module = null;
        }
        $addon = Addon::findOrFail('coinbase');

        return response()->json(
            [
                'html' => view('gateway::partial.form', compact('module', 'addon'))->render(),
                'status' => true
            ],
            200
        );
    }
}
