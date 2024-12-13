<?php
/**
 * @author Shashakhmetov Talgat <talgatks@gmail.com>
 */

// Heading
$_['heading_title']                     = 'Basic HTTP Authorization';

// Text
$_['text_edit']                         = 'Edit';
$_['text_extension']                    = 'Extensions';

// Entry
$_['entry_htpasswd_path']               = '.htpasswd';
$_['entry_htpasswd_path_help']          = 'Full path to .htpasswd';

$_['entry_user_list']                   = 'Users';
$_['entry_user_list_placeholder']       = 'Username:Password';
$_['entry_user_list_help']              = 'Username and password are separated by a colon. Each user on a new line.';
$_['help_user_list']                    = 'Attention! After saving, the password will be converted to a hash and will not be displayed anywhere else.<br>The hash function is the APR_MD5 algorithm. ';

$_['entry_exclude_list']                = 'Exclusions';
$_['entry_exclude_list_placeholder']    = 'admin/cron.php' . PHP_EOL . 'admin/export/*.xml' . PHP_EOL . 'admin/tools/';
$_['help_exclude_list']                 = 'Specify paths relative to the site root. You can specify paths for folders and files and use a mask, each path on a new line. <br />Examples:<ul><li>admin/cron.php - single file</li><li>admin/export/*.xml - all XML files in export folder</li><li>admin/ tools/ - all folders and files nested in tools, similar to admin/tools/*</li></ul>';

// Success
$_['text_success']                      = 'Settings  successfully changed!';
// Error
$_['error_permission']                  = 'You do not have permissions to make changes!';
$_['error_htpasswd_path']               = 'The path cannot be empty!';