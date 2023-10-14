<?php

use PHPUnit\Framework\TestCase;
use Podlove\Chapters\Chapter;
use Podlove\Chapters\Chapters;
use Podlove\Chapters\Printer;

/**
 * @internal
 *
 * @coversNothing
 */
class Mp4chapsPrinterTest extends TestCase
{
    public function testPrinter()
    {
        $expected_print = trim('
00:00:01.234 Intro <http://example.com>
00:12:34.000 About us
01:02:03.000 Later
');

        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(1234, 'Intro', 'http://example.com'));
        $chapters->addChapter(new Chapter(754000, 'About us'));
        $chapters->addChapter(new Chapter(3723000, 'Later'));
        $chapters->setPrinter(new Printer\Mp4chaps());

        $this->assertEquals($expected_print, (string) $chapters);
    }
}
