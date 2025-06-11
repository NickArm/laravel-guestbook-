<?php

namespace App\Traits;

trait EnabledPages
{
    public function updateEnabledState($sectionSlug, $isEnabled)
    {
        $enabledPages = $this->property->enabled_pages ?? [];

        if ($isEnabled && ! in_array($sectionSlug, $enabledPages)) {

            $enabledPages[] = $sectionSlug;
        } elseif (! $isEnabled && in_array($sectionSlug, $enabledPages)) {

            $enabledPages = array_diff($enabledPages, [$sectionSlug]);
        }
        $this->property->update(['enabled_pages' => array_values($enabledPages)]);

        $this->property->refresh();

        return $enabledPages;
    }

    public function isSectionEnabled($sectionSlug)
    {
        return in_array($sectionSlug, $this->property->enabled_pages ?? []);
    }
}
