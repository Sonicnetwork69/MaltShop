<?php

namespace Modules\GoogleAnalytics\Services;

use Google\Analytics\Data\V1beta\OrderBy as GoogleOrderBy;
use Google\Analytics\Data\V1beta\OrderBy\{
    DimensionOrderBy,
    MetricOrderBy
};

class OrderBy
{
    /**
     * Get dimension data order by
     *
     * @param string $dimension
     * @param boolean $descending
     * @return GoogleOrderBy
     */
    public static function dimension(string $dimension, bool $descending = false): GoogleOrderBy
    {
        $dimensionOrderBy = (new DimensionOrderBy())->setDimensionName($dimension);

        return (new GoogleOrderBy())->setDimension(
            $dimensionOrderBy,
        )->setDesc($descending);
    }

    /**
     * Get metric data order by
     *
     * @param string $metric
     * @param boolean $descending
     * @return GoogleOrderBy
     */
    public static function metric(string $metric, bool $descending = false): GoogleOrderBy
    {
        $metricOrderBy = (new MetricOrderBy())->setMetricName($metric);

        return (new GoogleOrderBy())->setMetric(
            $metricOrderBy,
        )->setDesc($descending);
    }
}
