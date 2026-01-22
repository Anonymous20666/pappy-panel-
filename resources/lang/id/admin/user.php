<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => 'Anda tidak dapat menghapus akun Anda sendiri.',
        'user_has_servers' => 'Tidak dapat menghapus pengguna dengan server aktif yang terhubung ke akun mereka. Harap hapus server mereka sebelum melanjutkan.',
    ],
    'notices' => [
        'account_created' => 'Akun telah berhasil dibuat.',
        'account_updated' => 'Akun telah berhasil diperbarui.',
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
