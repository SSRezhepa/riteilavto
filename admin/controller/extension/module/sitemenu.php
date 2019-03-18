<?php

class ControllerExtensionModuleSitemenu extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/module/sitemenu');

        $this->document->addScript('view/javascript/sitemenu/sitemenu.min.js');
        $this->document->setTitle($this->language->get('heading_title'));
        //$this->load->model('extension/module');
        $this->load->model('setting/module');










		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('sitemenu', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}
                   //      var_dump($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}






        $data['heading_title'] = $this->language->get('heading_title');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['error_name'] = $this->language->get('error_name');
        $data['entry_slug'] = $this->language->get('entry_slug');
        $data['error_slug'] = $this->language->get('error_slug');
        $data['entry_add'] = $this->language->get('entry_add');
        $data['entry_sub'] = $this->language->get('entry_sub');
        $data['entry_remove'] = $this->language->get('entry_remove');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['error_title'] = $this->language->get('error_title');
        $data['entry_href'] = $this->language->get('entry_href');
        $data['error_empty'] = $this->language->get('error_empty');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_header'] = $this->language->get('entry_header');
        $data['entry_footer'] = $this->language->get('entry_footer');
        $data['error_position'] = $this->language->get('error_position');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['slug'])) {
            $data['error_slug'] = $this->error['slug'];
        } else {
            $data['error_slug'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = '';
        }

        if (isset($this->error['empty'])) {
            $data['error_empty'] = $this->error['empty'];
        } else {
            $data['error_empty'] = '';
        }

        if (isset($this->error['position'])) {
            $data['error_position'] = $this->error['position'];
        } else {
            $data['error_position'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/sitemenu', 'user_token=' . $this->session->data['user_token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/sitemenu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
            );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('extension/module/sitemenu', 'user_token=' . $this->session->data['user_token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/sitemenu', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
        }

        $data['cancel'] = $this->url->link('extension/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);






		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}







        $data['user_token'] = $this->session->data['user_token'];
















        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['slug'])) {
            $data['slug'] = $this->request->post['slug'];
        } elseif (!empty($module_info)) {
            $data['slug'] = $module_info['slug'];
        } else {
            $data['slug'] = '';
        }

        if (isset($this->request->post['position_header'])) {
            $data['position_header'] = $this->request->post['position_header'];
        } elseif (!empty($module_info) && isset($module_info['position_header'])) {
            $data['position_header'] = $module_info['position_header'];
        } else {
            $data['position_header'] = 0;
        }

        if (isset($this->request->post['position_footer'])) {
            $data['position_footer'] = $this->request->post['position_footer'];
        } elseif (!empty($module_info) && isset($module_info['position_footer'])) {
            $data['position_footer'] = $module_info['position_footer'];
        } else {
            $data['position_footer'] = 0;
        }

        if (isset($this->request->post['links'])) {
            $links = $this->request->post['links'];
        } elseif (isset($this->request->get['module_id'])) {
            $links = $module_info['links'];
        } else {
            $links = array();
        }
        

        
        
        
// var_dump($module_info);
        
        
    
        $data['links'] = array();

        foreach ($links as $link) {
            if (!isset($link['href'])) {
                $link['href'] = '';
            }
            if (!isset($link['sub-link'])) {
                $link['sub-link'] = '';
            }
            $data['links'][] = array(
                'title' => $link['title'],
                'href' => $link['href'],
                'submenu' => $link['sub-link']
            );
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');


        
        
        
        
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
        
        
        
        
        
        
        
        
        

        $this->response->setOutput($this->load->view('extension/module/sitemenu', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/sitemenu')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if ((utf8_strlen($this->request->post['slug']) < 3) || (utf8_strlen($this->request->post['slug']) > 20)) {
            $this->error['slug'] = $this->language->get('error_slug');
        }

        if ((!isset($this->request->post['position_header'])) && (!isset($this->request->post['position_footer']))) {
            $this->error['position'] = $this->language->get('error_position');
        }

        if (!isset($this->request->post['links'])) {
            if (!isset($this->request->post['links']['title'])) {
                $this->error['empty'] = $this->language->get('error_empty');
            }
        }

        if (isset($this->request->post['links'])) {
            foreach ($this->request->post['links'] as $link => $value) {
                if (!$value['title']) {
                    $this->error['title'] = $this->language->get('error_title');
                }
                if (isset($value['sub-link'])) {
                    foreach ($value['sub-link'] as $sublink) {
                        if (!$sublink['title']) {
                            $this->error['title'] = $this->language->get('error_title');
                        }
                    }
                }
                if (!isset($value['sub-link'])) {
                    $submenu = '';
                } else {
                    $submenu = $value['sub-link'];
                }
                $this->request->post['links'][$link]['sub-link'] = $submenu;
            }
        }
        //      var_dump($this->error);
        return !$this->error;
    }

}
