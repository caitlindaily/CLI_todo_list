<?php

// Create array to hold list of todo items
$items =[];
//============================================================
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
//===============================================================   
function get_input($upper = false) //Whatever is typed in is true. Nothing typed in is defaulted to false.
{   
    $result = trim(fgets(STDIN));

    return $upper ? strtoupper($result) : $result;
}   //When user inputs, if it's true, make sure to capitalize it, not, just give the input
    //this will always make sure the input is capital though
//================================================================
function sort_items($items) {
       
    echo '(A)-Z, (Z)-A, (O)rder Entered, (R)everse order entered :';
       
    $input = get_input(true);

    if ($input == 'A'){
        asort($items);
    }elseif($input == 'Z'){
        arsort($items); 
    }elseif($input == 'O') {
        ksort($items);
    }elseif ($input == 'R') {
        krsort($items);
    }
    return $items;
}
//==================================================================
// function open() //Use if you want to use default file 'list.txt'
// {
//     $filename = '/vagrant/todo_list/data/list.txt';
//     $filesize = filesize($filename);
//     $read = fopen($filename, 'r');
//     $fileString = fread($read, $filesize);
//     $file = explode("\n", $fileString);
//         return $file;
//         fclose($file);
//}
function open($fileName)//Use to import from typed in file 
{   
    $filename = $fileName;
    $filesize = filesize($filename);
    $read = fopen($filename, 'r');
    $fileString = fread($read, $filesize);
    $file = explode("\n", $fileString);
        return $file;
        fclose($file);
}

//===================================================================
do 
{
    // Echo the list produced by the function
    echo list_items($items);

    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen, (Q)uit : ';

    // Get the input from user
    $input = get_input(TRUE);

    // Check for actionable input
    if ($input == 'N') 
    {
        echo 'Enter item: ';
        
        $input = get_input();
        echo "Would you like to add to the (B)eginning or the (E)nd?";
        
        $location = get_input(TRUE);
        if ($location == 'B') 
        {
            array_unshift($items, $input);
        }   //Puts item at beginning of list
        else 
        {
            array_push($items, $input);
        }   //Puts item at end of list
        
    } elseif ($input == 'R') {
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        $key= $key - 1;
        unset($items[$key]);
        $items = array_values($items);
    } elseif ($input == 'S') {
        $items = sort_items($items);
    } elseif ($input == 'F') {
        array_shift($items);
    } elseif ($input == 'L') {
        array_pop($items);
    } elseif ($input == 'O') {
        echo "File to use: ";
        $file = get_input();
        $content = open($file);
        $items = array_merge($items,$content);
    }
  
// Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);