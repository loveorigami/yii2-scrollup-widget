<?php
namespace lo\widgets\scrollup;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Json;

class ScrollUp extends Widget
{
    /**
     * list of available scroll-up themes
     */
    const THEME_IMAGE = 'image';
    const THEME_TAB = 'tab';
    const THEME_PILLS = 'pill';
    const THEME_LINK = 'link';

    /**
     * List of available animation modes
     */
    const ANIMATION_SLIDE = 'slide';
    const ANIMATION_FADE = 'fade';
    const ANIMATION_NONE = 'none';

    /**
     * @var string built-in theme and dir to apply to the scrollup widget.
     */
    public $theme = self::THEME_IMAGE;
    public $themeDir;

    /**
     * ScrollUp options
     * @link http://markgoodyear.com/2013/01/scrollup-jquery-plugin
     * @var array()
     */
    public $options = [];

    /**
     * @var array list of supported built-in themes
     */
    private $_supportedThemes = [
        self::THEME_IMAGE,
        self::THEME_LINK,
        self::THEME_PILLS,
        self::THEME_TAB
    ];

    /**
     * @var array list of supported animation mode
     */
    private $_supportedAnimation = [
        self::ANIMATION_FADE,
        self::ANIMATION_NONE,
        self::ANIMATION_SLIDE
    ];

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        /**
         * Chekcs validity of theme and animation options
         */
        if (!empty($this->theme) && !in_array($this->theme, $this->_supportedThemes)) {
            throw new InvalidConfigException('Unsupported built-in theme : ' . $this->theme);
        }

        if (isset($this->options['animation']) && !in_array($this->options['animation'], $this->_supportedAnimation)) {
            throw new InvalidConfigException('Unsupported animation mode : ' . $this->options['animation']);
        }

    }

    /**
     * Run widget
     */
    public function run()
    {
        $this->registerClientScript();
    }

    /**
     * Registers the needed JavaScript and inject the JS initialization code.
     *
     * Note that if a supported theme is set, all css in the assets/css/theme folder are published
     * but only the css for the theme is registred.Moreover, if the select theme is 'image', the
     * 'scrollText plugin option is cleared.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $bundle = ScrollUpAsset::register($view);
        $bundle->theme = $this->theme;
        $bundle->themeDir = $this->themeDir;

        if ($this->themeDir) {
            $path = $view->getAssetManager()->publish($this->themeDir); // you can use an alias
            $theme_css = $path[1].'/'. $this->theme . '.css';
            $view->registerCssFile($theme_css);
        }

        if ($this->theme == self::THEME_IMAGE && isset($this->options['scrollText'])) {
            $this->options['scrollText'] = '';
        }

        $options = empty($this->options) ? '{}' : Json::encode($this->options);
        $js = "$.scrollUp($options);";

        $view->registerJs($js);
    }
}
