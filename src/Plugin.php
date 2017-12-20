<?php
namespace ryangittings\instagramfeed;

use Craft;

use ryangittings\instagramfeed\models\Settings;

use ryangittings\instagramfeed\variables\InlinVariable;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

class Plugin extends \craft\base\Plugin
{

  public static $plugin;
  public $hasCpSettings = true;

  public function init()
  {
    parent::init();
    self::$plugin = $this;

    Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
        /** @var CraftVariable $variable */
        $variable = $event->sender;
        $variable->set('instagramfeed', InstagramFeedVariable::class);
    });
  }

  public function getFeed(): Feed
  {
      return $this->get('feed');
  }

  /**
   * @inheritdoc
   */
  protected function createSettingsModel(): Settings
  {
      return new Settings();
  }
  /**
   * @inheritdoc
   */
  protected function settingsHtml(): string
  {
      // Get and pre-validate the settings
      $settings = $this->getSettings();
      $settings->validate();
      // Get the settings that are being defined by the config file
      $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->handle));
      return Craft::$app->view->renderTemplate('craft-instagram-feed/_settings', [
          'settings' => $settings,
          'overrides' => array_keys($overrides),
      ]);
  }
}
