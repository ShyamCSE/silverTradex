<?php 

if (!function_exists('get_date')) {
    function get_date($filter)
    {
        $current_date = new DateTime('now');

        switch ($filter) {
            case 'daily':
                $start_date = clone $current_date;
                $end_date = clone $current_date;
                break;

            case 'week':
                $start_date = clone $current_date;
                $start_date->modify('last monday');
                $end_date = clone $current_date;
                $end_date->modify('next sunday');
                break;

            case 'month':
                $start_date = clone $current_date;
                $start_date->modify('first day of this month');
                $end_date = clone $current_date;
                $end_date->modify('last day of this month');
                break;

            case 'year':
                $start_date = clone $current_date;
                $start_date->modify('first day of January this year');
                $end_date = clone $current_date;
                $end_date->modify('last day of December this year');
                break;

            case 'all':
            default:
                // Return a default range or handle it based on your requirements
                $start_date = null;
                $end_date = null;
                break;
        }

        return [
            'start_date' => $start_date ? $start_date->format('Y-m-d') : null,
            'end_date' => $end_date ? $end_date->format('Y-m-d') : null,
        ];
    }


     function status($status) {
        switch ($status) {
            case 1:
                return "Created";
            case 2:
                return "Maked";
            case 3:
                return "Packed";
            case 4:
                return "Shiped";
            case 5:
                return "Transit";
            case 6:
                return "Refinery";
            case 7:
                return "Complete";
            default:
                return "Unknown";
        }
    }
}
