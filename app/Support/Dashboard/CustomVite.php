<?php

namespace App\Support\Dashboard;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class CustomVite
{
    public function __invoke($entrypoints, $publicDirectory = '', $buildDirectory = 'build'): HtmlString
    {
        static $manifests = [];

        $entrypoints = collect($entrypoints);

        $buildDirectory = Str::start($buildDirectory, $publicDirectory.'/');
        $publicPath = function ($path = '') use ($publicDirectory) {
            return public_path($publicDirectory.DIRECTORY_SEPARATOR.$path);
        };
        if (is_file($publicPath('hot'))) {
            $url = rtrim(file_get_contents($publicPath('hot')));

            return new HtmlString(
                $entrypoints
                    ->map(fn ($entrypoint) => $this->makeTag("{$url}/{$entrypoint}"))
                    ->prepend($this->makeScriptTag("{$url}/@vite/client"))
                    ->join('')
            );
        }

        $manifestPath = public_path($buildDirectory.'/manifest.json');

        if (! isset($manifests[$manifestPath])) {
            if (! is_file($manifestPath)) {
                throw new \Exception("Vite manifest not found at: {$manifestPath}");
            }

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        $tags = collect();

        foreach ($entrypoints as $entrypoint) {
            if (! isset($manifest[$entrypoint])) {
                throw new \Exception("Unable to locate file in Vite manifest: {$entrypoint}.");
            }

            $tags->push($this->makeTag(asset("{$buildDirectory}/{$manifest[$entrypoint]['file']}")));

            if (isset($manifest[$entrypoint]['css'])) {
                foreach ($manifest[$entrypoint]['css'] as $css) {
                    $tags->push($this->makeStylesheetTag(asset("{$buildDirectory}/{$css}")));
                }
            }

            if (isset($manifest[$entrypoint]['imports'])) {
                foreach ($manifest[$entrypoint]['imports'] as $import) {
                    if (isset($manifest[$import]['css'])) {
                        foreach ($manifest[$import]['css'] as $css) {
                            $tags->push($this->makeStylesheetTag(asset("{$buildDirectory}/{$css}")));
                        }
                    }
                }
            }
        }

        [$stylesheets, $scripts] = $tags->partition(fn ($tag) => str_starts_with($tag, '<link'));

        return new HtmlString($stylesheets->join('').$scripts->join(''));
    }

    /**
     * Generate an appropriate tag for the given URL.
     *
     * @param  string  $url
     * @return string
     */
    protected function makeTag($url)
    {
        if ($this->isCssPath($url)) {
            return $this->makeStylesheetTag($url);
        }

        return $this->makeScriptTag($url);
    }

    /**
     * Generate a script tag for the given URL.
     *
     * @param  string  $url
     * @return string
     */
    protected function makeScriptTag($url)
    {
        return sprintf('<script type="module" src="%s"></script>', $url);
    }

    /**
     * Generate a stylesheet tag for the given URL.
     *
     * @param  string  $url
     * @return string
     */
    protected function makeStylesheetTag($url)
    {
        return sprintf('<link rel="stylesheet" href="%s" />', $url);
    }

    /**
     * Determine whether the given path is a CSS file.
     *
     * @param  string  $path
     * @return bool
     */
    protected function isCssPath($path)
    {
        return preg_match('/\.(css|less|sass|scss|styl|stylus|pcss|postcss)$/', $path) === 1;
    }
}
