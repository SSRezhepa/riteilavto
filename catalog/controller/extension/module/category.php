<?php

class ControllerExtensionModuleCategory extends Controller {

    public function index() {
        $this->load->language('extension/module/category');

        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string) $this->request->get['path']);
        } else {
            $parts = array();
        }

        if (isset($parts[0])) {
            $data['category_id'] = $parts[0];
        } else {
            $data['category_id'] = 0;
        }

        if (isset($parts[1])) {
            $data['child_id'] = $parts[1];
        } else {
            $data['child_id'] = 0;
        }

        $this->load->model('catalog/category');

        $this->load->model('catalog/product');

        $data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories();

        foreach ($categories as $category) {
            if ($category["top"]) {


                $children_data = array();

                //if ($category['category_id'] == $data['category_id']) {
                $children = $this->model_catalog_category->getCategories($category['category_id']);

                foreach ($children as $child) {
                    $filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

                    $children2 = $this->model_catalog_category->getCategories($child['category_id']);
                    $children_data2 = array();
                    foreach ($children2 as $child2) {
                        $children_data2[] = array(
                            'category_id' => $child2['category_id'],
                            'name' => $child2['name'],
                            'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child2['category_id']),
                            'children' => ''
                        );
                    }

                    $children_data[] = array(
                        'category_id' => $child['category_id'],
                        'name' => $child['name'],
                        'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
                        'children' => $children_data2
                    );
                }





                //}

                $filter_data = array(
                    'filter_category_id' => $category['category_id'],
                    'filter_sub_category' => true
                );

                $data['categories'][] = array(
                    'category_id' => $category['category_id'],
                    //'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                    'name' => $category['name'],
                    'children' => $children_data,
                    'href' => $this->url->link('product/category', 'path=' . $category['category_id'])
                );
            }
        }







        return $this->load->view('extension/module/category', $data);
    }

}
