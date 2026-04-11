<?php

namespace Hawkiq\Hwkui\Helpers;

class PluginLoader
{
    protected static array $requiredPlugins = [];

    public static function require(string $pluginName): void
    {
        self::$requiredPlugins[$pluginName] = true;
    }

    public static function getRequired(): array
    {
        return array_keys(self::$requiredPlugins);
    }
}
