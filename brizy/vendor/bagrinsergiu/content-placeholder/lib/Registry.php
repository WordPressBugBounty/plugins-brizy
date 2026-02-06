<?php

namespace BrizyPlaceholders;

/**
 * Class Registry
 * @package BrizyPlaceholders
 */
class Registry implements RegistryInterface
{
    /**
     * @var array <string, callable> List of placeholder class names and their factories
     */
    private $placeholderCallbacks = [];
    private $placeholderInstanceCache = [];

    /**
     * @param PlaceholderInterface $instance
     * @param string $label
     * @param string $placeholderName
     * @param string $groupName
     *
     * @return mixed|void
     * @deprecated
     */
    public function registerPlaceholder(PlaceholderInterface $instance)
    {
        $this->registerPlaceholderName($instance->getPlaceholder(), function () use ($instance) {
            return $instance;
        });
    }

    public function registerPlaceholderName(string $placeholderName, callable $factory)
    {
        $this->placeholderCallbacks[$placeholderName] = $factory;
    }

    /**
     * @return PlaceholderInterface|null
     * @inheritDoc
     */
    public function getPlaceholderSupportingName($aname)
    {
        if (isset($this->placeholderInstanceCache[$aname])) {
            return $this->placeholderInstanceCache[$aname];
        }

        if (isset($this->placeholderCallbacks[$aname])) {
            $factory = $this->placeholderCallbacks[$aname];
            return $this->placeholderInstanceCache[$aname] = $factory($aname);
        }

        return null;
    }

    public function getPlaceholders()
    {
        $all = [];
        foreach ($this->placeholderCallbacks as $placeholderName => $factory) {
            $all[] = $this->getPlaceholderSupportingName($placeholderName);
        }

        return $all;
    }
}
