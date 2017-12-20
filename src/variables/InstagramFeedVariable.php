<?php
namespace ryangittings\instagramfeed;

use Craft;

use ryangittings\instagramfeed\Plugin;

class InstagramFeedVariable
{
	/* accessable in templates as craft.instagramfeed.getFeed()
	** returns an array of instagram image urls
	*/
	public function getFeed($limit)
	{
    $plugin = Plugin::getInstance();
    $Feed = $plugin->getFeed();
		return $Feed->getFeed($limit);
	}

	public function isConnected()
	{
    $plugin = Plugin::getInstance();
    $Feed = $plugin->getFeed();
		return $Feed->isConnected();
	}
}