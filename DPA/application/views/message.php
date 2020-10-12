<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
</style>
</head>
<body>

<h4>Please Find Below Attached Invoice and Dispatch Details </h4>
<table>
  <tr>
    <th>Date Of Dispatch</th>
    <td>{{dispatch}}</td>
  </tr>
  <tr>
    <th>Due Date</th>
    <td>{{duedate}}</td>
  </tr>
  <tr>
    <th>Transport</th>
    <td>{{transport}}</td>
  </tr> 
  <tr>
    <th>Freight Charges</th>
    <td>Rs.{{fright}}</td>
  </tr>
</table>

</body>
</html>
