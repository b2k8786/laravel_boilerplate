<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Stream extends BaseController
{

    public function sse()
    {
        session_write_close();

        header("Content-Type: text/event-stream");
        header("Cache-Control: no-store");
        header("Access-Control-Allow-Origin: *");

        $eventId = isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? $_SERVER["HTTP_LAST_EVENT_ID"] : 0;

        start:
        $users = \App\Models\Users::whereRaw("updated_at >= '" . date('Y-m-d') . "'")
            ->orderBy('updated_at', 'ASC')
            ->get();

        while (true) {
            if (empty($eventId) && !$users->count())
                goto start;

            if ($users->count()) {
                $eventId = $users[$users->count()-1]->id;
                echo "id: " . $eventId . "\n";
                echo "data: " . $users . "\n\n";
            } else {
                echo ": heartbeat\n\n";
            }

            ob_flush();
            flush();
            ob_clean();
            sleep(1);

            $users = \App\Models\Users::whereRaw("id > '$eventId'")
                ->orderBy('updated_at', 'DESC')
                ->get();
            if ($users->count())
                $lastUpdatedAt = $users[0]->updated_at;

            if (connection_aborted())
                exit();
        }
    }

    public function main()
    {
        return view('main');
    }
}
