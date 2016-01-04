<?php
namespace lo\widgets\scrollup;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

class ScrollUp extends \yii\base\Widget
{
	/**
	 * list of available scroll-up themes
	 */
	const THEME_IMAGE = 'image';
	const THEME_TAB = 'tab';
	const THEME_PILLS = 'pill';
	const THEME_LINK = 'link';
	
	const THEME_DIR = 'default';
	
	/**
	 * List of available animation modes
	 */
	const ANIMATION_SLIDE = 'slide';
	const ANIMATION_FADE = 'fade';
	const ANIMATION_NONE = 'none';
	
	/**
	 *
	 * @var string built-in theme and dir to apply to the scrollup widget.
	 */
	public $theme = self::THEME_IMAGE;
	public $themeDir = '';
	
   /**
     * ScrollUp options
     * @link http://markgoodyear.com/2013/01/scrollup-jquery-plugin
     * @var array()
     */
    public $options =[];

	/**
	 *
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

    public function init()
    {
        parent::init();
		
		 /**
		 * Chekcs validity of theme and animation options
		 */
		 
		if (! empty($this->theme) && ! in_array($this->theme, $this->_supportedThemes)) {
			throw new InvalidConfigException('Unsupported built-in theme : ' . $this->theme);
		}
		
		if (isset($this->options['animation']) && ! in_array($this->options['animation'], $this->_supportedAnimation)) {
			throw new InvalidConfigException('Unsupported animation mode : ' . $this->options['animation']);
		}
	
    }


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

		if ($this->theme) {
			if ($this->themeDir) {
				$path = $view->getAssetManager()->publish($this->themeDir); // you can use an alias
                $theme_css = $path[1].'/'. $this->theme . '.css';
			}
            else{
                $path = $view->getAssetManager()->publish('@bower/scrollup');
                $theme_css = $path[1] . '/css/themes/'.$this->theme . '.css';
            }

			$view->registerCSSFile($theme_css);
			
			if ($this->theme == self::THEME_IMAGE && isset($this->options['scrollText'])) {
				$this->options['scrollText'] = '';
			}
		}

        ScrollUpAsset::register($view);

		$options = empty($this->options) ? '{}' : Json::encode($this->options);
		$js = "$.scrollUp($options);";
		$view->registerJs($js);
	}

}
