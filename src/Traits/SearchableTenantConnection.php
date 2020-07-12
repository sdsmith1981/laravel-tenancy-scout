<?php

namespace GeneaLabs\LaravelTenancyScout\Traits;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Laravel\Scout\Searchable;

trait SearchableTenantConnection
{
    use Searchable;
    use UsesTenantConnection;

    public function searchableAs() : string
    {
        $prefix = $this->getConnection()->getDatabaseName();
        $index = [$prefix, $this->table, 'index'];

        return implode('_', $index);
    }
}
