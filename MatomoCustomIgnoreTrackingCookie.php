<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\MatomoCustomIgnoreTrackingCookie;

use Piwik\Common;
use Piwik\Cookie;

class MatomoCustomIgnoreTrackingCookie extends \Piwik\Plugin {
    private string $cookieName = "is_employee";

    public function registerEvents() {
        return [
            'Tracker.isExcludedVisit' => 'hasExcludedCookie',
        ];
    }

    /**
     * Triggered on every tracking request.
     *
     * This event can be used to tell the Tracker not to record this particular action or visit.
     *
     * @param bool &$excluded Whether the request should be excluded or not. Initialized
     *                        to `false`. Event subscribers should set it to `true` in
     *                        order to exclude the request.
     *
     */
    public function hasExcludedCookie(&$excluded) {
        $excluded = Cookie::isCookieInRequest($this->cookieName);

        if ($excluded) {
            Common::printDebug("iFixit ignore cookie found.");
        }
    }
}
