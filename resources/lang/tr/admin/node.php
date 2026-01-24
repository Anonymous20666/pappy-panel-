<?php

return [
    'validation' => [
        'fqdn_not_resolvable' => 'Sağlanan FQDN veya IP adresi geçerli bir IP adresine çözümlenemiyor.',
        'fqdn_required_for_ssl' => 'Bu düğüm için SSL kullanabilmek amacıyla genel bir IP adresine çözümlenen tam nitelikli bir alan adı (FQDN) gereklidir.',
    ],
    'notices' => [
        'allocations_added' => 'Tahsisler bu düğüme başarıyla eklendi.',
        'node_deleted' => 'Düğüm başarıyla panelden kaldırıldı.',
        'location_required' => 'Bu panele bir düğüm ekleyebilmeniz için önce en az bir konum yapılandırmış olmanız gerekir.',
        'node_created' => 'Yeni düğüm başarıyla oluşturuldu. \'Yapılandırma\' sekmesini ziyaret ederek bu makinedeki daemon\'ı otomatik olarak yapılandırabilirsiniz. <strong>Sunucu eklemeden önce en az bir IP adresi ve port tahsis etmelisiniz.</strong>',
        'node_updated' => 'Düğüm bilgileri güncellendi. Herhangi bir daemon ayarı değiştirildiyse, bu değişikliklerin etkili olması için onu yeniden başlatmanız gerekecektir.',
        'unallocated_deleted' => '<code>:ip</code> için tahsis edilmemiş tüm portlar silindi.',
    ],
];
