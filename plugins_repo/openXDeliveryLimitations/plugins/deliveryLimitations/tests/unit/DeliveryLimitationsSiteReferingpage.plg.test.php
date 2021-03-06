<?php

/*
+---------------------------------------------------------------------------+
| OpenX v${RELEASE_MAJOR_MINOR}                                                                |
| =======${RELEASE_MAJOR_MINOR_DOUBLE_UNDERLINE}                                                                |
|                                                                           |
| Copyright (c) 2003-2009 OpenX Limited                                     |
| For contact details, see: http://www.openx.org/                           |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id$
*/

require_once MAX_PATH . '/lib/max/Plugin.php';
// Using multi-dirname so that the tests can run from either plugins or plugins_repo
require_once dirname(dirname(dirname(__FILE__))) . '/Site/Referingpage.delivery.php';

/**
 * A class for testing the Plugins_DeliveryLimitations_Site_Referingpage class.
 *
 * @package    OpenXPlugin
 * @subpackage TestSuite
 * @author     Andrew Hill <andrew@m3.net>
 */
class Plugins_TestOfPlugins_DeliveryLimitations_Site_Referingpage extends UnitTestCase
{
    function testCheckSiteReferingpage()
    {
        // == and !=
        $this->assertTrue(MAX_checkSite_Referingpage('http://www.openx.org/',  '==', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('http://www.openx.org/', '!=', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('http://www.openx.org/', '==', array('referer' => 'http://www.example.com/')));
        $this->assertTrue(MAX_checkSite_Referingpage('http://www.openx.org/',  '!=', array('referer' => 'http://www.example.com/')));

        // =~ and !~
        $this->assertTrue(MAX_checkSite_Referingpage('openx.org', '=~', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('openx.org', '!~', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('openx.org', '=~', array('referer' => 'http://www.example.com/')));
        $this->assertTrue(MAX_checkSite_Referingpage('openx.org', '!~', array('referer' => 'http://www.example.com/')));

        // =x and !x
        $this->assertTrue(MAX_checkSite_Referingpage('.*(openx|example)\.(org|com).*', '=x', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('.*(openx|example)\.(org|com).*', '!x', array('referer' => 'http://www.openx.org/')));
        $this->assertFalse(MAX_checkSite_Referingpage('.*(openx|example)\.(org|com).*', '=x', array('referer' => 'http://www.openx.net/')));
        $this->assertTrue(MAX_checkSite_Referingpage('.*(openx|example)\.(org|com).*', '!x', array('referer' => 'http://www.openx.net/')));
    }
}

?>
