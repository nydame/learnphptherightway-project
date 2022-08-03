<?php 
declare( strict_types=1 );

// print_r( $data );
// echo '<br>';
// echo 'Total In: ' . $total_in;
// echo '<br>';
// echo 'Total Out: ' . $total_out;
// echo '<br>';
// echo 'Total: ' . $total;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transactions</title>
  <style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    border: 1px solid #dddddd;
    padding: 1em;
  }

  tr:nth-child(2n) {
    background-color: #dddddd;
  }

  tr.first-total {
    border-top: 2px solid #333333;
  }

  tr.total {
    background-color: #cccccc;
    font-weight: bold;
  }

  .credit {
    color: green;
  }

  .debit {
    color: red;
  }

  td:last-child {
    text-align: right;
  }
  </style>
</head>

<body>
  <h1>Transactions</h1>
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Check</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $data as $row ) : 
      // if first character of the amount is a '-', then class is 'debit'
      $transaction_type = $row[3][0] === '-' ? 'debit' : 'credit';
      ?>
      <tr>
        <td><?php echo formatted_date($row[0]); ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td class="<?php echo $transaction_type; ?>"><?php echo $row[3]; ?></td>
      </tr>
      <?php endforeach; ?>
      <!-- list totals at bottom -->
      <tr class="total first-total">
        <td colspan="3">Total Credits</td>
        <td class="credit"><?php echo floats_to_dollars($total_in); ?></td>
      </tr>
      <tr class="total">
        <td colspan="3">Total Debits</td>
        <td class="debit"><?php echo floats_to_dollars($total_out); ?></td>
      </tr>
      <tr class="total">
        <td colspan="3">Balance</td>
        <td class="credit"><?php echo floats_to_dollars($total); ?></td>
      </tr>
    </tbody>
  </table>
</body>

</html>