<?php

return [

    'company' => [
        'name'              => 'Navn',
        'email'             => 'E-post',
        'phone'             => 'Telefon',
        'address'           => 'Adresse',
        'logo'              => 'Logo',
    ],
    'localisation' => [
        'tab'               => 'Lokalisering',
        'date' => [
            'format'        => 'Datoformat',
            'separator'     => 'Datoseparator',
            'dash'          => 'Bindestrek (-)',
            'dot'           => 'Punktum (.)',
            'comma'         => 'Komma (,)',
            'slash'         => 'Skråstrek (/)',
            'space'         => 'Mellomrom ( )',
        ],
        'timezone'          => 'Tidssone',
        'percent' => [
            'title'         => 'Prosentplassering (%)',
            'before'        => 'Før nummer',
            'after'         => 'Etter nummer',
        ],
    ],
    'invoice' => [
        'tab'               => 'Faktura',
        'prefix'            => 'Nummerprefiks',
        'digit'             => 'Antall siffer',
        'next'              => 'Neste nummer',
        'logo'              => 'Logo',
    ],
    'default' => [
        'tab'               => 'Standardinnstilinger',
        'account'           => 'Standard konto',
        'currency'          => 'Standard valuta',
        'tax'               => 'Standard avgiftssats',
        'payment'           => 'Standard betalingsmåte',
        'language'          => 'Standard språk',
    ],
    'email' => [
        'protocol'          => 'Protokoll',
        'php'               => 'PHP Mail',
        'smtp' => [
            'name'          => 'SMTP',
            'host'          => 'SMTP-vert',
            'port'          => 'SMTP-port',
            'username'      => 'SMTP-brukernavn',
            'password'      => 'SMTP-passord',
            'encryption'    => 'SMTP-sikkerhet',
            'none'          => 'Ingen',
        ],
        'sendmail'          => 'Sendmail',
        'sendmail_path'     => 'Sti for Sendmail',
        'log'               => 'Logg e-post',
    ],
    'scheduling' => [
        'tab'               => 'Tidsplan',
        'send_invoice'      => 'Send fakturapåminnelse',
        'invoice_days'      => 'Antall dager etter forfall for utsending',
        'send_bill'         => 'Send fakturapåminnelse',
        'bill_days'         => 'Antall dager før forfall for utsending',
        'cron_command'      => 'Cron-kommando',
        'schedule_time'     => 'Tid for kjøring',
    ],
    'appearance' => [
        'tab'               => 'Utseende',
        'theme'             => 'Tema',
        'light'             => 'Lys',
        'dark'              => 'Mørk',
        'list_limit'        => 'Oppføringer per side',
        'use_gravatar'      => 'Bruk Gravatar',
    ],
    'system' => [
        'tab'               => 'System',
        'session' => [
            'lifetime'      => 'Øktlevetid (minutter)',
            'handler'       => 'Øktbehandler',
            'file'          => 'Fil',
            'database'      => 'Database',
        ],
        'file_size'         => 'Maks fil størrelse (MB)',
        'file_types'        => 'Tillatte filtyper',
    ],

];
