<?php

namespace Pterodactyl\Models;

use Illuminate\Support\Collection;

class Permission extends Model
{
    /**
     * The resource name for this model when it is transformed into an
     * API representation using fractal.
     */
    public const RESOURCE_NAME = 'subuser_permission';

    /**
     * Constants defining different permissions available.
     */
    public const ACTION_WEBSOCKET_CONNECT = 'websocket.connect';
    public const ACTION_CONTROL_CONSOLE = 'control.console';
    public const ACTION_CONTROL_START = 'control.start';
    public const ACTION_CONTROL_STOP = 'control.stop';
    public const ACTION_CONTROL_RESTART = 'control.restart';

    public const ACTION_DATABASE_READ = 'database.read';
    public const ACTION_DATABASE_CREATE = 'database.create';
    public const ACTION_DATABASE_UPDATE = 'database.update';
    public const ACTION_DATABASE_DELETE = 'database.delete';
    public const ACTION_DATABASE_VIEW_PASSWORD = 'database.view_password';

    public const ACTION_SCHEDULE_READ = 'schedule.read';
    public const ACTION_SCHEDULE_CREATE = 'schedule.create';
    public const ACTION_SCHEDULE_UPDATE = 'schedule.update';
    public const ACTION_SCHEDULE_DELETE = 'schedule.delete';

    public const ACTION_USER_READ = 'user.read';
    public const ACTION_USER_CREATE = 'user.create';
    public const ACTION_USER_UPDATE = 'user.update';
    public const ACTION_USER_DELETE = 'user.delete';

    public const ACTION_BACKUP_READ = 'backup.read';
    public const ACTION_BACKUP_CREATE = 'backup.create';
    public const ACTION_BACKUP_DELETE = 'backup.delete';
    public const ACTION_BACKUP_DOWNLOAD = 'backup.download';
    public const ACTION_BACKUP_RESTORE = 'backup.restore';

    public const ACTION_ALLOCATION_READ = 'allocation.read';
    public const ACTION_ALLOCATION_CREATE = 'allocation.create';
    public const ACTION_ALLOCATION_UPDATE = 'allocation.update';
    public const ACTION_ALLOCATION_DELETE = 'allocation.delete';

    public const ACTION_FILE_READ = 'file.read';
    public const ACTION_FILE_READ_CONTENT = 'file.read-content';
    public const ACTION_FILE_CREATE = 'file.create';
    public const ACTION_FILE_UPDATE = 'file.update';
    public const ACTION_FILE_DELETE = 'file.delete';
    public const ACTION_FILE_ARCHIVE = 'file.archive';
    public const ACTION_FILE_SFTP = 'file.sftp';

    public const ACTION_STARTUP_READ = 'startup.read';
    public const ACTION_STARTUP_UPDATE = 'startup.update';
    public const ACTION_STARTUP_DOCKER_IMAGE = 'startup.docker-image';

    public const ACTION_SETTINGS_RENAME = 'settings.rename';
    public const ACTION_SETTINGS_REINSTALL = 'settings.reinstall';

    public const ACTION_ACTIVITY_READ = 'activity.read';

    /**
     * Should timestamps be used on this model.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'permissions';

    /**
     * Fields that are not mass assignable.
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Cast values to correct type.
     */
    protected $casts = [
        'subuser_id' => 'integer',
    ];

    public static array $validationRules = [
        'subuser_id' => 'required|numeric|min:1',
        'permission' => 'required|string',
    ];

