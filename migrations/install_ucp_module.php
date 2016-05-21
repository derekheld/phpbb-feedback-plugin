<?php

namespace HeatWare\integration\migrations;

class install_ucp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'ucp'
				AND module_langname = 'HEATWARE_SETTINGS_TITLE'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id !== false;
	}

	static public function depends_on()
	{
		return array('\HeatWare\integration\migrations\install_user_schema');
	}

	public function update_data()
	{
		return array(
			array('module.add', array(
				'ucp',
				0,
				'HEATWARE_SETTINGS_TITLE'
			)),
			array('module.add', array(
				'ucp',
				'HEATWARE_SETTINGS_TITLE',
				array(
					'module_basename'	=> '\HeatWare\integration\ucp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
