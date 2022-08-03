<?php 

function dollars_to_float(string $dollars): float {
  // remove dollar sign and commas
  $dollars = str_replace( ['$', ','], '', $dollars );
  // convert to float
  return (float) $dollars;
}

function floats_to_dollars( float $number ): string {
  // convert to string
  $dollars = (string) $number;
  if ($dollars[0] !== '-') {
    $dollars = '$' . $dollars;
  } else {
    $dollars = '-$' . substr( $dollars, 1 );
  }
  // add dollar sign and commas
  return $dollars;
}

function formatted_date(string $date): string {
  $date_obj = date_create($date);
  return date_format( $date_obj, 'M j, Y');
}