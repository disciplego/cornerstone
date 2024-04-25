<?php

namespace Dgo\Cornerstone\Traits;

trait HasHashtags
{
    /**
     * Add a hashtag to the model.
     */
    public function addHashtag(?string $hashtag): bool
    {
        if(!$hashtag) return false;
        // Ensure the hashtag starts with a #
        $hashtag = '#' . ltrim($hashtag, '#');

        // Get a copy of the current hashtags array
        $hashtags = $this->hashtags ?? [];

        // Add the hashtag if it's not already in the array
        if (!in_array($hashtag, $hashtags)) {
            $hashtags[] = $hashtag;
        }

        // Reassign the modified array back to the model's property
        $this->hashtags = $hashtags;

        // Save the model if it's not a new model
        if ($this->exists) {
            $this->save();
        }

        return true;
    }

    /**
     * Remove a hashtag from the model.
     */
    public function removeHashtag(?string $hashtag): bool
    {
        if(!$hashtag) return false;

        $hashtags = $this->hashtags ?? [];
        if (($key = array_search($hashtag, $hashtags)) !== false) {
            unset($hashtags[$key]);
        }
        $this->hashtags = array_values($hashtags);
        $this->save();
        return true;
    }

    /**
     * Compile hashtags into an array.
     */
    public function compileHashtagsToArray(): array
    {
        $hashtags = is_array($this->hashtags) ? $this->hashtags : ($this->hashtags ? [$this->hashtags] : []);
        return array_unique(array_filter($hashtags ?? []));
    }

    /**
     * Compile hashtags into a string.
     */
    public function compileHashtagsToString(): string
    {
        return implode(' ', $this->compileHashtagsToArray());
    }

}