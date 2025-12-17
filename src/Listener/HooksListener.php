<?php

declare(strict_types=1);

namespace Heimseiten\ContaoTextImagePositioningBundle\Listener;

use Contao\FrontendTemplate;
use Contao\Template;
use Contao\Module;

use Contao\ContentModel;
use Contao\Widget;

use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class HooksListener {
    public function onGetContentElement(ContentModel $element, string $buffer): string {
        return $this->processBuffer($buffer, $element);
    }

    private function processBuffer(string $buffer, $object): string {
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {
            return $buffer; 
        }

        if ( $object->addImage ) {

            if ( $object->textImagePositioning == 'imageBesideTextCentered') {
                $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 TextMittig"', $buffer, 1);
            }
            if ( $object->textImagePositioning == 'textBesideCroppedFullWidhImage') {
                $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 BildBisZumRand"', $buffer, 1);
            }
            if ( $object->textImagePositioning == 'textBesideCroppedImage') {
                $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 BildBisZurHälfte"', $buffer, 1);
            }   
            if ( $object->textImagePositioning == 'fullWidthImageBackground') {
                $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 BildHinterText"', $buffer, 1);
            }
        
        }
               
        if ( $object->textImagePositioning == 'centerImage') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 BildMittig"', $buffer, 1);
        }
        if ( $object->imageCssFilter ) {
            $buffer = preg_replace('/<img/', '<img style="filter: ' . $object->imageCssFilter . ';"', $buffer, 1);
        }
        if ( $object->centerHeadline == '1') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 headline_center"', $buffer, 1);
        }        
        if ( $object->centerHeadline == 'left') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 headline_left"', $buffer, 1);
        }        
        if ( $object->centerHeadline == 'right') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 headline_right"', $buffer, 1);
        }  
        
        return $buffer;
    }

}
