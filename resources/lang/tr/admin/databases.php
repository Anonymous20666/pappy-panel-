<?php

return [

    'label' => 'Veritabanı',
    'plural-label' => 'Veritabanları',

    'none' => 'Yok',

    'sections' => [
        'host_details' => [
            'title' => 'Host Details',
            'description' => 'Configure the database host connection settings.',
        ],

        'authentication' => [
            'title' => 'Authentication',
        ],

        'linked_node' => [
            'title' => 'Linked Node',
        ],
    ],

    'placeholders' => [
        'name' => 'Production MySQL',
        'host' => '127.0.0.1',
        'username' => 'reviactyl',
    ],

    'helpers' => [
        'host' => 'The hostname or IP address of the database server.',
        'linked_node' => 'Optional. Link this host to a specific node.',
    ],

    'fields' => [
        'linked_node' => 'Linked Node',
    ],

    'columns' => [
        'id' => 'KİMLİK',
        'name' => 'İsim',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Kullanıcı Adı',
        'linked_node' => 'Linked Node',
        'databases' => 'Veritabanları',
        'created' => 'Oluşturuldu',
    ],

    'actions' => [
        'edit' => 'Edit',
        'delete' => 'Sil',
    ],

    'errors' => [
        'cannot_delete' => 'Cannot delete a database host with associated databases.',
    ],

];
