<?php
/**
 * @author Shashakhmetov Talgat <talgatks@gmail.com>
 */

class ControllerExtensionModuleBasicAuth extends Controller {
	
	private $_route 	= 'extension/module/basic_auth';
	private $_model 	= 'model_extension_module_basic_auth';
	private $_version 	= '1.0';

	private $error = [];

	public function index() {
		$this->load->language($this->_route);

		$this->document->setTitle($this->language->get('heading_title'));
		$data['version'] = $this->_version;
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			$this->load->model('setting/setting');
			$this->load->model($this->_route);
			
			$settings = $this->request->post;

			// encrypt passwords
			$lines = explode(PHP_EOL, trim($settings['basic_auth_user_list']));
			$result = [];
			foreach ($lines as $key => $value) {
				$line = explode(':', $value);
				if (count($line) == 2) {
					if (strlen($line[1]) == 37) {
						$result[$key] = $value;	
					} else {
						$result[$key] = $line[0] . ':' . $this->{$this->_model}->crypt_apr1_md5($line[1]);
					}
				} else {
					$result[$key] = $value;	
				}
			}

			$settings['basic_auth_user_list'] = implode(PHP_EOL, $result);
			$settings['basic_auth_exclude_list'] = trim($settings['basic_auth_exclude_list']);

			$this->model_setting_setting->editSetting('basic_auth', $settings);

			$this->{$this->_model}->createHTTPAuthFiles($settings);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link($this->_route, 'user_token=' . $this->session->data['user_token'], true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['htpasswd_path'])) {
			$data['error_htpasswd_path'] = $this->error['htpasswd_path'];
		} else {
			$data['error_htpasswd_path'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link($this->_route, 'user_token=' . $this->session->data['user_token'], true)
		];

		$data['action'] = $this->url->link($this->_route, 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (isset($this->request->post['basic_auth_htpasswd_path'])) {
			$data['basic_auth_htpasswd_path'] = $this->request->post['basic_auth_htpasswd_path'];
		} else {
			$data['basic_auth_htpasswd_path'] = $this->config->get('basic_auth_htpasswd_path');
		}

		if (isset($this->request->post['basic_auth_user_list'])) {
			$data['basic_auth_user_list'] = $this->request->post['basic_auth_user_list'] . PHP_EOL;
		} else {
			$data['basic_auth_user_list'] = $this->config->get('basic_auth_user_list') . PHP_EOL;
		}
		
		if (isset($this->request->post['basic_auth_exclude_list'])) {
			$data['basic_auth_exclude_list'] = $this->request->post['basic_auth_exclude_list'] . PHP_EOL;
		} else {
			$data['basic_auth_exclude_list'] = $this->config->get('basic_auth_exclude_list') . PHP_EOL;
		}

		if (empty($data['basic_auth_htpasswd_path'])) {
			$data['basic_auth_htpasswd_path'] = DIR_STORAGE . '.htpasswd';
		}

		$data['entry_htpasswd_path_placeholder'] = DIR_STORAGE . '.htpasswd';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view($this->_route, $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', $this->_route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['basic_auth_htpasswd_path']) <= 0) || (utf8_strlen($this->request->post['basic_auth_htpasswd_path']) > 255)) {
			$this->error['htpasswd_path'] = $this->language->get('error_htpasswd_path');
		}
		
		return !$this->error;
	}
}
