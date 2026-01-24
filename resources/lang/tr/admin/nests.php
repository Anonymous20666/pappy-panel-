<?php

return [
    'notices' => [
        'created' => 'Yeni bir nest, :name, başarıyla oluşturuldu.',
        'deleted' => 'İstenen nest Panelden başarıyla silindi.',
        'updated' => 'Nest yapılandırma seçenekleri başarıyla güncellendi.',
    ],
    'eggs' => [
        'notices' => [
            'imported' => 'Bu Egg ve ilişkili değişkenleri başarıyla içe aktarıldı.',
            'updated_via_import' => 'Bu Egg, sağlanan dosya kullanılarak güncellendi.',
            'deleted' => 'İstenen egg Panelden başarıyla silindi.',
            'updated' => 'Egg yapılandırması başarıyla güncellendi.',
            'script_updated' => 'Egg kurulum betiği güncellendi ve sunucular kurulduğunda çalışacak.',
            'egg_created' => 'Yeni bir egg başarıyla oluşturuldu. Bu yeni egg\'i uygulamak için çalışan daemon\'ları yeniden başlatmanız gerekecek.',
        ],
    ],
    'variables' => [
        'notices' => [
            'variable_deleted' => '":variable" değişkeni silindi ve sunucular yeniden oluşturulduğunda artık kullanılamayacak.',
            'variable_updated' => '":variable" değişkeni güncellendi. Değişiklikleri uygulamak için bu değişkeni kullanan sunucuları yeniden oluşturmanız gerekecek.',
            'variable_created' => 'Yeni değişken başarıyla oluşturuldu ve bu egg\'e atandı.',
        ],
    ],
];
