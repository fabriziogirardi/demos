<?php

$data = [
    [1,2,1,2,1,9],
    [0,5,2],
    [1,6,5,7,9,2],
    [1,3,5,7,9,2],
];

function move($arr, $start, $move) {

    // Calculate complete loops and set default values
    $extra = $move == 0 ? 0 : $move % count($arr);
    $right = -1;
    $left = -1;

    // If jump to right is larger than the array, remove one loop
    if (($start + $extra) > (count($arr) - 1)) {
        $right = ($start + $extra) - count($arr);
    } else {
        $right = $start + $extra;
    }

    // If jump to left is lower than zero, remove one loop
    if (($start - $extra) < 0) {
        $left = ($start - $extra) + count($arr);
    } else {
        $left = $start - $extra;
    }

    // Return new indexes after jumps
    return [$right, $left];
}

function ArrayJumping($arr) {

    // Get largest number and position
    $current = max($arr);
    $position = $start = array_search(max($arr), $arr);

    /**
     * Initialize flags
     *
     * $done has indexes already used that do not get back to the higest number
     * $todo has indexes to be checked with jumping function if can reach the highest number again
     * $tmp stores the temporary data between each loop
     * $jumps count the jumps in course
     * $flag determines the end of the loop
     * 
     */

    $done = [];
    $todo = [$start];
    $tmp = [];
    $jumps = 0;
    $flag = false;

    // Start looping
    while (!$flag) {
        
        $jumps++;

        // Loop through each $todo index
        foreach ($todo as $td) {

            // Perform the jump and parse the new indexes
            foreach (move($arr, $td, $arr[$td]) as $new) {

                // If highest number is reached again, break the loop and return jumps needed
                if ($new == $start) {
                    $flag = true;
                    return $jumps;
                }

                // Only if index was not already tried before, add it to $tmp variable
                if (!in_array($td, $done)) {
                    $tmp[] = $new;
                }
            }

            // Add current index to the $done array
            $done[] = $td;
        }

        // If there are not any $tmp indexes to be done, means array can't get back to the highest element
        // Otherwise, replace $todo with $tmp for the following loop
        if (!count($tmp)) {
            $flag = true;
            return -1;
        } else {
            $todo = $tmp;
            $tmp = [];
        }
    }
}

foreach ($data as $d) {
    echo "Result of " . ArrayJumping($d) . " Jump(s) for the array [" . implode(',',$d) . "]<br />" . PHP_EOL;
}
