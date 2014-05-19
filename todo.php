<?php

// Create array to hold list of todo items
$items =[];

// List array items formatted for CLI
function list_items($list)
{  
    $result = '';
    foreach ($list as $key => $value) 
    {
        $key++;    
        $result .= "{$key} {$value}\n";
    }
    return $result;
}
    // Return string of list items separated by newlines.
    // Should be listed [KEY] Value like this:
    // [1] TODO item 1
    // [2] TODO item 2 - blah
    // DO NOT USE ECHO, USE RETURN

//$list_items = list_items($items);
// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = false) //Whatever is typed in is true. Nothing typed in is defaulted to false.
{   
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}   //when user inputs, if it's true, make sure to capitalize it, not, just give the input
    //THis will always make sure the input is capital though
function sort_items($items) {
       
        echo '(A)-Z, (Z)-A, (O)rder Entered, (R)everse order entered :';
       
        $input = get_input(true);

        if ($input == 'A'){
            asort($items);
        }elseif($input == 'Z'){
            rsort($items); 
        }elseif($input == 'O') {
            ksort($items);
        }elseif ($input == 'R') {
            krsort($items);
        }
        return $items;
}


// The loop!
do {
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = get_input();
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        $key= $key - 1;
        unset($items[$key]);
    } elseif ($input == 'S') {
        $items = sort_items($items);
        // print_r($items);
    }

    // $items = array_values($items);
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);