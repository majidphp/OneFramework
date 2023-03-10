<?php
/** Crons list */
$crons = [
    ['Title'=> 'Test', 'File'=> 'Test', 'Time'=> '5', 'NextRun'=> null],
];
include_once 'MainCron.php';
while (true) {
    $i = 0;
    foreach ($crons as $cron) {
        if ($cron['NextRun'] > time() || $cron['NextRun'] == null || ($cron['NextRun'] + $cron['Time']) < time()) {
            include $cron['File'].'.php';
            $crons[$i]['NextRun'] = time();
        }
        $i++;
    }
    sleep(1);
}
