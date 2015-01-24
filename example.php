<?php
/**
 *
 * @package Config Editor
 * @copyright (c) 2014 gameserver-admin.de
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

include('options_example.php');
include('functions.php');

if(isset($_POST['submit']))
{
	echo '<pre>' . save_editor_config($options) . '</pre>';
}

echo '<form action="" method="post">';
// HTML Formular erstellen
echo parse_config($options);
echo '<input type="submit" name="submit" />';
echo '</form>';