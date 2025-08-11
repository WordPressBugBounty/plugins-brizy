<?php

namespace BrizyPlaceholders;

class PlaceholderDependency
{
    private $type;
    private $identifier;

    public function __construct($type, $identifier)
    {
        $this->type = $type;
        $this->identifier = $identifier;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier): void
    {
        $this->identifier = $identifier;
    }
}