<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => 'Du kan inte ta bort ditt eget konto.',
        'user_has_servers' => 'Kan inte ta bort en användare med aktiva servrar kopplade till deras konto. Vänligen ta bort deras servrar innan du fortsätter.',
    ],
    'notices' => [
        'account_created' => 'Kontot har skapats framgångsrikt.',
        'account_updated' => 'Kontot har uppdaterats framgångsrikt.',
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
