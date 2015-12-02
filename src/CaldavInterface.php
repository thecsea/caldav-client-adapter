<?php
/**
 * Created by PhpStorm.
 * User: Claudio Cardinale <cardi@thecsea.it>
 * Date: 02/12/15
 * Time: 0.23
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace it\thecsea\caldav_client_adapter;

/**
 * Interface CaldavInterface
 * @package it\thecsea\caldav_client_adapter
 * @author Claudio Cardinale <cardi@thecsea.it>
 * @copyright 2015 Claudio Cardinale
 * @version 1.0.0
 */
interface CaldavInterface
{

    /**
     * @param string $url
     * @param string $user
     * @param string $pass
     * @throws CaldavException
     */
    public function connect($url, $user, $pass );

    /**
     * @return CalendarInterface[]
     * @throws CaldavException
     */
    public function findCalendars();

    /**
     * @param CalendarInterface $calendar
     * @throws CaldavException
     */
    public function setCalendar(CalendarInterface $calendar);


    /**
     * @param String $start
     * @param String $end
     * @return EventInterface[]
     * @throws CaldavException
     */
    public function getEvents($start = null, $end = null );
}