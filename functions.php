<?php
/**
 *
 * @package Config Editor
 * @copyright (c) 2014 gameserver-admin.de
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
* Die Funktion erstellt ein HTML Formular aus einer Konfigurationsdatei
*
* @param	array	$options	Array als Vorlage
* @param	string	$config		Eine vorhandene Config Datei
* @return	string	HTML Formular
*/
function parse_config($options, $config = '')
{
    $return = '';
    $var = preg_split("/" . $options['line_end'] . "/", $config);
    for($i = 0; isset($var[$i]); $i++)
    {
        $option = preg_split("/" . $options['spacer'] . "/", $var[$i], 2);
        if(isset($option[1]))
        {
            $set_config[$option[0]] = $option[1];
        }    
    }
    for($i = 0; isset($options[$i]); $i++)
    {
        $return .= '<h3>' . $options[$i]['name'] . '</h3>';
        $return .= '<table style="width:100%;">';
        for($j = 0; isset($options[$i]['options'][$j]); $j++)
        {
            $set_option = isset($set_config[$options[$i]['options'][$j]['value']]) ? $set_config[$options[$i]['options'][$j]['value']] : $options[$i]['options'][$j]['default'];
            $checked = isset($set_config[$options[$i]['options'][$j]['value']]) ? ' checked="checked"' : '';
            $form_name = str_replace('.', '___PUNKT___', $options[$i]['options'][$j]['value']);
            $set_option = str_replace('"', '', $set_option);
            switch($options[$i]['options'][$j]['type'])
            {
                case 'text':
                    $form = '<input type="text" name="' . $form_name . '" value="' . $set_option . '" />';
                break;

                case 'password':
                    $form = '<input type="' . (($user->data['user_level'] == USERLEVEL_ADMIN || $user->data['user_level'] == USERLEVEL_MOD) ? 'text' : 'password') . '" name="' . $form_name . '" value="' . $set_option . '" />';
                break;

                case 'int':
                    $form = '<input size ="5" type="text" name="' . $form_name . '" value="' . $set_option . '" />';
                break;
                case 'textarea':
                    $form = '<textarea rows="4" cols="40" name="' . $form_name . '">' . $set_option . '</textarea>';
                break;
                case 'bool':
                    $_c0 = ($set_option == 0) ? ' checked="checked"' : '';
                    $_c1 = ($set_option == 1) ? ' checked="checked"' : '';
                    $form = '<input name="' . $form_name . '" value="1"' . $_c1 . ' type="radio" />Ja &nbsp; <input name="' . $form_name . '" value="0"' . $_c0 . ' type="radio" /> Nein';
                break;
                case 'select':
                    $form = '<select name="' . $form_name . '">';
                    foreach($options[$i]['options'][$j]['selects'] as $option => $val)
                    {
                        if($option == $set_option)
                        {
                            $form .= '<option selected="selected" value="' . $option . '">' . $val . '</option>';
                        }
                        else
                        {
                            $form .= '<option value="' . $option . '">' . $val . '</option>';
                        }
                    }
                    $form .= '</select>';
                break;
            }
            $return .= '<tr><td style="width:25%"><b>' . $options[$i]['options'][$j]['name'] . '</b><br />' . $options[$i]['options'][$j]['description'] . '</td><td>' . $form . '</td><td style="width:50%;"><input' . $checked . ' type="checkbox" value="1" name="isactiv_' . $form_name . '" /> Aktiv</td></tr>';
        }
        $return .= '</table>';
    }
    return $return;
}

/**
* Die Funktion erstellt eine Config-Datei aus dem Formular das mit parse_config erzeugt wurde
*
* @param	array	$options  Das Array mit der Vorgabe für die Config Datei
* @return	string	Config
*/
function save_editor_config($options)
{
    global $_POST;
    for($i = 0; isset($options[$i]); $i++)
    {
        for($j = 0; isset($options[$i]['options'][$j]); $j++)
        {
            if(isset($options[$i]['options'][$j]['quote']))
            {
                $quote[$options[$i]['options'][$j]['value']] = $options[$i]['options'][$j]['quote'];
            }
        }
    }
    $config_data = '';
    foreach($_POST as $var => $val)
    {
        if(($var <> 'submit_config_editor') && !strstr($var, 'isactiv_'))
        {

		$isactiv  = $_POST['isactiv_' . $var];
            if($isactiv)
            {
                $val = $_POST[$var];
                if(!ctype_digit($val))
                {
                    $val = '"' . $val . '"';
                }
                $var = str_replace('___PUNKT___', '.',$var);
                if(isset($quote[$var]) && !$quote[$var])
                {
                    $val = str_replace('"', '', $val);
                }
                $config_data .= $var . $options['spacer'] . $val . $options['line_end'];
            }
        }
    }
    return $config_data;
} 

