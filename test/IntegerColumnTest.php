<?php

class IntegerColumnTest extends PHPUnit_Framework_TestCase
{
    public function testColumn() {
        $column = new TextArchive\IntegerColumn();

        $column->push(100);
        $column->push(100);
        $column->push(100);
        $column->push(100);
        $column->push(99);
        $column->push(97);
        $column->push(110);
        $column->push(110);
        $column->push(110);

        $column->toArchiveRow();
    }
}
