<?php

namespace TextArchive;


class TXTArchiveTest extends \PHPUnit_Framework_TestCase
{
    public function testTXTArchive() {
        $txtArchive= new TXTArchive();
        $txtArchive->setBunchSize(10);

        $column = new IntegerColumn();
        $column->setName('transaction_id');

        $txtArchive->addColumn($column);

        $column2 = new DateTimeColumn();
        $column2->setName('add_date');
        $column2->setSecondsPrecision(60);

        $txtArchive->addColumn($column2);

        for ($i=0;$i<20;$i++) {
            $data =
                array(
                    rand(0,2),
                    date('Y-m-d H:i:s', strtotime('2017-01-01 00:00:00') + rand(0,86400))
                );

            $txtArchive->push($data);
        }

        $txtArchive->formatBunch();
    }
}
