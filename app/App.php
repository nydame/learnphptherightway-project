<?php 
declare( strict_types=1 );

include APP_PATH . 'utils.php';

$data = [];
$total_in = $total_out = $total = 0;

// find all the files in transaction_files directory
$transaction_files = scandir( FILES_PATH );

// process files
if ( ! empty( $transaction_files ) ) {
  // loop through all the files in transaction_files directory
  foreach ( $transaction_files as $file ) {
    // if the file is not a directory, stop
    if ( is_dir( $file ) ) continue;
    // process the file
    process_file( $file );
  }
}

function process_file(string $file) {
  global $data, $total_in, $total_out, $total;
  if ( ! file_exists( FILES_PATH . $file ) ) {
    trigger_error( "File $file does not exist", E_USER_WARNING );
  }
  // open the file
  $file_handle = fopen( FILES_PATH . $file, 'r' );
  // read the file line-by-line using fgetcsv()
  while ( ( $line = fgetcsv( $file_handle ) ) !== false ) {
    // skip the header
    if ( $line[0] === 'Date' ) {
      continue;
    }
    // add the line to the data array
    $data[] = $line;
    // update totals
    $total_in += get_total_in($line[3]);
    $total_out += get_total_out($line[3]);
  }
  // close the file
  fclose( $file_handle );
  // get grand total
  $total += $total_in + $total_out;
}

function get_total_in(string $entry): float|int {
  // first extract float from amount in dollars
  $amount = dollars_to_float( $entry );
  return $amount > 0 ? $amount : 0;

}

function get_total_out(string $entry): float|int {
  // first extract float from amount in dollars
  $amount = dollars_to_float( $entry );
  return $amount < 0 ? $amount : 0;

}