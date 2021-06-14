<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<?php
$formlink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<form action="<?php echo $formlink; ?>">
    <label for="countries">Choose a country:</label>
    <select id="countries" name="countries">
        <option value="">All Countries</option>
        <option value="212"<?php if($countryKey != null && $countryKey == '212') echo 'selected="selected"'; ?>>Morocco</option>
        <option value="251"<?php if($countryKey != null && $countryKey == '251') echo 'selected="selected"'; ?>>Ethiopia</option>
        <option value="237"<?php if($countryKey != null && $countryKey == '237') echo 'selected="selected"'; ?>>Camerron</option>
        <option value="256"<?php if($countryKey != null && $countryKey == '256') echo 'selected="selected"'; ?>>Uganda</option>
        <option value="258"<?php if($countryKey != null && $countryKey == '258') echo 'selected="selected"'; ?>>Mozambique</option>
    </select>
    <label for="valid">Valid Phone Number:</label>
    <select id="valid" name="valid">
        <option value="">All</option>
        <option value="1"<?php if($valid != null && $valid == '1') echo 'selected="selected"'; ?>>Valid</option>
        <option value="0"<?php if($valid != null && $valid == '0') echo 'selected="selected"'; ?>>Not Valid</option>
    </select>
    <input type="submit" value="Check">

</form>

<h2>Countries</h2>

<?php

if(is_array($content))
{
?>
<table style="width:100%">
    <tr>
        <th>Country</th>
        <th>State</th>
        <th>Country Code</th>
        <th>Phone Num</th>
    </tr>
    <?php
    foreach ($content as $row)
    {
        preg_match('#\((.*?)\)#', $row['phone'], $match);

    ?>
    <tr>
        <td><?php echo $row['country'];?></td>
        <td><?php echo $row['state'];?></td>
        <td><?php echo $match[1];?></td>
        <td><?php echo $row['phone'];?></td>
    </tr>
    <?php
    }

    ?>

</table>
<?php
}
else
{
?>
    <h1>There is no phone Numbers on This Countries</h1>

<?php
}

?>

</body>
</html>
