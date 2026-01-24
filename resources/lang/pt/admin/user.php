<?php

return [
    'title' => 'User',
    'exceptions' => [
        'delete_self' => 'Você não pode excluir sua própria conta.',
        'user_has_servers' => 'Não é possível excluir um usuário com servidores ativos vinculados à sua conta. Por favor, exclua os servidores antes de continuar.',
    ],
    'notices' => [
        'account_created' => 'A conta foi criada com sucesso.',
        'account_updated' => 'A conta foi atualizada com sucesso.',
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
