<?php

namespace Dgo\Cornerstone\Contracts;

interface PageInterface
{
    public function getTitle();
    public function getSlug();
    public function getLead();
    public function getFeaturedImage();
    public function getIsActivated();
}