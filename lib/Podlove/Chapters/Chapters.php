<?php

namespace Podlove\Chapters;

class Chapters implements \Iterator, \ArrayAccess, \Countable
{
    private $chapters = [];
    private $position = 0;
    private $printer;

    public function __construct()
    {
        $this->setPrinter(new Printer\Nullprinter());
    }

    public function __toString()
    {
        return $this->printer->do_print($this);
    }

    public function addChapter($chapter)
    {
        $this->chapters[] = $chapter;
    }

    public function setPrinter(Printer\Printer $printer)
    {
        $this->printer = $printer;
    }

    public function toArray()
    {
        return $this->chapters;
    }

    /**
     * Iterator Methods.
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->chapters[$this->position];
    }

    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->chapters[$this->position]);
    }

    /**
     * ArrayAccess Methods.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->chapters[] = $value;
        } else {
            $this->chapters[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->chapters[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->chapters[$offset]);
    }

    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->chapters[$offset]) ? $this->chapters[$offset] : null;
    }

    /**
     * Countable Methods.
     */
    public function count(): int
    {
        return count($this->chapters);
    }
}
