<?php
namespace lo\widgets;

use yii\web\AssetBundle;

/**
 * ScrollUp asset class
 * @package lo\widgets
 */
class ScrollUpAsset extends AssetBundle
{
    public $sourcePath = '@bower/scrollup';
		
	public $depends = [
        'yii\web\JqueryAsset'
    ];
	
	public function init()
	{
		if (defined('YII_DEBUG')) {
			$this->js = [
				'js/jquery.scrollUp.js'
			];
		} else {
			$this->js = [
				'js/jquery.scrollUp.min.js'
			];
		}
		return parent::init();
	}
}
