<?php

namespace Pterodactyl\Exceptions\Service\Allocation;

use Pterodactyl\Exceptions\DisplayException;

class AutoAllocationNotEnabledException extends DisplayException
{
    /**
     * AutoAllocationNotEnabledException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'การจัดการพอร์ตทรัพยากรอัตโนมัติของเซิร์ฟเวอร์ไม่ได้เปิดใช้งานสำหรับตัวอย่างนี้'
        );
    }
}
