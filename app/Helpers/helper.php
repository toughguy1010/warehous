<?php
if (!function_exists('showImage')) {
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array  $array
     * @return array
     */
    function showImage($path)
    {
        if ($path && file_exists(public_path($path))) {
           
            return asset($path);
        }
        return asset("/images/default-img.jpg");

    }
}