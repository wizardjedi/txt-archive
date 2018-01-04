<?php

namespace TextArchive;

class EnumColumn extends BaseColumn
{
    protected $defaultValues = array();

    protected $caseSensitive = false;

    /**
     * EnumColumn constructor.
     */
    public function __construct() {
        $this->type = 'enum';
    }

    public function toArchiveRow() {
        $grouppedValues = array();

        foreach ($this->getValues() as $value) {
            if ($this->getIndex($value, array()) === null) {
                $grouppedValues[$value] = $value;
            }
        }

        $result = array();

        foreach ($this->getValues() as $value) {
            $idx = $this->getIndex($value, $grouppedValues);

            $result[] = $idx;
        }

        return ArchiveRow::create($grouppedValues, $result);
    }

    public function getIndex($value, $grouppedValues) {
        $processedValue = $this->getCaseValue($value);

        $index = 0;
        foreach ($this->getDefaultValues() as $defaultValue) {
            if ($this->getCaseValue($defaultValue) == $processedValue) {
                return $index;
            }

            $index++;
        }

        $index = count($this->getDefaultValues());
        foreach ($grouppedValues as $groupValue) {
            if ($this->getCaseValue($groupValue) == $processedValue) {
                return $index;
            }

            $index++;
        }

        return null;
    }

    public function getCaseValue($value) {
        if ($this->isCaseSensitive()) {
            return $value;
        } else {
            return mb_strtolower($value);
        }
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

    /**
     * @return bool
     */
    public function isCaseSensitive()
    {
        return $this->caseSensitive;
    }

    /**
     * @param bool $caseSensitive
     */
    public function setCaseSensitive($caseSensitive)
    {
        $this->caseSensitive = $caseSensitive;
    }
}