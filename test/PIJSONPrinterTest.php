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
class PIJSONPrinterTest extends TestCase
{
    public function testPrinter()
    {
        $expected_print = json_encode(
            json_decode('{
              "version": "1.2.0",
              "chapters": [
	{ "startTime": 1.234, "title": "Intro", "url": "http://example.com" },
	{ "startTime": 754.0, "title": "About us" },
	{ "startTime": 3723.0, "title": "Later", "img": "http://example.com/foo.jpg" }
]
}'),
        );

        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(1234, "Intro", "http://example.com"));
        $chapters->addChapter(new Chapter(754000, "About us"));
        $chapters->addChapter(
            new Chapter(3723000, "Later", "", "http://example.com/foo.jpg"),
        );
        $chapters->setPrinter(new Printer\PodcastIndexJSON());

        $this->assertEquals($expected_print, (string) $chapters);
    }
}
