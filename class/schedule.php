<?php

    
    // Usage:
    //    new Schedule("example", "* * * * *", function($time) {
    //        debug("* * * * * ran at " . date('Y-m-d H:i:s', $time));
    //    });
    //
    //    new Schedule("example-5", "*/5 * * * *", function($time) {
    //        debug("*/5 * * * * ran at " . date('Y-m-d H:i:s', $time));
    //    });
    //
    //    new Schedule("example-15", "*/15 * * * *", function($time) {
    //        debug("*/15 * * * * ran at " . date('Y-m-d H:i:s', $time));
    //    });

    class Schedule {
        protected $name;
        protected $expression;
        protected $callback;
        protected $maxRuns;

        public function __construct($name, $expression, $callback, $maxRuns = 60) {

            global $config;

            if (
                isset($config["cronType"]) && 
                $config["cronType"] === "system" && 
                php_sapi_name() !== 'cli'
            ) {
                return;
            }

            $this->settings = new Settings();
            $this->name = $name;
            $this->expression = $expression;
            $this->callback = $callback;
            $this->maxRuns = $maxRuns;

            $this->run();
        }

        protected function run() {
            $lastRun = $this->getLastRun();
            $now = time();
            $runs = 0;

            while ($lastRun = $this->shouldRun($lastRun, $now)) {
                $this->execute($lastRun);
                $this->setLastRun($lastRun);
                $runs++;
                if ($runs >= $this->maxRuns) {
                    break;
                }
            }
        }

        protected function getLastRun() {
            $result = $this->settings->loadSetting("schedule-" . $this->name, true, time() - (time() % 60));
            return (int)$result;
        }

        protected function setLastRun($time) {
            $this->settings->update("schedule-" . $this->name, strtotime(date('Y-m-d H:i:00', $time)));
        }

        protected function execute($time) {
            try {
                call_user_func($this->callback, $time);
            } catch (\Throwable $e) {
                error_log("Cron {$this->name} failed: " . $e->getMessage());
            }
        }

        protected function shouldRun($lastRun, $now) {
            $start = strtotime(date('Y-m-d H:i:00', $lastRun)) + 60;
            $end   = strtotime(date('Y-m-d H:i:00', $now));


            if ($start > $end) {
                return false;
            }

            for ($time = $start; $time <= $end; $time += 60) {
                if ($this->matches($time)) {
                    return $time;
                }
            }

            return false;
        }

        protected function matches($timestamp) {
            [$min, $hour, $day, $month, $weekday] = explode(' ', $this->expression);

            return $this->matchPart($min, (int)date('i', $timestamp)) &&
                $this->matchPart($hour, (int)date('G', $timestamp)) &&
                $this->matchPart($day, (int)date('j', $timestamp)) &&
                $this->matchPart($month, (int)date('n', $timestamp)) &&
                $this->matchPart($weekday, (int)date('w', $timestamp));
        }

        protected function matchPart($expr, $value) {
            if ($expr === '*') return true;

            // Handle lists: 1,2,3
            if (str_contains($expr, ',')) {
                return in_array($value, array_map('intval', explode(',', $expr)));
            }

            // Handle steps: */5
            if (str_contains($expr, '/')) {
                [$base, $step] = explode('/', $expr);
                if ($base === '*') {
                    return $value % (int)$step === 0;
                }
            }

            // Handle ranges: 1-5
            if (str_contains($expr, '-')) {
                [$start, $end] = explode('-', $expr);
                return $value >= (int)$start && $value <= (int)$end;
            }

            return (int)$expr === $value;
        }
    }