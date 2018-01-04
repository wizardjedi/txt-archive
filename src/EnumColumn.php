<?php

namespace TextArchive;

class EnumColumn extends BaseColumn
{
    protected $defaultValues = array();

    /**
     * EnumColumn constructor.
     */
    public function __construct() {
        $this->type = 'enum';
    }

    public function toArchiveRow() {
        throw new \Exception("Not implemented");
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        return $this->defaultValues;
    }

    /**
     * @param array $defaultValues
     */
    public function setDefaultValues($defaultValues)
    {
        $this->defaultValues = $defaultValues;
    }
}