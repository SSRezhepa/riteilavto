<?php
class ControllerExtensionModuleSitemenu extends Controller {
	public function index($setting) {
            
            
            
            
            $this->load->model('extension/module/sitemenu');
           
           // var_dump($sitemenu);
            
		static $module = 0;


		$data['sitemenu'] = array();


                $sitemenu = $this->model_extension_module_sitemenu->getSitemenuModules($setting['name']);

                $data['sitemenu'] = json_decode($sitemenu[0]['setting'],true);

		$data['module'] = $module++;
                
               // var_dump($data['sitemenu']["links"]);

		return $this->load->view('extension/module/sitemenu', $data);
	}
}  