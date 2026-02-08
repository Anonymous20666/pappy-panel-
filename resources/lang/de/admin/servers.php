<?php

return [

    'label' => 'Server',
    'plural-label' => 'Servers',

    'sections' => [
        'identity' => [
            'title' => 'Identität',
            'description' => 'Grundlegende Serverinformationen und Eigentümerschaft.',
        ],
        'allocation' => [
            'title' => 'Zuweisung',
            'description' => 'Wählen Sie die Node und die Netzwerkzuweisung für diesen Server aus.',
        ],
        'startup' => [
            'title' => 'Start',
            'description' => 'Konfigurieren Sie das Egg, den Startbefehl und das Docker-Image.',
        ],
        'resources' => [
            'title' => 'Ressourcenlimits',
            'description' => 'Definieren Sie die Server-Ressourcenlimits.',
        ],
        'feature_limits' => [
            'title' => 'Funktionslimits',
            'description' => 'Begrenzen Sie Datenbanken, Zuweisungen und Backups.',
        ],
        'environment' => [
            'title' => 'Umgebungsvariablen',
            'description' => 'Legen Sie Umgebungswerte für das ausgewählte Egg fest.',
        ],
    ],

    'fields' => [
        'advanced_mode' => [
            'label' => 'Erweiterter Modus',
            'helper' => 'Aktivieren Sie diese Option, um zusätzliche Serverkonfigurationsoptionen anzuzeigen. Aktivieren Sie sie nur, wenn Sie die Auswirkungen der zusätzlichen Einstellungen verstehen.',
        ],
        'external_id' => [
            'label' => 'Externe ID',
            'helper' => 'Optional eindeutiger Bezeichner für diesen Server.',
        ],
        'owner' => [
            'label' => 'Eigentümer',
            'helper' => 'Wählen Sie den Benutzer aus, dem dieser Server gehört.',
        ],
        'name' => [
            'label' => 'Name',
            'placeholder' => 'Server Name',
            'helper' => 'Ein kurzer Name für diesen Server.',
        ],
        'description' => [
            'label' => 'Beschreibung',
            'placeholder' => 'Serverbeschreibung',
            'helper' => 'Optionale Beschreibung für diesen Server.',
        ],
        'node' => [
            'label' => 'Node',
            'helper' => 'Die Node, auf der dieser Server bereitgestellt wird.',
        ],
        'allocation' => [
            'label' => 'Primäre Allocation',
            'helper' => 'Die Standard-IP/Port-Allocation für diesen Server.',
        ],
        'additional_allocations' => [
            'label' => 'Zusätzliche Allocations',
            'helper' => 'Optional zusätzliche Allocations zuweisen.',
        ],
        'nest' => [
            'label' => 'Nest',
            'helper' => 'Das Service-Nest für diesen Server.',
        ],
        'egg' => [
            'label' => 'Egg',
            'helper' => 'Das Egg, das das Serververhalten definiert.',
        ],
        'startup' => [
            'label' => 'Startbefehl',
            'helper' => 'Der Startbefehl für den Server.',
        ],
        'image' => [
            'label' => 'Docker Image',
            'placeholder' => 'z.B. ghcr.io/pterodactyl/yolks:java_17',
            'helper' => 'Docker-Image, das zum Ausführen dieses Servers verwendet wird.',
            'custom' => 'Benutzerdefiniert',
        ],
        'skip_scripts' => [
            'label' => 'Egg-Skripte überspringen',
            'helper' => 'Egg-Installationsskripte während der Erstellung überspringen.',
        ],
        'start_on_completion' => [
            'label' => 'Automatisch nach Abschluss starten',
            'helper' => 'Server nach der Installation automatisch starten.',
        ],
        'memory' => [
            'label' => 'Arbeitsspeicher',
            'helper' => 'Gesamtspeicherzuweisung. Setzen Sie 0 für unbegrenzt. (Unbegrenzter Arbeitsspeicher funktioniert bei Minecraft-Eggs aufgrund des Startbefehls nicht)',
        ],
        'swap' => [
            'label' => 'Swap',
            'helper' => 'Swap-Speicherzuweisung. Setzen Sie 0, um Swap zu deaktivieren, oder -1, um unbegrenzten Swap zuzulassen.',
        ],
        'disk' => [
            'label' => 'Festplatte',
            'helper' => 'Festplattenplatzzuweisung. Setzen Sie 0 für unbegrenzt.',
        ],
        'io' => [
            'label' => 'IO-Gewichtung',
            'helper' => 'Relative Festplatten-I/O-Priorität (10-1000).',
        ],
        'cpu' => [
            'label' => 'CPU',
            'helper' => 'CPU-Begrenzung in Prozent. 100% entspricht einem vollen Kern, 200% entsprechen zwei vollen Kernen usw.',
        ],
        'enter_size_in_gib' => [
            'label' => 'Größe in GiB eingeben',
            'helper' => 'Sie können Größen in GiB mit dem Suffix "GiB" eingeben (z.B. 10GiB = 10240MiB).',
        ],
        'threads' => [
            'label' => 'CPU Threads',
            'helper' => 'Optionale Zuweisung von CPU-Threads. Beispiel: 0-1,3.',
        ],
        'oom_disabled' => [
            'label' => 'OOM Killer deaktivieren',
            'helper' => 'Verhindert, dass der Kernel den Prozess bei Speichermangel beendet.',
        ],
        'database_limit' => [
            'label' => 'Datenbanklimit',
            'helper' => 'Maximale Anzahl von Datenbanken.',
        ],
        'allocation_limit' => [
            'label' => 'Allocationlimit',
            'helper' => 'Maximale Anzahl von Allocations.',
        ],
        'backup_limit' => [
            'label' => 'Backuplimit',
            'helper' => 'Maximale Anzahl von Backups.',
        ],
        'environment' => [
            'key' => 'Variable',
            'value' => 'Wert',
            'helper' => 'Environment-Variablen für dieses Egg.',
        ],
        'use_custom_image' => [
            'label' => 'Benutzerdefiniertes Image verwenden',
            'helper' => 'Umschalten, um ein benutzerdefiniertes Docker-Image anstelle eines vom Egg bereitgestellten zu verwenden.',
        ],
    ],

    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'owner' => 'Besitzer',
        'node' => 'Node',
        'allocation' => 'Allocation',
        'status' => 'Status',
        'egg' => 'Egg',
        'memory' => 'Arbeitsspeicher',
        'disk' => 'Festplatte',
        'cpu' => 'CPU',
        'created' => 'Erstellt',
        'updated' => 'Aktualisiert',
        'installed' => 'Installiert',
        'no_status' => 'Kein Status',
    ],

    'messages' => [
        'created' => 'Server wurde erfolgreich erstellt.',
        'updated' => 'Server wurde erfolgreich aktualisiert.',
        'deleted' => 'Server wurde erfolgreich gelöscht.',
    ],

    'actions' => [
        'edit' => 'Bearbeiten',
        'toggle_install_status' => 'Installationsstatus umschalten',
        'suspend' => 'Suspendieren',
        'unsuspend' => 'Reaktivieren',
        'suspended' => 'Suspendiert',
        'unsuspended' => 'Reaktiviert',
        'reinstall' => 'Neu installieren',
        'delete' => 'Löschen',
        'delete_forcibly' => 'Erzwingend löschen',
        'view' => 'Ansehen',
    ],

    'alerts' => [
        'install_toggled' => 'Server-Installationsstatus wurde umgeschaltet.',
        'server_suspended' => 'Server wurde :action.',
        'server_reinstalled' => 'Server-Neuinstallation wurde gestartet.',
        'server_deleted' => 'Server wurde gelöscht.',
        'server_delete_failed' => 'Server konnte nicht gelöscht werden.',
    ],
];
