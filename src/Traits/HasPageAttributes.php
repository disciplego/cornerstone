<?php

namespace Dgo\Cornerstone\Traits;

trait HasPageAttributes
{
    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getLead()
    {
        return $this->lead;
    }
    public function getFeaturedImage()
    {
        return $this->featuredImage_id ? $this->featuredImage->url : null;
    }

    public function getIsActivated()
    {
        return $this->is_activated;
    }
}