    /**
     * All the permissions available on the system. You should use self::permissions()
     * to retrieve them, and not directly access this array as it is subject to change.
     *
     * @see \Pterodactyl\Models\Permission::permissions()
     */
    protected static array $permissions = [
        'websocket' => [
            'description' => 'ให้ผู้ใช้เชื่อมต่อกับ websocket ของเซิร์ฟเวอร์ ทำให้พวกเขาสามารถดูผลลัพธ์ในคอนโซลและสถิติของเซิร์ฟเวอร์ในเวลาจริงได้',
            'keys' => [
                'connect' => 'ให้ผู้ใช้เชื่อมต่อกับตัวอย่าง websocket ของเซิร์ฟเวอร์เพื่อรับสตรีมคอนโซล',
            ],
        ],

        'ควบคุม' => [
            'description' => 'สิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการควบคุมสถานะเครื่องและส่งคำสั่งของเซิร์ฟเวอร์',
            'keys' => [
                'คอนโซล' => 'การให้ผู้ใช้สามารถส่งคำสั่งไปยังเซิร์ฟเวอร์ผ่านคอนโซล.',
                'เริ่ม' => 'การให้ผู้ใช้สามารถเริ่มเซิร์ฟเวอร์หากมีการหยุดทำงาน',
                'ปิด' => 'การให้ผู้ใช้สามารถหยุดทำงานเซิร์ฟเวอร์หากมันกำลังทำงานอยู่',
                'รีสตาร์ท' => 'การให้ผู้ใช้ทำการรีสตาร์ทเซิร์ฟเวอร์คือการให้สิทธิ์ในการทำการรีสตาร์ทเซิร์ฟเวอร์โดยไม่ให้เซิร์ฟเวอร์หยุดทำงานอย่างสมบูรณ์ ผู้ใช้สามารถใช้คำสั่งหรือเครื่องมือที่ให้บริการในการรีสตาร์ทเซิร์ฟเวอร์เพื่อเริ่มเซิร์ฟเวอร์ใหม่หากเซิร์ฟเวอร์อยู่ในสถานะออฟไลน์',
            ],
        ],

        'ผู้ใช้' => [
            'description' => 'สิทธิ์ที่อนุญาตให้ผู้ใช้จัดการผู้ใช้ย่อยอื่นบนเซิร์ฟเวอร์คือ 1.จัดการผู้ใช้ย่อย 2.ดูข้อมูลผู้ใช้ย่อย 3.แก้ไขผู้ใช้ย่อย (ยกเว้นตนเอง) 4.การกำหนดสิทธิ์เฉพาะตนเอง',
            'keys' => [
                'สร้าง' => 'สิทธิ์นี้อนุญาตให้ผู้ใช้สามารถสร้างผู้ใช้ย่อยใหม่สำหรับเซิร์ฟเวอร์',
                'อ่าน' => 'สิทธิ์นี้อนุญาตให้ผู้ใช้ดูรายการผู้ใช้ย่อยและสิทธิ์ของพวกเขาสำหรับเซิร์ฟเวอร์',
                'ปรับเปลี่ยน' => 'สิทธิ์นี้อนุญาตให้ผู้ใช้แก้ไขและปรับปรุงข้อมูลของผู้ใช้ย่อยอื่นบนเซิร์ฟเวอร์',
                'ลบ' => 'สิทธิ์นี้อนุญาตให้ผู้ใช้ลบผู้ใช้ย่อยออกจากเซิร์ฟเวอร์',
            ],
        ],

        'ไฟล์' => [
            'description' => 'สิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการปรับเปลี่ยนระบบไฟล์สำหรับเซิร์ฟเวอร์นี้',
            'keys' => [
                'สร้าง' => 'อนุญาตให้ผู้ใช้สร้างไฟล์และโฟลเดอร์เพิ่มเติมผ่านแผงควบคุมหรืออัปโหลดโดยตรง',
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูเนื้อหาของไดเร็กทอรี แต่ไม่สามารถดูเนื้อหาหรือดาวน์โหลดไฟล์ได้',
                'อ่านเนื้อหา' => 'อนุญาตให้ผู้ใช้ดูเนื้อหาของไฟล์ที่กำหนด สิ่งนี้จะช่วยให้ผู้ใช้สามารถดาวน์โหลดไฟล์ได้',
                'อัพเดท' => 'อนุญาตให้ผู้ใช้อัปเดตเนื้อหาของไฟล์หรือไดเร็กทอรีที่มีอยู่',
                'ลบ' => 'อนุญาตให้ผู้ใช้ลบไฟล์หรือแฟ้มจัดเก็บไฟล์',
                'อัดไฟล์' => 'อนุญาตให้ผู้ใช้เก็บถาวรเนื้อหาของแฟ้มจัดเก็บไฟล์ รวมทั้งขยายขนาดไฟล์เก็บถาวรที่มีอยู่ในระบบ',
                'sftp' => 'อนุญาตให้ผู้ใช้เชื่อมต่อกับ SFTP และจัดการไฟล์เซิร์ฟเวอร์โดยใช้สิทธิ์ไฟล์อื่น ๆ ที่กำหนด',
            ],
        ],

        'สำรองข้อมูล' => [
            'description' => 'สิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการสร้างและจัดการเซิร์ฟเวอร์สำรอง สร้างสิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการสร้างและจัดการเซิร์ฟเวอร์สำรอง',
            'keys' => [
                'สร้าง' => 'อนุญาตให้ผู้ใช้สร้างข้อมูลสำรองใหม่สำหรับบริการนี้',
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูข้อมูลสำรองทั้งหมดที่มีอยู่สำหรับเซิร์ฟเวอร์นี้',
                'ลบ' => 'อนุญาตให้ผู้ใช้ลบข้อมูลสำรองออกจากระบบ',
                'ดาวน์โหลด' => 'อนุญาตให้ผู้ใช้ดาวน์โหลดข้อมูลสำรองสำหรับเซิร์ฟเวอร์ อันตราย: สิ่งนี้ทำให้ผู้ใช้สามารถเข้าถึงไฟล์ทั้งหมดสำหรับเซิร์ฟเวอร์ในการสำรองข้อมูล',
                'กู้คืน' => 'อนุญาตให้ผู้ใช้กู้คืนข้อมูลสำรองสำหรับเซิร์ฟเวอร์ อันตราย: สิ่งนี้ทำให้ผู้ใช้สามารถลบไฟล์เซิร์ฟเวอร์ทั้งหมดในกระบวนการ',
            ],
        ],

        // Controls permissions for editing or viewing a server's allocations.
        'จัดการพอร์ต' => [
            'description' => 'สิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการแก้ไขการจัดการพอร์ตสำหรับเซิร์ฟเวอร์นี้',
            'keys' => [
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูการจัดการพอร์ตทั้งหมดที่กำหนดให้กับเซิร์ฟเวอร์นี้ในปัจจุบัน ผู้ใช้ที่มีสิทธิ์เข้าถึงเซิร์ฟเวอร์นี้ในระดับใดก็ได้สามารถดูการจัดการพอร์ตหลักได้ตลอดเวลา',
                'สร้าง' => 'อนุญาตให้ผู้ใช้กำหนดการจัดการพอร์ตเพิ่มเติมให้กับเซิร์ฟเวอร์',
                'อัพเดท' => 'อนุญาตให้ผู้ใช้เปลี่ยนการจัดการพอร์ตเซิร์ฟเวอร์หลักและแนบหมายเหตุกับการจัดการพอร์ตแต่ละครั้ง',
                'ลบ' => 'อนุญาตให้ผู้ใช้ลบการจัดการพอร์ตออกจากเซิร์ฟเวอร์',
            ],
        ],

        // Controls permissions for editing or viewing a server's startup parameters.
        'คำสั่งเริ่ม' => [
            'description' => 'สิทธิ์ที่ควบคุมความสามารถของผู้ใช้ในการดูพารามิเตอร์เริ่มต้นของเซิร์ฟเวอร์นี้',
            'keys' => [
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูคำสั่งเริ่มต้นสำหรับเซิร์ฟเวอร์',
                'อัพเดท' => 'อนุญาตให้ผู้ใช้แก้ไขคำสั่งเริ่มต้นสำหรับเซิร์ฟเวอร์',
                'docker-image' => 'อนุญาตให้ผู้ใช้แก้ไข Image Docker ที่ใช้เมื่อเรียกใช้เซิร์ฟเวอร์',
            ],
        ],

        'ฐานข้อมูล' => [
            'description' => 'สิทธ์ที่จะควบคุมความสามารถของผู้ใช้ในการจัดการฐานข้อมูลในเซิร์ฟเวอร์นี้',
            'keys' => [
                'สร้าง' => 'อนุญาตให้ผู้ใช้สร้างฐานข้อมูลอันใหม่ในเซิร์ฟเวอร์นี้',
                'อ่าน' => 'อนุญาตให้ผู้ใช้อ่านฐานข้อมูลที่อยู่ในเซิร์ฟเวอร์นี้',
                'อัพเดท' => 'อนุญาตให้ผู้ใช้เปลี่ยนรหัสผ่านบนเครื่องฐานข้อมูล หากผู้ใช้ไม่มีสิทธิ์ ดูรหัสผ่าน ผู้ใช้จะไม่เห็นรหัสผ่านที่อัปเดต',
                'ลบ' => 'อนุญาตให้ผู้ใช้ลบเครื่องฐานข้อมูลออกจากเซิร์ฟเวอร์นี้',
                'ดูรหัสผ่าน' => 'อนุญาตให้ผู้ใช้ดูรหัสผ่านที่เชื่อมโยงกับเครื่องฐานข้อมูลสำหรับเซิร์ฟเวอร์นี้',
            ],
        ],

        'ตารางเวลา' => [
            'description' => 'สิทธ์ที่จะควบคุมความสามารถของผู้ใช้ในการควบคุมตารางเวลาในเซิร์ฟเวอร์นี้',
            'keys' => [
                'สร้าง' => 'อนุญาตให้ผู้ใช้สร้างกำหนดการใหม่สำหรับเซิร์ฟเวอร์นี้', // task.create-schedule
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูกำหนดการและงานที่เกี่ยวข้องสำหรับเซิร์ฟเวอร์นี้', // task.view-schedule, task.list-schedules
                'อัพเดท' => 'อนุญาตให้ผู้ใช้อัปเดตกำหนดการและกำหนดเวลางานสำหรับเซิร์ฟเวอร์นี้', // task.edit-schedule, task.queue-schedule, task.toggle-schedule
                'ลบ' => 'อนุญาตให้ผู้ใช้ลบกำหนดการสำหรับเซิร์ฟเวอร์นี้', // task.delete-schedule
            ],
        ],

        'ตั้งค่า' => [
            'description' => 'สิทธ์ที่จะควบคุมความสามารถของผู้ใช้ในการจัดการการตั้งค่าในเซิร์ฟเวอร์นี้',
            'keys' => [
                'เปลี่ยนชื่อ' => 'อนุญาตให้ผู้ใช้เปลี่ยนชื่อเซิร์ฟเวอร์นี้และเปลี่ยนคำอธิบายของเซิร์ฟเวอร์',
                'ติดตั้งใหม่' => 'อนุญาตให้ผู้ใช้ทริกเกอร์การติดตั้งเซิร์ฟเวอร์นี้ใหม่',
            ],
        ],

        'บันทึกกิจกรรม' => [
            'description' => 'สิทธ์ที่จะควบคุมความสามารถของผู้ใช้ในการชมการเคลื่อนไหวในเซิร์ฟเวอร์นี้',
            'keys' => [
                'อ่าน' => 'อนุญาตให้ผู้ใช้ดูบันทึกกิจกรรมสำหรับเซิร์ฟเวอร์',
            ],
        ],
    ];

    /**
     * Returns all the permissions available on the system for a user to
     * have when controlling a server.
     */
    public static function permissions(): Collection
    {
        return Collection::make(self::$permissions);
    }
}
