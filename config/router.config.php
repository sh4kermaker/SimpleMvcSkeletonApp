<?php

return [
    Application\Controller\DefaultController::class => [
        'namedRouteParams' => 'action',
    ],
    SimpleMvc\Controller\RouterController::class => [
        'namedRouteParams' => 'path',
    ],
];