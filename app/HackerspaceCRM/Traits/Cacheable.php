<?php

namespace HackerspaceCRM\Traits;

trait Cacheable
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
}
