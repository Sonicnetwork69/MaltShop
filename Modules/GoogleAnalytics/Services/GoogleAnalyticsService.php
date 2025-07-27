<?php

namespace Modules\GoogleAnalytics\Services;

use Google\Analytics\Data\V1beta\{
    BetaAnalyticsDataClient,
    Dimension,
    Metric,
    FilterExpression,
    RunReportResponse
};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsService
{
    /**
     * @var integer|string|null
     */
    public int|string|null $propertyId = null;

    /**
     * @var string|null
     */
    public ?string $credentials = null;

    /**
     * @var integer
     */
    protected int $cacheLifeTimeInMinutes = 0;

    public function __construct()
    {
        $this->propertyId = config('analytics.property_id') ?? null;
        $this->credentials = config('analytics.service_account_credentials_json') ?? null;
    }

    /**
     * Set google property id
     *
     * @param integer $propertyId
     * @return self
     */
    public function setPropertyId(int $propertyId): self
    {
        $this->propertyId = $propertyId;

        return $this;
    }

    /**
     * Set google credentials
     *
     * @param string $credentials
     * @return self
     */
    public function setCredentials(string $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * get google credentials
     *
     * @return string|null
     */
    public function getCredentials(): ?string
    {
        return $this->credentials;
    }

    /**
     * Get google property id
     *
     * @return integer|null
     */
    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }

    /**
     * Get google client
     *
     * @return object
     */
    public function getClient()
    {
        return new BetaAnalyticsDataClient([
            'credentials' => $this->getCredentials(),
        ]);
    }

    /**
     * Get real time report data
     *
     * @param array $metrics
     * @param array $dimensions
     * @return collection
     */
    public function getRealtimeReport(
        array $metrics,
        array $dimensions = []
        ) {

        $client = $this->getClient();

        $response = $client->runRealtimeReport([
            'property' => 'properties/' . $this->getPropertyId(),
            'dimensions' => $this->getFormattedDimensions($dimensions),
            'metrics' => $this->getFormattedMetrics($metrics)
        ]);

        $typeCaster = resolve(TypeCaster::class);
        $result = collect();

        foreach ($response->getRows() as $row) {
            $rowResult = [];

            foreach ($row->getDimensionValues() as $i => $dimensionValue) {
                $rowResult[$dimensions[$i]] =
                    $typeCaster->castValue($dimensions[$i], $dimensionValue->getValue());
            }

            foreach ($row->getMetricValues() as $i => $metricValue) {
                $rowResult[$metrics[$i]] =
                    $typeCaster->castValue($metrics[$i], $metricValue->getValue());
            }

            $result->push($rowResult);
        }

        return $result;
    }

    /**
     * Formatted metrics
     *
     * @param array $metrics
     * @return array
     */
    protected function getFormattedMetrics(array $metrics): array
    {
        return collect($metrics)
            ->map(fn ($metric) => new Metric(['name' => $metric]))
            ->toArray();
    }

    /**
     * Formatted dimensions
     *
     * @param array $dimensions
     * @return array
     */
    protected function getFormattedDimensions(array $dimensions): array
    {
        return collect($dimensions)
            ->map(fn ($dimension) => new Dimension(['name' => $dimension]))
            ->toArray();
    }

    /**
     * Prepare method for get google data
     *
     * @param Period $period
     * @param array $metrics
     * @param array $dimensions
     * @param integer $maxResults
     * @param array $orderBy
     * @param integer $offset
     * @param FilterExpression|null $dimensionFilter
     * @param boolean $keepEmptyRows
     * @return Collection
     */
    public function getReport(
        Period $period,
        array $metrics,
        array $dimensions = [],
        int $maxResults = 10,
        array $orderBy = [],
        int $offset = 0,
        FilterExpression $dimensionFilter = null,
        bool $keepEmptyRows = false,
    ): Collection {
        $typeCaster = resolve(TypeCaster::class);

        $response = $this->runReport([
            'property' => "properties/{$this->propertyId}",
            'dateRanges' => [
                $period->toDateRange(),
            ],
            'metrics' => $this->getFormattedMetrics($metrics),
            'dimensions' => $this->getFormattedDimensions($dimensions),
            'limit' => $maxResults,
            'offset' => $offset,
            'orderBys' => $orderBy,
            'dimensionFilter' => $dimensionFilter,
            'keepEmptyRows' => $keepEmptyRows,
        ]);

        $result = collect();

        foreach ($response->getRows() as $row) {
            $rowResult = [];

            foreach ($row->getDimensionValues() as $i => $dimensionValue) {
                $rowResult[$dimensions[$i]] =
                    $typeCaster->castValue($dimensions[$i], $dimensionValue->getValue());
            }

            foreach ($row->getMetricValues() as $i => $metricValue) {
                $rowResult[$metrics[$i]] =
                    $typeCaster->castValue($metrics[$i], $metricValue->getValue());
            }

            $result->push($rowResult);
        }

        return $result;
    }

    /**
     * Get data from google
     *
     * @param array $request
     * @return RunReportResponse
     */
    public function runReport(array $request): RunReportResponse
    {
        $client = $this->getClient();
        $cacheName = $this->determineCacheName(func_get_args());

        if ($this->cacheLifeTimeInMinutes === 0) {
            Cache::forget($cacheName);
        }

        return Cache::remember(
            $cacheName,
            $this->cacheLifeTimeInMinutes,
            fn () => $client->runReport($request),
        );
    }

    protected function determineCacheName(array $properties): string
    {
        $hash = md5(serialize($properties));

        return "techvill.martvill-analytics.{$hash}";
    }
}
