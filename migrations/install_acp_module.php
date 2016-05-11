<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

namespace HeatWare\integration\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['heatware_api_key']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('heatware_api_key', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_HEATWARE_SETTINGS_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_HEATWARE_SETTINGS_TITLE',
				array(
					'module_basename'	=> '\HeatWare\integration\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
