<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

function validPart($str)
{
        //  STATIC SO ITS DEFINED ONLY ONCE
    static $categories = ['HW', 'SG', 'AP'];

        //  TRIM
    $str = trim($str);
    $chunks = explode('-', $str);

    if(sizeof($chunks) < 3) return false;

    $category    = $chunks[0];
    $wareHouse   = $chunks[1];
    $partNumber  = $chunks[2];

        //  SHORT CIRCUIT VALIDATE
    return strlen($category)   >= 2 &&
           strlen($wareHouse)  >= 2 &&
           strlen($partNumber) >= 4 &&
           ctype_alnum($partNumber) &&
           ctype_digit($wareHouse)  &&
           in_array(strtoupper($category), $categories);
}

$parts = ['AP-12-3507', '  ap-99-x109  ', 'SG-05-ab20',
          'ab-22-N250', 'SG-xx-N250', 'SG-22-250', 'SG-22-250*'];

echo '<h1>Part 1</h1>';

foreach($parts as $part)
{
    if(validPart($part))
    {
        echo "<p>$part is valid.</p>";
    }
    else
    {
        echo "<p>$part is not valid.</p>";
    }
}

  //=======================================================//
 //                        PART 2                         //
//=======================================================//

echo '<h1>Part 2</h1>';

function validPartRx($str)
{
    $str = trim($str);

    $regex = '/^(AP|SG|GW)-\d\d-[a-z0-9]{4}$/i';

    return preg_match($regex, $str);
}

foreach($parts as $part)
{
    if(validPartRx($part))
    {
        echo "<p>$part is valid.</p>";
    }
    else
    {
        echo "<p>$part is not valid.</p>";
    }
}