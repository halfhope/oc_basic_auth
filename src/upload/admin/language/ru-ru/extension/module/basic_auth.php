<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

// Heading
$_['heading_title']                     = 'Базовая HTTP авторизация';

// Text
$_['text_edit']                         = 'Редактирование';
$_['text_extension']                    = 'Расширения';

// Entry
$_['entry_htpasswd_path']               = '.htpasswd';
$_['entry_htpasswd_path_help']          = 'Полный путь к файлу .htpasswd';

$_['entry_user_list']                   = 'Пользователи';
$_['entry_user_list_placeholder']       = 'Логин:Пароль';
$_['entry_user_list_help']              = 'Логин и пароль, разделенные двоеточием. Каждый пользователь на новой строке.';
$_['help_user_list']                    = 'Внимание! После сохранения пароль будет преобразован в хэш и больше не будет нигде отображаться в открытом виде. <br>В качестве хеш-функции используется алгоритм APR_MD5.';

$_['entry_exclude_list']                = 'Список исключений';
$_['entry_exclude_list_placeholder']    = 'admin/cron.php' . PHP_EOL . 'admin/export/*.xml' . PHP_EOL . 'admin/tools/';
$_['help_exclude_list']                 = 'Указывайте пути относительно корня сайта. Можно указывать пути для папок и файлов и использовать маску, каждый путь на новой строке. <br />Примеры:<ul><li>admin/cron.php - отдельный файл</li><li>admin/export/*.xml - все XML файлы в папке export</li><li>admin/tools/ - все папки и файлы вложенные в tools, аналогично admin/tools/*</li></ul>';

// Success
$_['text_success']                      = 'Настройки успешно изменены!';
// Error
$_['error_permission']                  = 'У вас недостаточно прав для внесения изменений!';
$_['error_htpasswd_path']               = 'Путь не может быть пустым!';