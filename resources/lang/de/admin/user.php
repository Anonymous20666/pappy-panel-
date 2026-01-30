<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => 'Sie können Ihr eigenes Konto nicht löschen.',
        'user_has_servers' => 'Ein Benutzer mit aktiven Servern, die mit seinem Konto verknüpft sind, kann nicht gelöscht werden. Bitte löschen Sie dessen Server, bevor Sie fortfahren.',
    ],
    'notices' => [
        'account_created' => 'Konto wurde erfolgreich erstellt.',
        'account_updated' => 'Konto wurde erfolgreich aktualisiert.',
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
