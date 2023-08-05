<?php

/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */
return [
    'auth' => [
        'fail' => 'เข้าสู่ระบบล้มเหลว',
        'success' => 'เข้าสู่ระบบแล้ว',
        'password-reset' => 'รีเซ็ตรหัสผ่าน',
        'reset-password' => 'ขอรีเซ็ตรหัสผ่าน',
        'checkpoint' => 'การรับรองความปลอดภัย 2 ขั้นตอน',
        'recovery-token' => 'ใช้โทเค็นการกู้คืนแบบ 2 ขั้นตอน',
        'token' => 'ยืนยันแบบความปลอดภัย 2 ขั้นตอนเรียบร้อยแล้ว',
        'ip-blocked' => 'บล็อคคำขอถอนการติดตั้งของ IP นี้ :identifier',
        'sftp' => [
            'fail' => 'การล็อคอิน SFTP ผิดพลาด',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => 'เปลี่ยนอีเมลจาก :old ไป :new',
            'password-changed' => 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว',
        ],
        'api-key' => [
            'create' => 'สร้าง API key เรียบร้อยแล้ว :identifier',
            'delete' => 'ลบ API key เรียบร้อยแล้ว :identifier',
        ],
        'ssh-key' => [
            'create' => 'เพิ่ม SSH key เรียบร้อยแล้ว :fingerprint to account',
            'delete' => 'ลบ SSH key เรียบร้อยแล้ว :fingerprint from account',
        ],
        'two-factor' => [
            'create' => 'เปิดการยืนยันแบบ 2 ขั้นตอนเรียบร้อยแล้ว',
            'delete' => 'ปิดการยืนยันแบบ 2 ขั้นตอนเรียบร้อยแล้ว',
        ],
    ],
    'server' => [
        'reinstall' => 'ติดตั้งเซิร์ฟเวอร์ใหม่เรียบร้อยแล้ว',
        'console' => [
            'command' => 'ดำเนินการ ":command" บนเซิร์ฟเวอร์',
        ],
        'power' => [
            'start' => 'เปิดเซิร์ฟเวอร์แล้ว',
            'stop' => 'ปิดเซิร์ฟเวอร์แล้ว',
            'restart' => 'รีสตาร์ทเซิร์ฟเวอร์แล้ว',
            'kill' => 'บังคับปิดเซิร์ฟเวอร์แล้ว',
        ],
        'backup' => [
            'download' => 'ดาวน์โหลดข้อมูลสำรอง :name เรียบร้อยแล้ว',
            'delete' => 'ลบข้อมูลสำรอง :name เรียบร้อยแล้ว',
            'restore' => 'นำกลับข้อมูลสำรอง :name เรียบร้อยแล้ว (deleted files: :truncate)',
            'restore-complete' => 'เสร็จสิ้นการนำกลับของข้อมูลสำรอง :name',
            'restore-failed' => 'เกิดข้อผิดพลาดระหว่างการนำกลับของข้อมูลสำรอง :name',
            'start' => 'เริ่มการสำรองข้อมูลใหม่ :name',
            'complete' => 'สร้างข้อมูลสำรอง :name สำเร็จแล้ว',
            'fail' => 'สร้างข้อมูลสำรอง :name ไม่สำเร็จ',
            'lock' => 'ล็อคข้อมูลสำรอง :name เรียบร้อยแล้ว',
            'unlock' => 'ปลดล็อคข้อมูลสำรอง :name เรียบร้อยแล้ว',
        ],
        'database' => [
            'create' => 'สร้างฐานข้อมูลใหม่ :name เรียบร้อยแล้ว',
            'rotate-password' => 'รหัสผ่านเปลี่ยนสำหรับฐานข้อมูล :name',
            'delete' => 'ลบฐานข้อมูล :name เรียบร้อยแล้ว',
        ],
        'file' => [
            'compress_one' => 'บีบอัด :directory:file เรียบร้อยแล้ว',
            'compress_other' => 'บีบอัด :count ไฟล์ใน :directory เรียบร้อยแล้ว',
            'read' => 'ดูเนื้อหาของ :file',
            'copy' => 'คัดลอก :file',
            'create-directory' => 'สร้างโฟลเดอร์ :directory:name',
            'decompress' => 'แตกไฟล์ :files ใน :directory',
            'delete_one' => 'ลบ :directory:files.0',
            'delete_other' => 'ลบ :count ไฟล์ใน :directory',
            'download' => 'ดาวน์โหลด :file',
            'pull' => 'ดาวน์โหลดไฟล์ระยะไกลจาก :url ไปยัง :directory',
            'rename_one' => 'เปลี่ยนชื่อ :directory:files.0.from เป็น :directory:files.0.to',
            'rename_other' => 'เปลี่ยนชื่อ :count ไฟล์ใน :directory',
            'write' => 'เขียนเนื้อหาใหม่ใน :file',
            'upload' => 'เริ่มอัปโหลดไฟล์',
            'uploaded' => 'อัปโหลด :directory:file',
        ],
        'sftp' => [
            'denied' => 'บล็อกการเข้าถึง SFTP เนื่องจากสิทธิ์',
            'create_one' => 'สร้าง :files.0',
            'create_other' => 'สร้างไฟล์ใหม่ :count ไฟล์',
            'write_one' => 'แก้ไขเนื้อหาของ :files.0',
            'write_other' => 'แก้ไขเนื้อหาของ :count ไฟล์',
            'delete_one' => 'ลบ :files.0',
            'delete_other' => 'ลบ :count ไฟล์',
            'create-directory_one' => 'สร้างไดเรกทอรี :files.0',
            'create-directory_other' => 'สร้างไดเรกทอรี :count ไดเรกทอรี',
            'rename_one' => 'เปลี่นนชื่อ :files.0.from เป็น :files.0.to',
            'rename_other' => 'เปลี่ยนชื่อหรือย้าย :count ไฟล์',
        ],
        'allocation' => [
            'create' => 'เพิ่ม :allocation เข้าสู่เซิร์ฟเวอร์',
            'notes' => 'อัปเดตบันทึกสำหรับ :allocation จาก ":old" เป็น ":new"',
            'primary' => 'ตั้ง :allocation เป็นการจัดสรรเซิร์ฟเวอร์หลัก',
            'delete' => 'ลบการจัดสรร :allocation',
        ],
        'schedule' => [
            'create' => 'สร้างกำหนดการ :name',
            'update' => 'อัปเดตกำหนดการ :name',
            'execute' => 'ดำเนินการกำหนดการ :name ด้วยมือ',
            'delete' => 'ลบกำหนดการ :name',
        ],
        'task' => [
            'create' => 'สร้างงาน ":action" ใหม่สำหรับกำหนดการ :name',
            'update' => 'อัปเดตงาน ":action" สำหรับกำหนดการ :name',
            'delete' => 'ลบงานสำหรับกำหนดการ :name',
        ],
        'settings' => [
            'rename' => 'เปลี่ยนชื่อเซิร์ฟเวอร์จาก :old เป็น :new',
            'description' => 'เปลี่ยนคำอธิบายของเซิร์ฟเวอร์จาก :old เป็น :new',
        ],
        'startup' => [
            'edit' => 'เปลี่ยนแปลงตัวแปร :variable จาก ":old" เป็น ":new"',
            'image' => 'อัปเดต Docker Image สำหรับเซิร์ฟเวอร์จาก :old เป็น :new',
        ],
        'subuser' => [
            'create' => 'เพิ่ม :email เป็นผู้ใช้ย่อย',
            'update' => 'อัปเดตสิทธิ์ผู้ใช้ย่อยสำหรับ :email',
            'delete' => 'ลบ :email เป็นผู้ใช้ย่อย',
        ],
    ],
];
;
