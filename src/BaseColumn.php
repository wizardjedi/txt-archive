<?php

namespace TextArchive;

abstract class BaseColumn
{
    protected $name;

    protected $type;

    protected $values = array();

    public function push($value) {
        $this->values[] = $value;
    }

    public function clear() {
        $this->values = array();
    }

    public abstract function toArchiveRow();

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function setType($type)
    {
        $this->type = $type;
    }


}