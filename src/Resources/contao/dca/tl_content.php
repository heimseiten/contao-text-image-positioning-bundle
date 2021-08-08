<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\System;

$GLOBALS['TL_DCA']['tl_content']['fields']['textImagePositioning'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['textImagePositioning'],
    'inputType' => 'select',
    'eval'      => array('tl_class'=>'w50'),
    'options'   => array('', 'imageBesideTextCentered', 'fullWidhElementTextBesideCroppedImage', 'textAbsoluteAtImageBottom'),
    'reference' => &$GLOBALS['TL_LANG']['textImagePositioning'], 
    'sql'       => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = function()
{
    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $palette)
    {
        if (\is_string($palette))
        {   
            if ($key == 'text') { 
                PaletteManipulator::create()
                ->addField('textImagePositioning', 'fullsize')
                ->applyToSubpalette('addImage', 'tl_content');
            } else {
            }
        }
    }
};