<?php

namespace TextArchive;

class ArchiveRowToStringConverter
{
    public function convert(ArchiveRow $row) {
        $prefix = $row->getPrefix();

        if (!empty($prefix)) {
            $prefixValues = implode(';', $row->getPrefix()).'=';
        } else {
            $prefixValues = '';
        }

        $repetitionValues = $this->processRepetitonValues($row->getRepetition());

        return $prefixValues.$repetitionValues;
    }

    public function processRepetitonValues($values) {
        $lastValue = $values[0];
        $repeat = 1;

        $repetition = array();

        for ($i = 1; $i < count($values); $i++) {
            if ($lastValue != $values[$i]) {
                $repetition[] = $this->constructRepetitionString($repeat, $lastValue);

                $repeat = 1;
                $lastValue = $values[$i];
            } else {
                $repeat++;
            }
        }

        $repetition[] = $this->constructRepetitionString($repeat, $lastValue);

        return implode(';', $repetition);
    }

    public function constructRepetitionString($repeat, $value) {
        if ($repeat > 1) {
            return $repeat.'*'.$value;
        } else {
            return $value;
        }
    }
}