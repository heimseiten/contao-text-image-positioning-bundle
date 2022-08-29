<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\System;

$GLOBALS['TL_DCA']['tl_content']['fields']['textImagePositioning'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['textImagePositioning'],
    'inputType' => 'select',
    'eval'      => array('tl_class'=>'w50'),
    'options'   => array('-', 'centerImage' ,'imageBesideTextCentered', 'textBesideCroppedImage', 'textBesideCroppedFullWidhImage', 'fullWidthImageBackground'),
    'reference' => &$GLOBALS['TL_LANG']['textImagePositioning'], 
    'sql'       => "varchar(255) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['centerHeadline'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['centerHeadline'],
    'inputType' => 'select', 
    'eval'      => array('tl_class' => 'w50'),
    'options'   => array('-', 'left' ,'1', 'right'),
    'reference' => &$GLOBALS['TL_LANG']['centerHeadline'], 
    'sql'       => "varchar(255) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['imageCssFilter'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['BgCssFilter'],
    'inputType' => 'text',
    'eval'      => array('tl_class'=>'w50'),
    'sql'       => "text NULL"
];

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function() {
    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette) {
        if (\is_string($palette)) {   
            if ($key == 'text') { 
                PaletteManipulator::create()
                ->addField('textImagePositioning', 'fullsize')
                ->addField('imageCssFilter', 'floating')
                ->applyToSubpalette('addImage', 'tl_content');

                PaletteManipulator::create()
                ->addField('centerHeadline', 'type_legend', PaletteManipulator::POSITION_APPEND)
                ->applyToPalette('text', 'tl_content');
                
                PaletteManipulator::create()
                ->addField('centerHeadline', 'type_legend', PaletteManipulator::POSITION_APPEND)
                ->applyToPalette('headline', 'tl_content');
            }
        }
    }
};
