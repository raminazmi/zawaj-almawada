<?php

return [
    'binaries' => [
        'chromium' => '/usr/bin/chromium-browser',
    ],
    'options' => [
        'args' => ['--no-sandbox', '--disable-setuid-sandbox'],
    ],
];
