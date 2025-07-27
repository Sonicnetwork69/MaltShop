<?php

namespace Modules\GoogleAnalytics\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Google\Service\Exception as GoogleException;
use Illuminate\Http\Request;
use Modules\GoogleAnalytics\DataTables\{
    MostVisitedCountryDataTable,
    TopVisitedPagesDataTable
};
use Modules\GoogleAnalytics\Services\{
    GoogleAnalyticsService,
    OrderBy,
    Period
};

class GoogleAnalyticsController extends Controller
{
    /**
     * @var array
     */
    public $devices = [
        ["DESKTOP", '0'],
        ["MOBILE", '0'],
        ["TABLET", '0'],
    ];

    public $googleAnalyticsService;

    public function __construct(GoogleAnalyticsService $googleAnalyticsService)
    {
        $this->googleAnalyticsService = $googleAnalyticsService;
    }


    /**
     * Analytics Dashboard
     * @return mixed
     */
    public function dashboard()
    {
        return view('googleanalytics::dashboard');
    }

    /**
     * Top Visited Page
     * @param TopVisitedPagesDataTable $dataTable
     * @return mixed
     */
    public function topVisitedPage(TopVisitedPagesDataTable $dataTable)
    {
        return $dataTable->render('googleanalytics::top_visited_pages');
    }

    /**
     * Most Visited Country
     * @param MostVisitedCountryDataTable $dataTable
     * @return mixed
     */
    public function mostVisitedCountry(MostVisitedCountryDataTable $dataTable)
    {
        return $dataTable->render('googleanalytics::most_visited_country');
    }



    /**
     * Device Ajax Data
     *
     * @return response json
     */
    public function device(Request $request)
    {
        try {

            $startDate = Carbon::parse($request->startDate) ?? Carbon::now()->subMonth();
            $endDate = Carbon::parse($request->endDate) ?? Carbon::now();

            $deviceUser = $this->googleAnalyticsService->getReport(Period::create($startDate, $endDate), ['activeUsers'], ['deviceCategory']);

            $deviceUser['level'] = $deviceUser->pluck("deviceCategory")->all();
            $deviceUser['data'] = $deviceUser->pluck("activeUsers")->all();
            
            return response()->json([
                'status' => 200,
                'device' => $deviceUser
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }



    /**
     * Audience View Ajax Data
     *
     * @return response json
     */
    public function audience(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->startDate) ?? Carbon::now()->subMonth();
            $endDate = Carbon::parse($request->endDate) ?? Carbon::now();
            $audience = [['unifiedScreenName' => __("No Data Available")]];

            $audience = $this->googleAnalyticsService->getReport(Period::create($startDate, $endDate), ['newUsers', 'activeUsers']);

            if ($audience->count() > 0) {
                $data = $audience->flatten()->values();
            }
            return response()->json([
                'status' => 200,
                'audience' => $data ?? [0, 0],
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }

    /**
     * Location View Ajax Data
     *
     * @return response json
     */
    public function location(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->startDate) ?? Carbon::now()->subMonth();
            $endDate = Carbon::parse($request->endDate) ?? Carbon::now();

            $location = [['unifiedScreenName' => __("No Data Available")]];

            $location = $this->googleAnalyticsService->getReport(Period::create($startDate, $endDate), ['activeUsers'], ['country']);

            $data['level'] = $location->pluck("country")->all();
            $data['value'] = $location->pluck("activeUsers")->all();

            return response()->json([
                'status' => 200,
                'location' => $data
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }

    /**
     * Page View Ajax Data
     *
     * @return response json
     */
    public function pageView(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->startDate) ?? Carbon::now()->subMonth();
            $endDate = Carbon::parse($request->endDate) ?? Carbon::now();
            $data = [];

            $pageView = [['unifiedScreenName' => __("No Data Available")]];


            $pageView = $this->googleAnalyticsService->getReport(Period::create($startDate, $endDate), ['screenPageViews'], ['date'], 2000, [OrderBy::dimension('date')]);

            $data['level'] = $pageView->pluck("date")->map(function ($date) {
                return Carbon::parse($date)->format('M d, y');
            })->all();
            $data['value'] = $pageView->pluck("screenPageViews")->all();


            return response()->json([
                'status' => 200,
                'pageView' => $data
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }
    /**
     * Page View Ajax Data
     *
     * @return response json
     */
    public function visitor(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->startDate) ?? Carbon::now()->subMonth();
            $endDate = Carbon::parse($request->endDate) ?? Carbon::now();
            $visitor = [['unifiedScreenName' => __("No Data Available")]];

            $visitor = $this->googleAnalyticsService->getReport(Period::create($startDate, $endDate), ['activeUsers'], ['date'], 2000, [OrderBy::dimension('date')]);



            $data['level'] = $visitor->pluck("date")->map(function ($date) {
                return Carbon::parse($date)->format('M d, y');
            })->all();
            $data['value'] = $visitor->pluck("activeUsers")->all();

            return response()->json([
                'status' => 200,
                'visitor' => $data
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }

    /**
     * user Ajax Data
     *
     * @return response json
     */
    public function user()
    {
        try {
            $activeUsers = array(["activeUsers" => "0"]);
            $deviceUser = $this->devices;

            $deviceUser = $this->googleAnalyticsService->getRealtimeReport(['activeUsers'], ['deviceCategory']);;

            if ($deviceUser->count() > 0) {
                $activeUsers[0]['activeUsers'] = $deviceUser->pluck("activeUsers")->count();
            }

            return response()->json([
                'status' => 200,
                'activeUser' => $activeUsers,
                'device' => $deviceUser
            ]);
        } catch (GoogleException $e) {
            return $this->responseError(400, [['message' => $e->getErrors()]]);
        } catch (\Exception $e) {
            return $this->responseError(400, [['message' => $e->getMessage()]]);
        }
    }

    /**
     * Response Error message
     *
     * @param string|integer $status
     * @param string|null|array $message
     * @return json
     */
    public function responseError(string|int $status, string|null|array $message)
    {
        return response()->json([
            'status' => $status,
            'error' =>  $message,
        ]);
    }
}
