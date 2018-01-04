<?php

namespace TextArchive;

final class IntegerUtils {
    public static function intArrayToDeltaMinArray($values) {
        $min =
            min(
                array_filter(
                    $values,
                    function($el) {
                        return
                            ($el !== null)
                            && ($el !== '\\N');
                    }
                )
            );

        $deltas = array();
        foreach ($values as $value) {
            if ($value === null) {
                $deltas[] = '\\N';

                continue;
            }

            $deltas[] = $value - $min;
        }

        return array($min, $deltas);
    }
}