<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="title;">
<h1> Umaporium Staff - Item Editor </h1>
</div>
<p> Use the form below to add items to the database. </p>

<ul>
<form name="itemedit" action="itemedit.php" method="POST" >
<li>Product Name</li><li><input type="text" name="pname" /></li>
<li>Product Color:</li><li><input type="text" name="pcolor" /></li>
<li>Product Desc.:</li><li><input type="text" name="pdesc" /></li>
<li>Product Category:</li><li><input type="text" name="pcategory" /></li>
<li>Sub-category (optional):</li><li><input type="text" name="psubcat" /></li>
<li>Brand:</li><li><input type="text" name="pbrand" /></li>
<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>
<php ?
$db = pg_connect("host=team8-instance-1.c9gh4dcxotkn.us-east-2.rds.amazonaws.com port=5432 dbname=postgres user=postgres password=Uma3380+");

$query = "INSERT INTO PRODUCT (p_name, color, description, category, subcategory, brand, p_stock) VALUES ('$_POST[pname]','$_POST[pcolor]',
'$_POST[pdesc]','$_POST[pcategory]','$_POST[psubcat]',
'$_POST[pbrand]', 0)";

$result = pg_query($query); 
?>