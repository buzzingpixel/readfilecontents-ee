<?php

/**
 * @author TJ Draper <tj@buzzingpixel.com>
 * @copyright 2017 BuzzingPixel, LLC
 */

/** @noinspection AutoloadingIssuesInspection */
/**
 * Class Readfilecontents
 */
class Readfilecontents
{
    /**
     * Read the file contents
     */
    public function read()
    {
        // Set up some paths
        $paths = array(
            'publicPath' => rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/',
            'sysPath' => SYSPATH,
            'pathThird' => PATH_THIRD,
            'pathCache' => PATH_CACHE,
            'pathTmpl' => PATH_TMPL,
            'pathThirdThemes' => PATH_THIRD_THEMES
        );

        // Get template class
        /** @var \EE_Template $tmpl */
        $tmpl = ee()->TMPL;

        // Fetch tag parameters
        $pathToFile = $tmpl->fetch_param('path_to_file');
        $basePath = $tmpl->fetch_param('base_path');

        // Set the basePath
        $basePath = isset($paths[$basePath]) ?
            $paths[$basePath] :
            $paths['publicPath'];

        // Normalize path to file
        $pathToFile = ltrim($pathToFile, '/');

        // Set full file path
        $fullFilePath = "{$basePath}{$pathToFile}";

        // Get file contents if it exists
        $fileContents = '';
        if (is_file($fullFilePath)) {
            $fileContents = file_get_contents($fullFilePath);
        }

        // Parse tag pair
        return $tmpl->parse_variables($tmpl->tagdata, array(array(
            'contents' => $fileContents
        )));
    }
}
