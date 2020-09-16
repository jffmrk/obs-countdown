<?php

    // Find your timezone --> https://www.php.net/manual/en/timezones.php
    date_default_timezone_set('America/Los_Angeles');

    function output($min, $sec) {
        $str = "";
        if ($min >= 0 || $sec >= 0) {
            if ($min > 99) {
                $hour = intval( $min / 60 );
                $str = $hour . ":";
                $min = $min % 60;
            }
            $min = str_pad($min, 2, "0", STR_PAD_LEFT);
            $sec = str_pad($sec, 2, "0", STR_PAD_LEFT);
            $str .= $min . ":" . $sec;
        } else {
            $str = "SOON!";
        }
        print $str . "\n";
        file_put_contents("counter.txt", $str);
    }

    function usage() {
        global $argv;

        $now = new DateTime();
        $formatted = $now->format('Y-m-d\TH:i:sO');
        echo "\n";
        echo "USAGE: php " . $argv[0] . " " . $formatted;
        echo "\n\n";
    }

    if ($argc <= 1) {
        usage();
        exit;
    }

    $jsDeadline = $argv[1];
    if (!isset($jsDeadline)) {
        usage();
        exit;
    }

    $startTime = new DateTime($jsDeadline);

    $MUSIC_INDEX_FILES = 8;

    echo "\n\n";
    echo "Current Index:\n";
    $dayOfYear = $startTime->format('z');
    $musicIndex = ($dayOfYear % $MUSIC_INDEX_FILES) + 1;
    echo $musicIndex;
    echo "\n\n";

    $liveWorshipDate = $startTime->format('D M j @ g:ia');
    echo $liveWorshipDate;
    echo "\n\n";

    $deadlineRealTS = $startTime->getTimestamp();

    $diffReal = $deadlineRealTS - time();
    while ($diffReal > 0) {
        $min = intval( $diffReal / 60 );
        $sec = $diffReal % 60;
        output($min, $sec);
        sleep(1);
        $diffReal = $deadlineRealTS - time();
    }

    output(0, 0);
    sleep(5);
    output(-1, -1);
?>
