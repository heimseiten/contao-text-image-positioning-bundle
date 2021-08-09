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
        
        if ( $object->textImagePositioning == 'imageBesideTextCentered') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 text_in_center_of_image"', $buffer, 1);
        }
        if ( $object->textImagePositioning == 'fullWidhElementTextBesideCroppedImage') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 full_width_text_image_teaser"', $buffer, 1);
        }
        if ( $object->textImagePositioning == 'textAbsoluteAtImageBottom') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 text_absolute_button"', $buffer, 1);
        }        
        if ( $object->centerImage == '1') {
            $buffer = preg_replace('/class="([^"]+)"/', 'class="$1 center_image"', $buffer, 1);
        }        
        
        return $buffer;
    }

}
