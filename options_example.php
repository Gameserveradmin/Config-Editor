<?php
/**
 *
 * @package Config Editor
 * @copyright (c) 2014 gameserver-admin.de
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

$options = array(
    'spacer'    => ' ',                //Wird zwischen der Option und dem wert angegeben, ' ' ergibt "option wert", '=' ergibt "option=wert"
    'line_end'    => "\n",           //Wird am Ende von jedem Eintrag verwendet, "\n" ergibt eine neue Zeile
    array(
        'name'        => 'Kategorie 1',
        'options'     => array(
            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => 'Standard Wert',
                'type'            => 'text',                // Einzeiliger Text
                'quote'            => true,                //Der Wert wird in der config Datei in Anfürungszeichen geschrienen (key="wert")
            ),

            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => 'Standard Wert',
                'type'            => 'textarea',                // Mehrzeiliger Text
            ),

            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => '',
                'type'            => 'password',            // Passwortfeld
            ),

        ),
    ),
    array(
        'name'        => 'Kategorie 2',
        'options'     => array(
            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => 0,
                'type'            => 'int',                // Ganzzahl
            ),

            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => 0,
                'type'            => 'select',            // Auswal Box
                'selects'        => array(
                    '0'        => 'Option1',                // 1. Option der Auswahlbox
                    '1'        => 'Option2',                // usw...
                ),
            ),

            array(
                'value'            => 'option_in_config',
                'name'            => 'Name im Editor',
                'description'    => 'Beschreibung der Variable im Editor',
                'default'        => 0,
                'type'            => 'bool',                // Checkbox, kann 0 oder 1 sein
            ),

        ),
    ),
); 