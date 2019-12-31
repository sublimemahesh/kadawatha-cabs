<?php

function draw_calendar($month, $year, $col) {
    /* draw table */
    $calendar = '<div class="col-sm-' . $col . '">';
    $calendar .= '<table cellpadding="1" cellspacing="1"border="1" class="table-cal">';


    /* table headings */
    $headings = array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');
    $calendar .= '<tr>';
    $calendar .= '<td  align="center">';
    $calendar .= implode('</td><td align="center">', $headings) . '</td>';
    $calendar .= '</tr>';

    /* days and weeks vars now ... */
    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar .= '<tr>';

    /* print "blank" days until the first of the current week */
    for ($x = 0; $x < $running_day; $x++):
        $calendar .= '<td> </td>';
        $days_in_this_week++;
    endfor;

//    $bookings = [1, 2, 3];


    /* keep going with days.... */
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++):


        /* add in the day number */
        $date = $year . '-' . $month . '-' . $list_day;

        $calendar .= '<td class="date-td">';
        $calendar .= '<a href="manage-all-bookings.php?date=' . $date . '">';
        $calendar .= $list_day;
        $calendar .= '</a>';
        $calendar .= '</td>';


        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! * */
        //  $calendar.= str_repeat('<p> </p>', 2);


        if ($running_day == 6):
            $calendar .= '</tr>';
            if (($day_counter + 1) != $days_in_month):
                $calendar .= '<tr>';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if ($days_in_this_week < 8):
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar .= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar .= '</tr>';

    /* end the table */
    $calendar .= '</table>';

    $calendar .= '</div>';


    /* all done, return result */
    return $calendar;
}
