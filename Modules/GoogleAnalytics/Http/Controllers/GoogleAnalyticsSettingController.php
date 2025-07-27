<?php

namespace Modules\GoogleAnalytics\Http\Controllers;

use App\Lib\Env;
use App\Http\Controllers\Controller;
use Modules\GoogleAnalytics\Http\Requests\GoogleAnalyticsSettingRequest;

class GoogleAnalyticsSettingController extends Controller
{
    /**
     * Create Settings
     * @return mixed
     */
    public function settings()
    {
        $propertyId = config('analytics.property_id');
        $measurementId = moduleConfig('googleanalytics.measurement_id');

        return view('googleanalytics::settings', compact('propertyId', 'measurementId'));
    }

    /**
     * Store Settings
     *
     * @param GoogleAnalyticsRequest $request
     * @return RedirectResponse
     */
    public function settingsStore(GoogleAnalyticsSettingRequest $request)
    {
        Env::set('ANALYTICS_PROPERTY_ID', $request->propertyId);
        Env::set('ANALYTICS_MEASUREMENT_ID', $request->measurement_id);

        $fileName =  'service-account-credentials' . '.' . $request->file('attachments')->getClientOriginalExtension();
        $request->file('attachments')->move(storage_path('/app/analytics/'), $fileName);
        $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Google Analytics Settings')]), 'success');
        $this->setSessionValue($response);
        return to_route('analytics.settings')->with($response);
    }
}
