<?php

include "vendor/autoload.php";

$txtArchive= new \TextArchive\TXTArchive();

$column1 = new \TextArchive\IntegerColumn();
$column1->setName('transaction_id');
$txtArchive->addColumn($column1);

$column2 = new \TextArchive\IntegerColumn();
$column2->setName('abonent');
$txtArchive->addColumn($column2);

$column3 = new \TextArchive\IntegerColumn();
$column3->setName('sender');
$txtArchive->addColumn($column3);

$column4 = new \TextArchive\StringColumn();
$column4->setName('sms_test');
$txtArchive->addColumn($column4);

$column5 = new \TextArchive\DateTimeColumn();
$column5->setName('add_date');
$column5->setFormat('YmdHis');
$column5->setSecondsPrecision(60);

$txtArchive->addColumn($column5);

$column6 = new \TextArchive\DateTimeColumn();
$column6->setName('delivery_date');
$column6->setFormat('YmdHis');
$column6->setSecondsPrecision(60);

$txtArchive->addColumn($column6);


$column7 = new \TextArchive\IntegerColumn();
$column7->setName('pending_count');
$txtArchive->addColumn($column7);

$column8 = new \TextArchive\IntegerColumn();
$column8->setName('accepted_count');
$txtArchive->addColumn($column8);

$column9 = new \TextArchive\IntegerColumn();
$column9->setName('delivered_count');
$txtArchive->addColumn($column9);

$column10 = new \TextArchive\IntegerColumn();
$column10->setName('rejected_count');
$txtArchive->addColumn($column10);

$column11 = new \TextArchive\StringColumn();
$column11->setName('error_code');
$txtArchive->addColumn($column11);

$column12 = new \TextArchive\StringColumn();
$column12->setName('channel_info');
$txtArchive->addColumn($column12);


$column13 = new \TextArchive\StringColumn();
$column13->setName('mcc');
$txtArchive->addColumn($column13);

$column14 = new \TextArchive\StringColumn();
$column14->setName('mnc');
$txtArchive->addColumn($column14);

$column15 = new \TextArchive\StringColumn();
$column15->setName('network_id');
$txtArchive->addColumn($column15);

$column16 = new \TextArchive\StringColumn();
$column16->setName('node');
$txtArchive->addColumn($column16);

fgets(STDIN); // headers

while (($data = fgetcsv(STDIN, 16, ';', '"', '\\')) !== false) {
    foreach ($data as $key=>$value) {
        if ($value == '\\N') {
            $data[$key] = null;
        }
    }

    $txtArchive->push($data);
}

$txtArchive->formatBunch();