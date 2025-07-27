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

class MostVisitedCountryDataTable extends DataTable
{
    /**
     * DataTable Ajax
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function ajax(): JsonResponse
    {
        $mostVisitedCountry = $this->query();
        return datatables()
            ->of($mostVisitedCountry)
            ->addColumn('country', function ($mostVisitedCountry) {
                return $mostVisitedCountry['country'];
            })
            ->addColumn('activeUsers', function ($mostVisitedCountry) {
                return $mostVisitedCountry['activeUsers'];
            })
            ->rawColumns(['country', 'activeUsers'])
            ->make(true);
    }

    /**
     * DataTable Query
     *
     * @return mixed
     */
    public function query()
    {
        try {
            return (new GoogleAnalyticsService)->getReport(Period::years(1), ['activeUsers'], ['country'], 10000, [OrderBy::metric('activeUsers', true)]);
        } catch (\Throwable $th) {
            Log::error('This is an error message from most visited country data table. ' . $th);
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
            ->addColumn(['data' => 'country', 'name' => 'country', 'title' => __('Country')])
            ->addColumn(['data' => 'activeUsers', 'name' => 'activeUsers', 'title' => __('Visitors')])
            ->parameters(dataTableOptions(['order' => [1, 'DESC']]));
    }
}
