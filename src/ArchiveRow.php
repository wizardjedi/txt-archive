<?php

namespace TextArchive;

class ArchiveRow
{
    /**
     * @var array
     */
    protected $prefix;

    /**
     * @var array
     */
    protected $repetition;

    public static function create($prefix, $repetition) {
        $ar = new ArchiveRow();

        if (is_array($prefix)) {
            $ar->setPrefix($prefix);
        } else {
            $ar->setPrefix(array($prefix));
        }

        $ar->setRepetition($repetition);

        return $ar;
    }

    /**
     * @return array
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param array $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getRepetition()
    {
        return $this->repetition;
    }

    /**
     * @param array $repetition
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;
    }


}