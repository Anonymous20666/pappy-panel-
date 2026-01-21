<?php

return [
    'exceptions' => [
        'no_new_default_allocation' => 'Bu sunucu için varsayılan tahsisi silmeye çalışıyorsunuz ancak kullanılabilecek yedek bir tahsis yok.',
        'marked_as_failed' => 'Bu sunucu önceki bir kurulumda başarısız olarak işaretlendi. Bu durumda durum değiştirilemez.',
        'bad_variable' => ':name değişkeni ile ilgili bir doğrulama hatası oluştu.',
        'daemon_exception' => 'Daemon ile iletişim kurulurken bir istisna oluştu ve HTTP/:code yanıt kodu alındı. Bu istisna günlüğe kaydedildi. (istek kimliği: :request_id)',
        'default_allocation_not_found' => 'İstenen varsayılan tahsis bu sunucunun tahsisleri arasında bulunamadı.',
    ],
    'alerts' => [
        'startup_changed' => 'Bu sunucu için başlangıç yapılandırması güncellendi. Bu sunucunun nest veya egg\'i değiştirildiyse, şu anda bir yeniden kurulum gerçekleşecektir.',
        'server_deleted' => 'Sunucu başarıyla sistemden silindi.',
        'server_created' => 'Sunucu panelde başarıyla oluşturuldu. Lütfen daemon\'ın bu sunucuyu tamamen kurması için birkaç dakika bekleyin.',
        'build_updated' => 'Bu sunucu için yapı detayları güncellendi. Bazı değişikliklerin etkili olması için yeniden başlatma gerekebilir.',
        'suspension_toggled' => 'Sunucu askıya alma durumu :status olarak değiştirildi.',
        'rebuild_on_boot' => 'Bu sunucu bir Docker Konteyneri yeniden oluşturması gerektirecek şekilde işaretlendi. Bu işlem sunucu bir sonraki başlatıldığında gerçekleşecektir.',
        'install_toggled' => 'Bu sunucu için kurulum durumu değiştirildi.',
        'server_reinstalled' => 'Bu sunucu şuan başlayan bir yeniden kurulum için sıraya alındı.',
        'details_updated' => 'Sunucu detayları başarıyla güncellendi.',
        'docker_image_updated' => 'Bu sunucu için kullanılacak varsayılan Docker görüntüsü başarıyla değiştirildi. Bu değişikliği uygulamak için yeniden başlatma gereklidir.',
        'node_required' => 'Bu panele bir sunucu ekleyebilmeniz için önce en az bir düğüm yapılandırmış olmanız gerekir.',
        'transfer_nodes_required' => 'Sunucuları transfer edebilmeniz için önce en az iki düğüm yapılandırmış olmanız gerekir.',
        'transfer_started' => 'Sunucu transferi başlatıldı.',
        'transfer_not_viable' => 'Seçtiğiniz düğüm, bu sunucuyu barındırmak için gereken disk alanına veya belleğe sahip değil.',
    ],
];
