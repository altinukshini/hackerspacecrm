<?php

namespace HackerspaceCRM\Traits;

trait Cacheable
{
    /*
     * Calculate a unique cache key for the model instance.
     *
     * @return String
     */
    public function getObjectCacheKey()
    {
        return sprintf('%s/%s-%s',
            get_class($this),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }
}
