<?php

return [

    'label' => 'Konum',
    'plural-label' => 'Konumlar',

    'section' => [
        'title' => 'Location Details',
        'description' => 'Define a location that nodes can be assigned to.',
    ],

    'fields' => [
        'short' => [
            'label' => 'Short Code',
            'placeholder' => 'us.nyc.1',
            'helper' => 'A short identifier for this location.',
        ],

        'long' => [
            'label' => 'Description',
            'placeholder' => 'New York City, NY, USA',
            'helper' => 'A longer description of this location.',
        ],
    ],

    'table' => [
        'id' => 'KİMLİK',
        'short' => 'Short Code',
        'long' => 'Açıklama',
        'nodes' => 'Düğümler',
        'servers' => 'Sunucular',
        'created' => 'Oluşturuldu',
    ],

    'actions' => [
        'edit' => 'Edit',
        'delete' => 'Sil',
    ],

    'messages' => [
        'cannot_delete_with_nodes' => 'Cannot delete a location with associated nodes.',
    ],

];
