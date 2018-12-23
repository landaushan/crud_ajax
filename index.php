<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD AJAX PHP MYSQL</title>
</head>
<body>
	
	<h2>Product List</h2>

	<table style="width: 80%;text-align:left;">
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Product Desc</th>
				<th>Product Price</th>
			</tr>
		</thead>
		<tbody id="load-data-here">
			
		</tbody>
	</table>
	
	<hr>
	
	<h2>Insert Data</h2>
	<table>
		<tr>
			<td>Product Name</td>
			<td>:</td>
			<td><input type="text" name="productName"></td>
		</tr>
		<tr>
			<td>Product Description</td>
			<td>:</td>
			<td><input type="text" name="productDescription"></td>
		</tr>
		<tr>
			<td>Product Price</td>
			<td>:</td>
			<td><input type="text" name="productPrice"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><span id="message-error" style="color:red"></span></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><button onclick="insertData()">Insert Data</button></td>
		</tr>
	</table>

	<script src="js/jquery.min.js"></script>

	<script>
		
		//Load data
		loadData();

		// membuat fungsi Insert Data
		function insertData(){
			// mengambil falue dari input
			var productName        = $("[name='productName']").val();
			var productDescription = $("[name='productDescription']").val();
			var productPrice       = $("[name='productPrice']").val();

			$.ajax({
				type : "POST",
				data : {productName: productName,productDescription: productDescription, productPrice:productPrice },
				url : "doInsert.php",
				success : function(result){
					//parsing json menjadi object
					var resultObj = JSON.parse(result);
					// mengambil html utk dijadikan handler
					var dataHandler = $("#message-error");

					// menampilkan pesan
					dataHandler.html(resultObj.message);

					// meng-load data ulang / refresh data setelah di tambahkan
					loadData();

					// mengkosongkan input
					var productName        = $("[name='productName']").val("");
					var productDescription = $("[name='productDescription']").val("");
					var productPrice       = $("[name='productPrice']").val("");

				}
			});
		}

		// membuat fungsi Load Data
		function loadData(){
			// mengambil html utk dijadikan handler
			var dataHandler = $("#load-data-here");
			// mengkosongkan data handler agar tidak tertimpa saat refresh data
			dataHandler.html("");
			$.ajax({
				type : "GET",
				data : "",
				url : "doGetData.php",
				success : function(result){
					//parsing json menjadi object
					var resultObj = JSON.parse(result);

					// menampilkan data 
					$.each(resultObj,function(key,val){

						var newRow = $("<tr>");
						newRow.html("<td>"+val.productID+"</td><td>"+val.productName+"</td><td>"+val.productDescription+"</td><td>"+val.productPrice+"</td>"+"<td><button>Select</button></td>");

						dataHandler.append(newRow);

					});
				}
			});
		}
	</script>	
</body>
</html>