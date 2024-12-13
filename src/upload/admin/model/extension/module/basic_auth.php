<?php 
/**
 * @author Shashakhmetov Talgat <talgatks@gmail.com>
 */

class ModelExtensionModuleBasicAuth extends Model {
	
	public function createHTTPAuthFiles($data) {

		$htpasswd_path = $data['basic_auth_htpasswd_path'];
		
		$htaccess_path = DIR_APPLICATION . '.htaccess';
		$htaccess_content = '';
		
		@clearstatcache(true);

		// .htpasswd 
		if (!empty($data['basic_auth_user_list'])) {
			file_put_contents($htpasswd_path, $data['basic_auth_user_list']);
		} else {
			if (is_writable($htpasswd_path)) {
				unlink($htpasswd_path);
			}
			if (file_exists($htaccess_path)) {
				$this->saveOrReplace($htaccess_path, $htaccess_content);
			}
			return;
		}

		// .htaccess
		$htaccess_excluded  = '';
		$exclude_paths = explode(PHP_EOL, $data['basic_auth_exclude_list']);
		foreach ($exclude_paths as $key => $value) {
			$trimmed = trim($value);
			if (!empty($trimmed)) {
				$wc_to_regex = str_replace(["\\*", "\\?"], [".*", "."], preg_quote($trimmed));
				$htaccess_excluded .= "SetEnvIfNoCase Request_URI \"" . $wc_to_regex . "\" noauth" . PHP_EOL;
			}
		}

		if (!empty($htaccess_excluded)) {
			$htaccess_excluded .= <<<EOD
			
			Order Deny,Allow
			Deny from all
			Allow from env=noauth
			Satisfy any
			EOD;
		}

		$htaccess_content = preg_replace('/\t/', '', <<<EOD
			# basic_auth

			<FilesMatch ".(htaccess|htpasswd)$">
				Order Allow,Deny
				Deny from all
			</FilesMatch>

			<Files *>
				AuthType Basic
				AuthName "Authorization"
				AuthUserFile "$htpasswd_path"
				Require valid-user
			</Files>

			$htaccess_excluded

			# basic_auth_end
		EOD);

		$this->saveOrReplace($htaccess_path, $htaccess_content);

		return;
	}

	private function saveOrReplace($file_name, $content) {
		$content_wrapper_regexp = '/\#\sbasic_auth[\s\S]+?\#\sbasic_auth_end/';

		@clearstatcache(true, $file_name);

		if (is_file($file_name)) {
			if (is_writable($file_name)) {
				$original = trim(file_get_contents($file_name));
				if (preg_match($content_wrapper_regexp, $original)) {
					$replaced = preg_replace($content_wrapper_regexp, $content, $original);
					file_put_contents($file_name, $replaced);
				} else {
					$content = trim($original . PHP_EOL . $content);
					file_put_contents($file_name, $content);
				}
			} else {
				trigger_error('.htaccess file not writable');
			}
		} else {
			file_put_contents($file_name, $content);
		}

		@clearstatcache(true, $file_name);

		if (filesize($file_name) == 0) {
			@unlink($file_name);
		}
	}

	public static function crypt_apr1_md5($password) {
		$salt = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);
		$len = strlen($password);
		$text = $password . '$apr1$' . $salt;
		$bin = pack('H32', md5($password . $salt . $password));
		for($i = $len; $i > 0; $i -= 16) {
			$text .= substr($bin, 0, min(16, $i));
		}
		for($i = $len; $i > 0; $i >>= 1) {
			$text .= ($i & 1) ? chr(0) : $password[0];
		}
		$bin = pack('H32', md5($text));
		for($i = 0; $i < 1000; $i++) {
			$new = ($i & 1) ? $password : $bin;
			if ($i % 3) {
				$new .= $salt;
			}
			if ($i % 7) {
				$new .= $password;
			}
			$new .= ($i & 1) ? $bin : $password;
			$bin = pack('H32', md5($new));
		}
	
		$tmp = '';
		for ($i = 0; $i < 5; $i++) {
			$k = $i + 6;
			$j = $i + 12;
			if ($j == 16) $j = 5;
			$tmp = $bin[$i] . $bin[$k] . $bin[$j] . $tmp;
		}
		$tmp = chr(0) . chr(0) . $bin[11] . $tmp;
		$tmp = strtr(
			strrev(substr(base64_encode($tmp), 2)),
			'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/',
			'./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
		);
	
		return '$apr1$' . $salt . '$' . $tmp;
	}

}