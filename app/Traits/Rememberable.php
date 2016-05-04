<?php

namespace App\Traits;

use App\Models\RememberableQueryBuilder as Builder;

trait Rememberable
{
    /*
     * Get a cache key for a single object of model
     *
     * @return String
     */
    public function getObjectCacheKey()
    {
        return sprintf('%s/%s-%s',
            get_class($this),
            $this->id,
            $this->updated_at->timestamp
        );
    }

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        $builder = new Builder($conn, $grammar, $conn->getPostProcessor());

        if (isset($this->rememberFor)) {
            $builder->remember($this->rememberFor);
        }

        return $builder;
    }
}
