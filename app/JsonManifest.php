<?php
namespace Otomaties\PluginBoilerplate;

class JsonManifest
{
    /**
     * The json manifest with assets
     *
     * @var array<string, array<string, string>>
     */
    private array $manifest;

    /**
     * Set manifest
     *
     * @param string $manifestPath
     */
    public function __construct(string $manifestPath)
    {
        if (file_exists($manifestPath) && $manifestFileContent = file_get_contents($manifestPath)) {
            $this->manifest = json_decode($manifestFileContent, true);
        } else {
            $this->manifest = [];
        }
    }

    /**
     * Get the manifest
     *
     * @return array<string, array<string, string>>
     */
    public function get() : array
    {
        return $this->manifest;
    }
}
