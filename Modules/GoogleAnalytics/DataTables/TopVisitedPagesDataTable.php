<?php

namespace Modules\GoogleAnalytics\DataTables;

use App\DataTables\DataTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Modules\GoogleAnalytics\Services\{
    GoogleAnalyticsService,
    OrderBy,
    Period
};

class TopVisitedPagesDataTable extends DataTable
{
    /*
    * DataTable Ajax
    *
    * @return \Yajra\DataTables\DataTableAbstract|\Yajra\DataTables\DataTables
    */
    public function ajax(): JsonResponse
    {
        $topVisitedList = $this->query();
        return datatables()
            ->of($topVisitedList)
            ->addColumn('date', function ($topVisitedList) {
                return $topVisitedList['date']->toDateString();
            })
            ->addColumn('pageTitle', function ($topVisitedList) {
                return '<a href="https://' . $topVisitedList['fullPageUrl'] . '" target="_blank">' . wrapIt($topVisitedList['pageTitle'], 10) . '</a>';
            })
            ->addColumn('activeUsers', function ($topVisitedList) {
                return $topVisitedList['activeUsers'];
            })
            ->addColumn('screenPageViews', function ($topVisitedList) {
                return $topVisitedList['screenPageViews'];
            })
            ->rawColumns(['date', 'pageTitle', 'activeUsers', 'screenPageViews'])
            ->make(true);
    }

    /*
    * DataTable Query
    *
    * @return mixed
    */
    public function query()
    {
        try {
            return (new GoogleAnalyticsService)->getReport(Period::years(1), ['activeUsers', 'screenPageViews'], ['pageTitle', 'date', 'fullPageUrl'], 10000, [OrderBy::metric('screenPageViews', true)], 0);
        } catch (\Throwable $th) {
            Log::error('This is an error message from most visited pages data table. ' . $th);
            return [];
        }
    }

    /**
     * DataTable HTML
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'date', 'name' => 'date', 'title' => __('Date')])
            ->addColumn(['data' => 'pageTitle', 'name' => 'pageTitle', 'title' => __('Title'), 'width' => '70%'])
            ->addColumn(['data' => 'activeUsers', 'name' => 'activeUsers', 'title' => __('Visitors')])
            ->addColumn(['data' => 'screenPageViews', 'name' => 'screenPageViews', 'title' => __('Views')])
            ->parameters(dataTableOptions(['order' => [3, 'DESC']]));
    }
}
