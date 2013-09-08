<?php namespace StickyNotes;

/**
 * Sticky Notes
 *
 * An open source lightweight pastebin application
 *
 * @package     StickyNotes
 * @author      Sayak Banerjee
 * @copyright   (c) 2013 Sayak Banerjee <mail@sayakbanerjee.com>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @link        http://sayakbanerjee.com/sticky-notes
 * @since       Version 1.0
 * @filesource
 */

use Cache;
use Paste;
use Site;

/**
 * Cron class
 *
 * Offers scheduled execution functionality
 *
 * @package     StickyNotes
 * @subpackage  Libraries
 * @author      Sayak Banerjee
 */
class Cron {

	/**
	 * Cron execution interval
	 *
	 * @static
	 * @var int
	 */
	private static $interval = 1800;

	/**
	 * Run cron tasks. This is a simple implementation without
	 * any bells and whistles.
	 *
	 * @static
	 * @return void
	 */
	public static function run()
	{
		// We do a version number check to ensure that we
		// have Sticky Notes installed for cron to run
		if (System::version(Site::config('general')->version) > 0)
		{
			// We run the cron tasks once every 60 minutes
			Cache::remember('cron.run', 60, function()
			{
				// Remove expired pastes
				Paste::where('expire', '>', 0)->where('expire', '<', time())->delete();

				// Add more cron tasks here..

				// Crun run successfully
				return TRUE;
			});
		}
	}

}
