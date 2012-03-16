<?php

class AppointmentUtils
{
    /**
     * Returns the service colors. For now its static here, but this can be
     * modified to read the colors from user settings.
     */
    static public function getServiceColors()
    {
         return array('1' => '#B8763C', '2' => '#A03478', 'other' => '#58a0dd');
    }
}