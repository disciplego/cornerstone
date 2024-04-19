<?php

namespace Dgo\Cornerstone;

class DynamicRobotsTxt
{
    public function checkAndPromptForRobotsTxt(): string
    {
        if (file_exists(public_path('robots.txt'))) {
            $response = readline('A robots.txt file already exists. Do you want to delete it? (y/n): ');

            if (strtolower($response) === 'y') {
                unlink(public_path('robots.txt'));

                return 'Existing robots.txt file deleted.';
            } else {
                return 'Leaving existing robots.txt file.';
            }
        }

        return 'No existing robots.txt file found.';
    }
}
