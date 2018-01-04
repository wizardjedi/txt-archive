<?php

namespace TextArchive;

class StringColumn extends BaseColumn
{
    /**
     * StringColumn constructor.
     */
    public function __construct() {
        $this->type = 'str';
    }


    public function toArchiveRow() {
        $ar = ArchiveRow::create(false, $this->getValues());

        $ar->setPrefix(false);

        return $ar;
    }
}