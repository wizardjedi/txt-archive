<?php

namespace TextArchive;

class DateTimeColumn extends BaseColumn
{
    const DEFAULT_SECONDS_PRECISION = 1;

    const DEFAULT_FORMAT = 'Y-m-d H:i:s';

    protected $secondsPrecision = self::DEFAULT_SECONDS_PRECISION;

    protected $format = self::DEFAULT_FORMAT;

    /**
     * DateTimeColumn constructor.
     */
    public function __construct() {
        $this->type = 'datetime';
    }


    public function toArchiveRow() {
        $timestamps = array();

        foreach ($this->getValues() as $value) {
            if ($value === null) {
                $timestamps[] = '\\N';

                continue;
            }

            $timestamp =
                \DateTime::createFromFormat(
                    $this->getFormat(),
                    $value
                );

            $timestampAfterPrecision = $timestamp->getTimestamp() / $this->getSecondsPrecision();

            $timestamps[] = (int)$timestampAfterPrecision;
        }

        list($min, $deltas) = IntegerUtils::intArrayToDeltaMinArray($timestamps);

        return ArchiveRow::create($min, $deltas);
    }

    /**
     * @return int
     */
    public function getSecondsPrecision()
    {
        return $this->secondsPrecision;
    }

    /**
     * @param int $secondsPrecision
     */
    public function setSecondsPrecision($secondsPrecision)
    {
        $this->secondsPrecision = $secondsPrecision;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }
}