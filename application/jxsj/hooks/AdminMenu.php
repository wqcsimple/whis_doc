<?php
namespace jxsj\hooks;

use fayfox\core\FBase;
use fayfox\F;

class AdminMenu extends FBase{
	public function run(){
		if(method_exists(F::app(), 'addMenuTeam')){
			F::app()->removeMenuTeam('goods');
			F::app()->removeMenuTeam('voucher');
			F::app()->removeMenuTeam('notification');
			F::app()->removeMenuTeam('bill');
			F::app()->removeMenuTeam('menu');
			F::app()->removeMenuTeam('template');
		}
	}
}