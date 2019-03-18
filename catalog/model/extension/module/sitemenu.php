<?php
class ModelExtensionModuleSitemenu extends Model {
	public function getSitemenuModules($name) {
		$query = $this->db->query("SELECT `setting` FROM `" . DB_PREFIX . "module` WHERE `name`='$name'  AND `code` = '" . $this->db->escape('sitemenu') . "' ORDER BY `module_id`");

		return $query->rows;
	}
} 