<?php
/**
 * Created by PhpStorm.
 * User: Claudio Cardinale <cardi@thecsea.it>
 * Date: 02/12/15
 * Time: 0.19
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

namespace it\thecsea\caldav_client_adapter\simple_caldav_client;
use it\thecsea\caldav_client_adapter\CaldavException;
use it\thecsea\caldav_client_adapter\CaldavInterface;
use it\thecsea\caldav_client_adapter\CalendarInterface;
use it\thecsea\simple_caldav_client\CalDAVCalendar;
use it\thecsea\simple_caldav_client\SimpleCalDAVClient;

/**
 * Class SimpleCaldavAdapter
 * @package it\thecsea\caldav_client_adapter
 * @author Claudio Cardinale <cardi@thecsea.it>
 * @copyright 2015 Claudio Cardinale
 * @version 1.0.0
 */
class SimpleCaldavAdapter implements CaldavInterface
{

    /**
     * @var SimpleCalDAVClient
     */
    private $simpleCaldavClient;

    /**
     * SimpleCaldavAdapter constructor.
     */
    public function __construct()
    {
        $this->simpleCaldavClient = new SimpleCalDAVClient();
    }

    public function connect($url, $user, $pass)
    {
        try{
            $this->simpleCaldavClient->connect($url, $user, $pass);
        }catch (\Exception $e){
            throw new CaldavException($e->getMessage(), 0, $e);
        }
    }

    public function findCalendars()
    {
        try{
            $calendars = $this->simpleCaldavClient->findCalendars();
        }catch (\Exception $e){
            throw new CaldavException($e->getMessage(), 0, $e);
        }

        $newCalendars = [];
        foreach($calendars as $key=>$calendar)
            $newCalendars[$key] = new Calendar($calendar);
        return $newCalendars;
    }

    public function setCalendar(CalendarInterface $calendar)
    {
        if(!($calendar->getCalendar() instanceof CalDAVCalendar))
            throw new CaldavException("calendar is not a SimpleCaldavCLient calendar");

        try{
            $this->simpleCaldavClient->setCalendar($calendar->getCalendar());
        }catch (\Exception $e){
            throw new CaldavException($e->getMessage(), 0, $e);
        }
    }

    public function getEvents($start = null, $end = null)
    {
        try{
            $events = $this->simpleCaldavClient->getEvents($start, $end);
        }catch (\Exception $e){
            throw new CaldavException($e->getMessage(), 0, $e);
        }

        $newEvents = [];
        foreach($events as $key=>$event)
            $newEvents[$key] = new Event($event);
        return $newEvents;
    }
}