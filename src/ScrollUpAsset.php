<?php
namespace lo\widgets\scrollup;

use yii\web\AssetBundle;

/**
 * ScrollUp asset class
 * @package lo\widgets
 */
class ScrollUpAsset extends AssetBundle
{
    public $sourcePath = '@bower/scrollup';

    public $theme;
    public $themeDir;

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        if (defined('YII_DEBUG')) {
            $this->js = [
                'dist/jquery.scrollUp.js'
            ];
        } else {
            $this->js = [
                'dist/jquery.scrollUp.min.js'
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
                'css/themes/' . $this->theme . '.css'
            ];
        }
        parent::registerAssetFiles($view);
    }
}
