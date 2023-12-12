
<div class="card-body table-responsive p-0 pb-2 pl-2">
<?php

function generateAcademicCalendar($year) {
    for ($month = 1; $month <= 12; $month++) {
        generateMonthCalendar($year, $month);
    }
}

function generateMonthCalendar($year, $month) {
    echo "<h2>" . date('F Y', strtotime("$year-$month-01")) . "</h2>";

    echo "<table border='1' class='table table-hover text-nowrap  table-bordered'>";
    echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $lastDayOfMonth = mktime(0, 0, 0, $month + 1, 0, $year);

    $currentDay = $firstDayOfMonth;

    while ($currentDay <= $lastDayOfMonth) {
        echo "<tr>";

        for ($dayOfWeek = 0; $dayOfWeek < 7; $dayOfWeek++) {
            echo "<td>";
            if (date('n', $currentDay) == $month) {
                $dayNumber = date('j', $currentDay);

                // Apply red color to Sundays
                $cellStyle = (date('w', $currentDay) == 0) ? 'color:red' : '';

                echo "<span style='$cellStyle'>$dayNumber</span>";
            }
            echo "</td>";

            $currentDay = strtotime("+1 day", $currentDay);
        }

        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
}

// Example usage: Generate the calendar for the year 2023.
generateAcademicCalendar(2023);

?>


</div>
