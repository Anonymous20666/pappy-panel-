<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => 'Kendi hesabınızı silemezsiniz.',
        'user_has_servers' => 'Hesabına bağlı aktif sunucuları olan bir kullanıcıyı silemezsiniz. Lütfen devam etmeden önce sunucularını silin.',
    ],
    'notices' => [
        'account_created' => 'Hesap başarıyla oluşturuldu.',
        'account_updated' => 'Hesap başarıyla güncellendi.',
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
