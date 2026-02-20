<?php

/**
 * Contains all of the translation strings for different activity log
 * events. These should be keyed by the value in front of the colon (:)
 * in the event name. If there is no colon present, they should live at
 * the top level.
 */
return [
    'entries' => [
        'system-user' => 'مستخدم النظام',
        'system' => 'النظام',
        'using-api-key' => 'باستخدام مفتاح API',
        'using-sftp' => 'باستخدام SFTP',
    ],
    'auth' => [
        'fail' => 'فشل تسجيل الدخول',
        'success' => 'تم تسجيل الدخول',
        'password-reset' => 'إعادة تعيين كلمة المرور',
        'reset-password' => 'طلب إعادة تعيين كلمة المرور',
        'checkpoint' => 'طلب المصادقة الثنائية',
        'recovery-token' => 'تم استخدام رمز استرداد المصادقة الثنائية',
        'token' => 'تم حل تحدي المصادقة الثنائية',
        'ip-blocked' => 'تم حظر الطلب من عنوان IP غير مدرج لـ :identifier',
        'sftp' => [
            'fail' => 'فشل تسجيل الدخول عبر SFTP',
        ],
    ],
    'user' => [
        'account' => [
            'email-changed' => 'تم تغيير البريد الإلكتروني من :old إلى :new',
            'password-changed' => 'تم تغيير كلمة المرور',
            'language-changed' => 'تم تغيير اللغة من :old إلى :new',
        ],
        'api-key' => [
            'create' => 'تم إنشاء مفتاح API جديد :identifier',
            'delete' => 'تم حذف مفتاح API :identifier',
        ],
        'ssh-key' => [
            'create' => 'تمت إضافة مفتاح SSH :fingerprint إلى الحساب',
            'delete' => 'تمت إزالة مفتاح SSH :fingerprint من الحساب',
        ],
        'two-factor' => [
            'create' => 'تم تفعيل المصادقة الثنائية',
            'delete' => 'تم تعطيل المصادقة الثنائية',
        ],
    ],
    'server' => [
        'reinstall' => 'تمت إعادة تثبيت الخادم',
        'console' => [
            'command' => 'تم تنفيذ ":command" على الخادم',
        ],
        'power' => [
            'start' => 'تم بدء تشغيل الخادم',
            'stop' => 'تم إيقاف تشغيل الخادم',
            'restart' => 'تمت إعادة تشغيل الخادم',
            'kill' => 'تم إنهاء عملية الخادم',
        ],
        'backup' => [
            'download' => 'تم تنزيل النسخة الاحتياطية :name',
            'delete' => 'تم حذف النسخة الاحتياطية :name',
            'restore' => 'تمت استعادة النسخة الاحتياطية :name (تم حذف الملفات: :truncate)',
            'restore-complete' => 'اكتملت استعادة النسخة الاحتياطية :name',
            'restore-failed' => 'فشل إكمال استعادة النسخة الاحتياطية :name',
            'start' => 'بدأت نسخة احتياطية جديدة :name',
            'complete' => 'تم وضع علامة اكتمال على النسخة الاحتياطية :name',
            'fail' => 'تم وضع علامة فشل عملية على النسخة الاحتياطية :name',
            'lock' => 'تم قفل النسخة الاحتياطية :name',
            'unlock' => 'تم فتح قفل النسخة الاحتياطية :name',
        ],
        'database' => [
            'create' => 'تم إنشاء قاعدة بيانات جديدة :name',
            'rotate-password' => 'تم تدوير كلمة المرور لقاعدة البيانات :name',
            'delete' => 'تم حذف قاعدة البيانات :name',
        ],
        'file' => [
            'compress_one' => 'تم ضغط :directory:file',
            'compress_other' => 'تم ضغط :count ملف في :directory',
            'read' => 'تم عرض محتويات :file',
            'copy' => 'تم إنشاء نسخة من :file',
            'create-directory' => 'تم إنشاء مجلد :directory:name',
            'decompress' => 'تم فك ضغط :files في :directory',
            'delete_one' => 'تم حذف :directory:files.0',
            'delete_other' => 'تم حذف :count ملف في :directory',
            'download' => 'تم تنزيل :file',
            'pull' => 'Downloaded a remote file from :url to :directory',
            'rename_one' => 'Renamed :directory:files.0.from to :directory:files.0.to',
            'rename_other' => 'Renamed :count files in :directory',
            'write' => 'Wrote new content to :file',
            'upload' => 'Began a file upload',
            'uploaded' => 'Uploaded :directory:file',
        ],
        'sftp' => [
            'denied' => 'Blocked SFTP access due to permissions',
            'create_one' => 'Created :files.0',
            'create_other' => 'Created :count new files',
            'write_one' => 'Modified the contents of :files.0',
            'write_other' => 'Modified the contents of :count files',
            'delete_one' => 'Deleted :files.0',
            'delete_other' => 'Deleted :count files',
            'create-directory_one' => 'Created the :files.0 directory',
            'create-directory_other' => 'Created :count directories',
            'rename_one' => 'Renamed :files.0.from to :files.0.to',
            'rename_other' => 'Renamed or moved :count files',
        ],
        'allocation' => [
            'create' => 'Added :allocation to the server',
            'notes' => 'Updated the notes for :allocation from ":old" to ":new"',
            'primary' => 'Set :allocation as the primary server allocation',
            'delete' => 'Deleted the :allocation allocation',
        ],
        'schedule' => [
            'create' => 'Created the :name schedule',
            'update' => 'Updated the :name schedule',
            'execute' => 'Manually executed the :name schedule',
            'delete' => 'Deleted the :name schedule',
        ],
        'task' => [
            'create' => 'Created a new ":action" task for the :name schedule',
            'update' => 'Updated the ":action" task for the :name schedule',
            'delete' => 'Deleted a task for the :name schedule',
        ],
        'settings' => [
            'rename' => 'Renamed the server from :old to :new',
            'description' => 'Changed the server description from :old to :new',
        ],
        'startup' => [
            'edit' => 'Changed the :variable variable from ":old" to ":new"',
            'image' => 'Updated the Docker Image for the server from :old to :new',
        ],
        'subuser' => [
            'create' => 'Added :email as a subuser',
            'update' => 'Updated the subuser permissions for :email',
            'delete' => 'Removed :email as a subuser',
        ],
    ],
];
