<?php

namespace Pterodactyl\Exceptions\Service\Database;

use Pterodactyl\Exceptions\DisplayException;

class NoSuitableDatabaseHostException extends DisplayException
{
    /**
     * NoSuitableDatabaseHostException constructor.
     */
    public function __construct()
    {
        parent::__construct('ไม่พบโฮสต์ฐานข้อมูลที่ตรงตามเงื่อนไขสำหรับเซิร์ฟเวอร์นี้');
    }
}
