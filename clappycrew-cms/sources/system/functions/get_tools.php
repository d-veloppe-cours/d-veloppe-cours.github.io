<?php

function get_ip()

{
    if(!empty($_SERVER['HTTP_CLIENT_IP']))

    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    else

    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))

    {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    else

    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    return ($ip);
}

function get_views()

{
  $views = 0;
  if (file_exists('./sources/views'))
  {
    $counter_file = fopen('./sources/views', 'r+');
    $views = fgets($counter_file);
    trim($views,"\n");
    if (!is_int($views))
    {
      $views = 0;
    }
  }

  else

  {
    $counter_file = fopen('./sources/views', 'a+');
  }
  if (!isset($_SESSION["view_added"]))

  {
    $_SESSION["view_added"] = true;
    $views++;
    fputs($counter_file, $views);
  }
  fclose($counter_file);
  return($views);
}

function console_log(string $new_log)

{
    if (isset($_SESSION['logs']))

    {
      $_SESSION['logs'] = $_SESSION['logs'] . '\n' . $new_log;
    }

    else

    {
      $_SESSION['logs'] = $new_log;
    }
}

function debug()

{
    if (isset($_SESSION['logs']))

    {
      echo '<script> console.log(`' . $_SESSION['logs'] . '`); </script>';
      unset($_SESSION['logs']);
    }
}

function print_error(string $error)

{
    echo '<p class="text-light-red"> '. $error .' </p>';
}

function contains_non_ascii(string $string)

{
  return preg_match('/[^\x20-\x7f]/', $string);
}