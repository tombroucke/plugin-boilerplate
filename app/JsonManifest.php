<?php
namespace Otomaties\PluginBoilerplate;

class JsonManifest
{

    private $manifest;

    public function __construct(string $manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = array();
        }
    }

    public function get() : array
    {
        return $this->manifest;
    }
}
