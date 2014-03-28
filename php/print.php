<?php

function print_table($rs)
{
  if($rs instanceof ResultSet)
  {
    echo '<table class="blue"><tr>';
    //echo "<table border=\"1\" width=\"80%\"><tr>";
    $ColumnNames = $rs->getColumnNames();
    for($col = 0; $col < $rs->getRowSize(); $col++)
    {
      //echo "<th>".ora_columnname($cursor, $col)."</th>";
      echo "<th><b>";
      echo $ColumnNames[$col];
      echo "</b></th>";
    }
    echo "</tr>";

    while($rs->next())
    {
      for($col = 0; $col < $rs->getRowSize(); $col++)
        echo '<td align = "center">'.
             $rs->getCurrentValueByNr($col).'</td>';
      echo '</tr>';
    }
    echo '</table>';
  }
  else if ($rs === false)
  {
    echo 'Query Failed!';
  }
  else
  {
    echo 'Query Executed!';
  }
}

function print_rendezvous($rs)
{
  echo '<table class="blue">';
  echo '<tr><th>Title</th><th>Deadline</th><th>State</th><th>Deactivation</th></tr>';
  while($rs->next())
  {
    echo '<tr>';
    echo '<td align="center">'.$rs->getCurrentValueByNr(1).' </td>';
    echo '<td align="center">'.
         date("F j, Y, g:i a", $rs->getCurrentValueByNr(2)).'</td>';
    if ($rs->getCurrentValueByNr(3) == 'Y' ||
        ($rs->getCurrentValueByNr(3) == 'A' &&
         $rs->getCurrentValueByNr(2) >= time()) )
    echo '<td align="center">Active</td>';
    else
      echo '<td align="center">Closed</td>';
    if( $rs->getCurrentValueByNr(3) == 'A')
      echo '<td align="center">Automatic</td>';
    else
      echo '<td align="center">Manual</td>';
    echo '</tr>';
  }
  echo "</table>";
}

?>
