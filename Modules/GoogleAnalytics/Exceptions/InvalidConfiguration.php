<?php

namespace Modules\GoogleAnalytics\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function propertyIdNotSpecified(): static
    {
        return new static(__('There was no property ID specified. You must provide a valid property ID to execute queries on Google Analytics.'));
    }

    public static function credentialsJsonDoesNotExist(string $path): static
    {
        return new static(__("Could not find a credentials file at :x.", ['x' => $path]));
    }
}
