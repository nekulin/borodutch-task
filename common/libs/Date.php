<?php
namespace common\libs;


use DateTime;
use DateTimeZone;

class Date {

    /**
     * @var DateTime
     */
    private $objDate;

    public function __construct()
    {
        $this->objDate = new DateTime("now");
        if ($this->getTimeZoneClinet()) {
            $timezoneName = timezone_name_from_abbr("", $this->getTimeZoneClinet()*3600, false);
            if ($timezoneName) {
                $this->objDate = $this->objDate->setTimezone(new DateTimezone($timezoneName));
            }
        }
    }

    public function format($intTimestamp, $strFormat)
    {
        $this->objDate->setTimestamp($intTimestamp);
        return $this->objDate->format($strFormat);
    }

    public function getTimeZoneClinet()
    {
        if (isset($_COOKIE['time_zone'])) {
            return (int)$_COOKIE['time_zone'];
        }
        return false;
    }
} 