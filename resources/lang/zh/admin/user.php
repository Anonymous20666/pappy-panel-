<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => '您无法删除自己的账户。',
        'user_has_servers' => '无法删除拥有活动服务器的用户。请先删除其服务器后再继续。',
    ],
    'notices' => [
        'account_created' => '账户已成功创建。',
        'account_updated' => '账户已成功更新。',
    ],
    'details' => [
        'account_details' => 'Account Details',
        'external_id' => 'External ID',
        'username' => 'Username',
        'email' => 'Email Address',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'language' => 'Language',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'root_admin' => 'Root Administrator',
        'root_admin_desc' => 'This user will have full access to all servers and settings on the system.',
        'privileges' => 'Privileges',
        'admin_status' => 'Admin Status',
    ],
];
