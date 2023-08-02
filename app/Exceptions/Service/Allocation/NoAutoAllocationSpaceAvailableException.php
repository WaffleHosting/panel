<?php

namespace Pterodactyl\Exceptions\Service\Allocation;

use Pterodactyl\Exceptions\DisplayException;

class NoAutoAllocationSpaceAvailableException extends DisplayException
{
    /**
     * NoAutoAllocationSpaceAvailableException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'ไม่สามารถกำหนดการจัดการพอร์ตเครือข่ายเติมได้: ไม่มีพื้นที่ว่างในโหนด (node) อีกต่อไป'
        );
    }
}
