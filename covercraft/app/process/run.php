<?php

include_once('Cron_manager.php');

$crontab = new Ssh2_crontab_manager('local', '80', 'root', '');

$crontab->append_cronjob('2 * * * 1-5 C:\cron/command/the_command.sh >> c:cron/cron_job.txt 2>&1');