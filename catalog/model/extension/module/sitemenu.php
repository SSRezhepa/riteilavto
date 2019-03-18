<?php
class ModelExtensionModuleSitemenu extends Model {
	public function getSitemenuModules() {
		$query = $this->db->query("SELECT `setting` FROM `" . DB_PREFIX . "module` WHERE `code` = '" . $this->db->escape('sitemenu') . "' ORDER BY `module_id`");

		return $query->rows;
	}
}