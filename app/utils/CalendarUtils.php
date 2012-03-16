<?php

/**
 * Description of CalendarUtils
 *
 * @author Smok
 */
class CalendarUtils
{
    /**
     * Creates a sequence (array) of elements in the format
     * 
     * [ { 'h' => 9, 'm' => 30 } ]
     *
     * This is to be used when rendering calendar timeline.
     * 
     * @param object $hours { 'start' => '10:00', 'end' => '19:30' }
     */
    static public function createTimeSequence($hours)
    {
        $start = explode(':', $hours->start);
        $end = explode(':', $hours->end);

        $seq = array();

        //always start with the whole hour, even when start time
        //specified is :30
        $min = 0;
        for($h = $start[0];($h < $end[0]) || ($h == $end[0] && $min <= $end[1]); /* increment done in loop */)
        {
            $a = new DObject();
            $a->h = $h;
            $a->m = $min;

            $seq[] = $a;

            $min += 30;
            if ($min == 60)
            {
                $min = 0;
                //increment here
                $h++;
            }
        }

        return $seq;
    }
}
?>
