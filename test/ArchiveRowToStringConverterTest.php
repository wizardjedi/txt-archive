<?php

class ArchiveRowToStringConverterTest extends PHPUnit_Framework_TestCase
{
    public function testSimple() {
        $ar = TextArchive\ArchiveRow::create('prefix', array(1,2,3,4,5,6,7,8));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('prefix=1;2;3;4;5;6;7;8', $converter->convert($ar));
    }

    public function testSimpleRepetition() {
        $ar = TextArchive\ArchiveRow::create('prefix', array(1,1,2,2,2,2.5,3,3,3,3,4));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('prefix=2*1;3*2;2.5;4*3;4', $converter->convert($ar));
    }

    public function testSimpleRepetition1() {
        $ar = TextArchive\ArchiveRow::create('prefix', array(1));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('prefix=1', $converter->convert($ar));
    }

    public function testSimpleRepetition2() {
        $ar = TextArchive\ArchiveRow::create('prefix', array(1,1));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('prefix=2*1', $converter->convert($ar));
    }

    public function testSimpleRepetition3() {
        $ar = TextArchive\ArchiveRow::create('prefix', array(2,1,1,3));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('prefix=2;2*1;3', $converter->convert($ar));
    }

    public function testMultiPrefix() {
        $ar = TextArchive\ArchiveRow::create(array('p1','p2'), array(2,1,1,3));

        $converter = new TextArchive\ArchiveRowToStringConverter();

        $this->assertEquals('p1;p2=2;2*1;3', $converter->convert($ar));
    }
}
