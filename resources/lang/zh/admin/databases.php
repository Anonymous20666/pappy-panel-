<?php

return [

    'label' => '数据库',
    'plural-label' => '数据库',

    'none' => '无',

    'sections' => [
        'host_details' => [
            'title' => '主机信息',
            'description' => '配置数据库主机连接设置。',
        ],

        'authentication' => [
            'title' => '身份验证',
        ],

        'linked_node' => [
            'title' => '关联节点',
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
        'id' => 'ID',
        'name' => 'Name',
        'host' => 'Host',
        'port' => 'Port',
        'username' => 'Username',
        'linked_node' => 'Linked Node',
        'databases' => 'Databases',
        'created' => 'Created',
    ],

    'actions' => [
        'edit' => 'Edit',
        'delete' => 'Delete',
    ],

    'errors' => [
        'cannot_delete' => 'Cannot delete a database host with associated databases.',
    ],

];
