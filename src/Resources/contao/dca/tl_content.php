<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\System;

$GLOBALS['TL_DCA']['tl_content']['fields']['textImagePositioning'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['textImagePositioning'],
    'inputType' => 'select',
    'eval'      => array('tl_class'=>'w50 clr'),
    'options'   => array('', 'imageBesideTextCentered', 'fullWidhElementTextBesideCroppedImage', 'textAbsoluteAtImageBottom', 'fullWidthImageBackground'),
    'reference' => &$GLOBALS['TL_LANG']['textImagePositioning'], 
    'sql'       => "varchar(255) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['centerImage'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['centerImage'],
    'inputType' => 'checkbox', 
    'eval'      => array('tl_class' => 'w50 m12'),
    'sql'       => "char(1) NOT NULL default ''" 
];
$GLOBALS['TL_DCA']['tl_content']['fields']['centerHeadline'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['centerHeadline'],
    'inputType' => 'checkbox', 
    'eval'      => array('tl_class' => 'w50 m12'),
    'sql'       => "char(1) NOT NULL default ''" 
];

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function()
{
    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette)
    {
        if (\is_string($palette))
        {   
            if ($key == 'text') { 
                PaletteManipulator::create()
                ->addField('centerImage', 'fullsize')
                ->addField('textImagePositioning', 'fullsize')
                ->applyToSubpalette('addImage', 'tl_content');

                PaletteManipulator::create()
                ->addField('centerHeadline', 'type_legend', PaletteManipulator::POSITION_APPEND)
                ->applyToPalette('text', 'tl_content');
                
                PaletteManipulator::create()
                ->addField('centerHeadline', 'type_legend', PaletteManipulator::POSITION_APPEND)
                ->applyToPalette('headline', 'tl_content');
            } else {
            }
        }
    }
};
