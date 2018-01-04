<?php

namespace TextArchive;

class IntegerColumn extends BaseColumn
{
    /**
     * IntegerColumn constructor.
     */
    public function __construct() {
        $this->type = 'int';
    }


    public function toArchiveRow() {
        list($min, $deltas) = IntegerUtils::intArrayToDeltaMinArray($this->getValues());

        return ArchiveRow::create($min, $deltas);
    }
}