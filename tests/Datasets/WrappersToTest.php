<?php

dataset('WrappersToTest', function (): array {
    $viewsPath = realpath(__DIR__.'/../../resources/views/components/wrappers');
    $wrappers = [];

    foreach (new DirectoryIterator($viewsPath) as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
            $baseName = $fileInfo->getBasename('.blade.php');
            $wrappers[] = [$baseName];
        }
    }

    return $wrappers;
});
