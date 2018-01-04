<?php

namespace TextArchive;

use phpDocumentor\Reflection\DocBlock\Tags\Param;

class TXTArchive
{
    const DEFAULT_BUNCH_SIZE = 1000;

    /**
     * @var [BaseColumn]
     */
    protected $columns = array();

    /**
     * @var int
     */
    protected $bunchSize = self::DEFAULT_BUNCH_SIZE;

    protected $rowsInBunch = 0;

    protected $rowToStringConverter;

    protected $header = false;

    /**
     * TXTArchive constructor.
     */
    public function __construct()
    {
        $this->rowToStringConverter = new ArchiveRowToStringConverter();
    }

    // API

    /**
     * @param array $data
     */
    public function push($data) {
        $values = array_values($data);

        for ($i=0;$i<count($values);$i++) {
            $column = $this->columns[$i];

            $column->push($values[$i]);
        }

        $this->rowsInBunch++;

        if ($this->rowsInBunch >= $this->bunchSize) {
            $this->formatBunch();

            $this->rowsInBunch = 0;

            foreach ($this->getColumns() as $column) {
                $column->clear();
            }
        }
    }

    public function formatBunch() {
        if ($this->rowsInBunch == 0) {
            return ;
        }

        $this->checkHeader();

        echo 'bunch:'.$this->rowsInBunch."\n";

        foreach ($this->getColumns() as $column) {
            $row = $column->toArchiveRow();

            echo $this->rowToStringConverter->convert($row)."\n";
        }
    }

    public function addColumn(BaseColumn $column) {
        // TODO: $this->columns[$column->getName()] = $column;
        $this->columns[] = $column;
    }

    public function checkHeader() {
        if (!$this->isHeader()) {
            echo "archive:";

            $columnDescriptions = array();

            foreach ($this->getColumns() as $column) {
                $columnDescriptions[] = $column->getName().'='.$column->getType();
            }

            echo implode(';', $columnDescriptions);

            echo "\n";

            $this->header = true;
        }
    }

    // GETTERS & SETTERS

    /**
     * @return int
     */
    public function getRowsInBunch()
    {
        return $this->rowsInBunch;
    }

    /**
     * @param int $rowsInBunch
     */
    public function setRowsInBunch($rowsInBunch)
    {
        $this->rowsInBunch = $rowsInBunch;
    }

    /**
     * @return ArchiveRowToStringConverter
     */
    public function getRowToStringConverter()
    {
        return $this->rowToStringConverter;
    }

    /**
     * @param ArchiveRowToStringConverter $rowToStringConverter
     */
    public function setRowToStringConverter($rowToStringConverter)
    {
        $this->rowToStringConverter = $rowToStringConverter;
    }

    /**
     * @return bool
     */
    public function isHeader()
    {
        return $this->header;
    }

    /**
     * @param bool $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return int
     */
    public function getBunchSize()
    {
        return $this->bunchSize;
    }

    /**
     * @param int $bunchSize
     */
    public function setBunchSize($bunchSize)
    {
        $this->bunchSize = $bunchSize;
    }

}