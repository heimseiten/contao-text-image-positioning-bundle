<?php

declare(strict_types=1);

namespace Heimseiten\ContaoTextImagePositioningBundle\Listener;

use Contao\FrontendTemplate;
use Contao\Template;
use Contao\Module;

use Contao\ContentModel;
use Contao\Widget;

class HooksListener
{
    public function onGetContentElement(ContentModel $element, string $buffer): string
    {
        return $this->processBuffer($buffer, $element);
    }

    private function processBuffer(string $buffer, $object): string
    {
        if (TL_MODE === 'BE') { return $buffer; }

        $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 text_div_inside"', $buffer, 1);
        
        if ( $object->textImagePositioning == 'imageBesideTextCentered') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 text_in_center_of_image"', $buffer, 1);
        }
        if ( $object->textImagePositioning == 'textBesideCroppedFullWidhImage') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 image_full_width_height_as_text"', $buffer, 1);
        }
        if ( $object->textImagePositioning == 'textBesideCroppedImage') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 image_height_as_text"', $buffer, 1);
        }   
        if ( $object->textImagePositioning == 'fullWidthImageBackground') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 image_as_background"', $buffer, 1);
        }        
        if ( $object->centerImage == '1') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 center_image"', $buffer, 1);
        }        
        if ( $object->centerHeadline == '1') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 center_headline"', $buffer, 1);
        }    
        
        return $buffer;
    }

}
