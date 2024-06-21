<?php

return [
    [
        'path' => 'api',
        'controller' => 'main',
        'action' => ''
    ],
    [
        'path' => 'api/registration',
        'controller' => 'user',
        'action' => 'registration'
    ],
    [
        'path' => 'api/login',
        'controller' => 'user',
        'action' => 'login'
    ],
    [
        'path' => 'api/checkauth',
        'controller' => 'user',
        'action' => 'checkauth'
    ],
    [
        'path' => 'api/getuserinfo',
        'controller' => 'user',
        'action' => 'getuserinfo'
    ],
    [
        'path' => 'api/game.all',
        'controller' => 'game',
        'action' => 'getall'
    ],
    [
        'path' => 'api/game.get',
        'controller' => 'game',
        'action' => 'getone'
    ],
    [
        'path' => 'api/game.create_session',
        'controller' => 'game',
        'action' => 'createsession'
    ],
    [
        'path' => 'api/game.end',
        'controller' => 'game',
        'action' => 'endgame'
    ],
    [
        'path' => 'api/game.getstats',
        'controller' => 'game',
        'action' => 'getstats'
    ],
    [
        'path' => 'api/game.getallstats',
        'controller' => 'game',
        'action' => 'getallstats'
    ],
    [
        'path' => 'api/game.getliked',
        'controller' => 'game',
        'action' => 'getliked'
    ],
    [
        'path' => 'api/changeinfo',
        'controller' => 'user',
        'action' => 'changeinfo'
    ],
    [
        'path' => 'api/like',
        'controller' => 'user',
        'action' => 'like'
    ],
    [
        'path' => 'api/settings.get',
        'controller' => 'user',
        'action' => 'settingsget'
    ]
];