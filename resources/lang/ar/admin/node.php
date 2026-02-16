<?php

return [
    'label' => 'العقد',
    'plural-label' => 'العقود',

    'sections' => [
        'identity' => [
            'title' => 'الهوية',
            'description' => 'معلومات العقدة الأساسية تفاصيل الاتصال.',
        ],
        'connection' => [
            'title' => 'تفاصيل الاتصال',
            'description' => 'إعداد طريقة الاتصال بهذه العقدة.',
        ],
        'resources' => [
            'title' => 'تخصيص الموارد',
            'description' => 'تحديد حدود الذاكرة ومساحة التخزين لهذه العقدة.',
        ],
        'daemon' => [
            'title' => 'إعدادات الخدمة Daemon',
            'description' => 'ضبط الإعدادات الخاصة بالخدمة (daemon-specific).',
        ],
    ],

    'fields' => [
        'uuid' => [
            'label' => 'UUID',
        ],
        'public' => [
            'label' => 'عام',
            'helper' => 'عند تعيين العقدة كخاصة، سيتم منع النشر التلقائي عليها ',
        ],
        'name' => [
            'label' => 'الاسم',
            'placeholder' => 'اسم العقدة',
            'helper' => 'اسم وصفي لهذه العقدة.',
        ],
        'description' => [
            'label' => 'وصف',
            'placeholder' => 'وصف العقدة',
            'helper' => 'وصف اختياري لهذه العقدة.',
        ],
        'location' => [
            'label' => 'الموقع',
            'helper' => 'الموقع الذي تم تعيين هذه العقدة إليه.',
        ],
        'fqdn' => [
            'label' => 'FQDN',
            'placeholder' => 'node.example.com',
            'helper' => 'اسم نطاق كامل أو عنوان IP.',
        ],
        'ssl' => [
            'label' => 'يستخدم SSL',
            'helper' => 'ما إذا كانت الخدمة على هذه العقدة مهيأة لاستخدام SSL للاتصال الآمن.',
            'helper_forced' => 'هذه اللوحة تعمل عبر HTTPS لذلك يتم فرض SSL على هذه العقدة.',
        ],
        'behind_proxy' => [
            'label' => 'خلف وكيل بروكسي',
            'helper' => 'قم بالتفعيل إذا كانت هذه العقدة خلف وكيل مثل كلاودفلير.',
        ],
        'maintenance_mode' => [
            'label' => 'وضع الصيانة',
            'helper' => 'منع إنشاء خوادم جديدة على هذه العقدة.',
        ],
        'memory' => [
            'label' => 'إجمالي الذاكرة',
            'helper' => 'إجمالي الذاكرة المتاحة على هذه العقدة بوحدة MiB.',
        ],
        'memory_overallocate' => [
            'label' => 'تجاوز تخصيص الذاكرة',
            'helper' => 'نسبة السماح بتجاوز تخصيص الذاكرة. استخدم -1 لتعطيل التحقق.',
        ],
        'disk' => [
            'label' => 'إجمالي مساحة التخزين',
            'helper' => 'إجمالي مساحة التخزين المتاحة على هذه العقدة بوحدة MiB.',
        ],
        'disk_overallocate' => [
            'label' => 'تجاوز تخصيص القرص',
            'helper' => 'نسبة السماح بتجاوز تخصيص القرص. استخدم -1 لتعطيل التحقق.',
        ],
        'upload_size' => [
            'label' => 'الحد الأقصى لحجم الرفع',
            'helper' => 'أقصى حجم مسموح لرفع الملفات عبر لوحة الويب.',
        ],
        'daemon_base' => [
            'label' => 'المجلد الأساسي',
            'placeholder' => '/home/daemon-files',
            'helper' => 'المجلد الذي يتم فيه تخزين ملفات الخوادم.',
        ],
        'daemon_listen' => [
            'label' => 'منفذ الخدمة Daemon',
            'helper' => 'المنفذ الذي تستمع عليه الخدمة لاتصالات HTTP.',
        ],
        'daemon_sftp' => [
            'label' => 'منفذ SFTP',
            'helper' => 'المنفذ المستخدم لاتصالات SFTP.',
        ],
        'daemon_token_id' => [
            'label' => 'معرف التوكن',
        ],
        'container_text' => [
            'label' => 'برفكس الحاوية',
            'helper' => 'Text prefix displayed in container names.',
        ],
        'daemon_text' => [
            'label' => 'Daemon Prefix',
            'helper' => 'Text prefix displayed in daemon logs.',
        ],
    ],

    'table' => [
        'id' => 'ID',
        'uuid' => 'UUID',
        'name' => 'Name',
        'location' => 'Location',
        'fqdn' => 'FQDN',
        'scheme' => 'Protocol',
        'public' => 'Public',
        'behind_proxy' => 'Behind Proxy',
        'maintenance_mode' => 'Maintenance',
        'memory' => 'Memory',
        'memory_overallocate' => 'Memory Over',
        'disk' => 'Disk',
        'disk_overallocate' => 'Disk Over',
        'upload_size' => 'Upload Size',
        'daemon_listen' => 'Daemon Port',
        'daemon_sftp' => 'SFTP Port',
        'daemon_base' => 'Base Directory',
        'servers' => 'Servers',
        'created' => 'Created',
        'updated' => 'Updated',
    ],

    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'view' => 'View',
    ],

    'messages' => [
        'created' => 'Node has been successfully created.',
        'updated' => 'Node has been successfully updated.',
        'deleted' => 'Node has been successfully deleted.',
        'cannot_delete_with_servers' => 'Cannot delete a node with active servers.',
    ],

    'allocations' => [
        'label' => 'Allocations',
        'table' => [
            'ip' => 'IP',
            'port' => 'Port',
            'alias' => 'Alias',
            'server' => 'Server',
            'notes' => 'Notes',
            'created' => 'Created',
            'unassigned' => 'Unassigned',
        ],
        'fields' => [
            'allocation_ip' => [
                'label' => 'IP Address',
                'helper' => 'Supports single IP or CIDR (e.g. 192.0.2.1 or 192.0.2.0/24).',
            ],
            'allocation_ports' => [
                'label' => 'Ports',
                'helper' => 'Enter ports or ranges (e.g. 25565, 25566, 25570-25580).',
            ],
            'allocation_alias' => [
                'label' => 'IP Alias',
                'helper' => 'Optional alias to display instead of the IP.',
            ],
        ],
        'actions' => [
            'add' => 'Add Allocation',
            'delete' => 'Delete',
        ],
        'messages' => [
            'created' => 'Allocations added.',
            'deleted' => 'Allocation deleted.',
            'failed' => 'Allocation action failed.',
        ],
    ],
    
    'validation' => [
        'fqdn_not_resolvable' => 'The FQDN or IP address provided does not resolve to a valid IP address.',
        'fqdn_required_for_ssl' => 'A fully qualified domain name that resolves to a public IP address is required in order to use SSL for this node.',
    ],
    'notices' => [
        'allocations_added' => 'Allocations have successfully been added to this node.',
        'node_deleted' => 'Node has been successfully removed from the panel.',
        'location_required' => 'You must have at least one location configured before you can add a node to this panel.',
        'node_created' => 'Successfully created new node. You can automatically configure the daemon on this machine by visiting the \'Configuration\' tab. Before you can add any servers you must first allocate at least one IP address and port.',
        'node_updated' => 'Node information has been updated. If any daemon settings were changed you will need to reboot it for those changes to take effect.',
        'unallocated_deleted' => 'Deleted all un-allocated ports for <code>:ip</code>.',
    ],
];
