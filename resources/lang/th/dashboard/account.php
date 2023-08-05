<?php

return [
    'email' => [
        'title' => 'เปลี่ยนอีเมล',
        'updated' => 'อีเมลของคุณได้ถูกเปลี่ยนแล้ว',
    ],
    'password' => [
        'title' => 'เปลี่ยนรหัสผ่าน',
        'requirements' => 'รหัสผ่านใหม่ของคุณควรมีความยาวอย่างน้อย 8 ตัวอักษร',
        'updated' => 'รหัสผ่านของคุณได้รับการอัปเดตแล้ว',
    ],
    'two_factor' => [
        'button' => 'กำหนดค่าการยืนยันตัวตนแบบสองขั้นตอน',
        'disabled' => 'การยืนยันตัวตนแบบสองขั้นตอนได้ถูกปิดใช้งานบนบัญชีของคุณแล้ว คุณจะไม่ได้รับการแจ้งให้กรอกรหัสที่เมื่อเข้าสู่ระบบ',
        'enabled' => 'การยืนยันตัวตนแบบสองขั้นตอนได้เปิดใช้งานบนบัญชีของคุณแล้ว! ตั้งแต่นี้เป็นต้นไป เมื่อเข้าสู่ระบบคุณจะต้องกรอกรหัสที่สร้างขึ้นโดยอุปกรณ์ของคุณ',
        'invalid' => 'รหัสที่คุณให้มันผิดนะ ดูดีๆ',
        'setup' => [
            'title' => 'ตั้งค่าการยืนยันตัวตนแบบสองขั้นตอน',
            'help' => 'ไม่สามารถสแกนรหัส QR ได้ใช่ไหม กรุณาป้อนรหัสด้านล่างลงในแอปพลิเคชันของคุณ:',
            'field' => 'ใส่รหัส 6 หลัก',
        ],
        'disable' => [
            'title' => 'ปิดใช้งานการยืนยันตัวตนแบบสองขั้นตอน',
            'field' => 'ใส่รหัส',
        ],
    ],
];