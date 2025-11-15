<?php
namespace Podlove\Chapters\Printer;

class PodcastIndexJSON implements Printer
{
    public function do_print(\Podlove\Chapters\Chapters $chapters): string
    {
        $chapters = array_map(function ($chapter) {
            $entry = [
                "startTime" => $chapter->get_start_time_seconds_with_ms(),
            ];

            if ($value = $chapter->get_title()) {
                $entry["title"] = $value;
            }

            if ($value = $chapter->get_link()) {
                $entry["url"] = $value;
            }

            if ($value = $chapter->get_image()) {
                $entry["img"] = $value;
            }

            return (object) $entry;
        }, $chapters->toArray());

        $data = [
            "version" => "1.2.0",
            "chapters" => $chapters,
        ];

        return json_encode($data);
    }
}
