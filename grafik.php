<html>
<head>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script type="text/javascript" src="js/jquery.fusioncharts.js"></script>
</head>
<body>
<center>
<table id="grafik" border="1" align="center">
<tr> <th>&nbsp;</th>
<th>2009</th>
<th>2010</th>
<th>2011</th>
</tr>
<tr> <td>Product 1</td>
<td>25</td>
<td>35</td>
<td>35</td>
</tr>
<tr> <td>Product 2</td>
<td>21</td>
<td>35</td>
<td>45</td> </tr>
<tr>
  <td>Product 3</td>
  <td>33</td>
  <td>34</td>
  <td>53</td>
  </tr>
</table>
<script type="text/javascript">
$('#grafik').convertToFusionCharts({
swfPath: "js/",
type: "MSColumn3D",
data: "#grafik",
width:"500",
height:"400"
});
</script>
</center>
</body>
</html>