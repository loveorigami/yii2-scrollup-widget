<?php
namespace lo\widgets\scrollup;

use yii\web\AssetBundle;

/**
 * ScrollUp asset class
 * @package lo\widgets
 */
class ScrollUpAsset extends AssetBundle
{

    public $theme;
    public $themeDir;

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . "/assets";

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

    /**
     * @inheritdoc
     * Register css files as per the request
     * @param \yii\web\View $view
     */
    public function registerAssetFiles($view)
    {
        if (!$this->themeDir) {
            $this->css = [
                'themes/' . $this->theme . '.css'
            ];
        }
        parent::registerAssetFiles($view);
    }
}
