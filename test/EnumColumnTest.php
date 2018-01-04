<?php
use TextArchive\EnumColumn;

class EnumColumnTest extends PHPUnit_Framework_TestCase
{
    const DEFAULT1 = "DEfaultValue1";

    const DEFAULT2 = "defaultValue2";

    const ITEM1 = "item1";

    const ITEM2 = "item2";

    /**
     * @var EnumColumn
     */
    protected $enumColumn;

    public function setUp()
    {
        parent::setUp();

        $this->enumColumn = new \TextArchive\EnumColumn();

        $this->
            enumColumn->
            setDefaultValues(
                array(
                    self::DEFAULT1,
                    self::DEFAULT2
                )
            );
    }

    public function testSimple() {
        $this->enumColumn->push(self::ITEM1);
        $this->enumColumn->push(self::DEFAULT1);
        $this->enumColumn->push(self::ITEM2);

        $ar = $this->enumColumn->toArchiveRow();

        $this->
            assertEquals(
                array(
                    self::ITEM1 =>  self::ITEM1,
                    self::ITEM2 =>  self::ITEM2,
                ),
                $ar->getPrefix()
            );
        $this->
            assertEquals(
                array(
                    2, 0, 3
                ),
                $ar->getRepetition()
            );
    }
}
