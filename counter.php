<?php

    // Find your timezone --> https://www.php.net/manual/en/timezones.php
    date_default_timezone_set('America/Los_Angeles');

    function output($min, $sec) {
        $str = "";
        if ($min > 99) {
            $hour = intval( $min / 60 );
            $str = $hour . ":";
            $min = $min % 60;
        }
        $min = str_pad($min, 2, "0", STR_PAD_LEFT);
        $sec = str_pad($sec, 2, "0", STR_PAD_LEFT);
        $str .= $min . ":" . $sec;
        print $str . "\n";
        file_put_contents("counter.txt", $str);
    }

    if ($argc <= 1) {
        $now = new DateTime();
        $formatted = $now->format('Y-m-d\TH:i:sO');
        echo "\n\n";
        echo "USAGE: php " . $argv[0] . " " . $formatted;
        echo "\n\n";
        exit;
    }

    $jsDeadline = $argv[1];
    if (isset($jsDeadline)) {
        $startTime = new DateTime($jsDeadline);
        $liveWorshipDate = $startTime->format('D M j @ g:ia');

        $deadline = new DateTime($jsDeadline);
        $deadlineRealTS = $deadline->getTimestamp();

        $diffReal = $deadlineRealTS - time();
        while ($diffReal > 0) {
            $min = intval( $diffReal / 60 );
            $sec = $diffReal % 60;
            output($min, $sec);
            sleep(1);
            $diffReal = $deadlineRealTS - time();
        }

        output(0, 0);
    }
?>
