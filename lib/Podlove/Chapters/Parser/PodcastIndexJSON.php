<?php

namespace Podlove\Chapters\Parser;

use Podlove\Chapters\Chapter;
use Podlove\Chapters\Chapters;
use Podlove\NormalPlayTime;

class PodcastIndexJSON
{
    public static function parse(string $chapters_string)
    {
        // remove UTF8 BOM if it exists
        $chapters_string = str_replace("\xef\xbb\xbf", "", $chapters_string);

        $chapters = new Chapters();

        $json = json_decode(trim($chapters_string));

        if (!$json || !$json->chapters) {
            return $chapters;
        }

        foreach ($json->chapters as $chapter) {
            $chapters->addChapter(
                new Chapter(
                    NormalPlayTime\Parser::parse($chapter->startTime),
                    $chapter->title,
                    $chapter->url ?? "",
                    $chapter->img ?? "",
                ),
            );
        }

        return $chapters;
    }
}
