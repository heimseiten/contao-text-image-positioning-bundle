<?php

use Contao\System;
use Symfony\Component\HttpFoundation\Request;

if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/heimseitencontaotextimagepositioning/contao_text_image_positioning_bundle.js|static';
}

$GLOBALS['TL_CSS'][] = 'bundles/heimseitencontaotextimagepositioning/contao_text_image_positioning_bundle.scss|static';
