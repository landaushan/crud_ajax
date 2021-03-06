<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD AJAX PHP MYSQL</title>
</head>
<body>
	
	<h2>Product List</h2>
	
	<input type="text" name="search" id="search">

	<table style="width: 70%;text-align:left;">
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
	
	<h2>Insert Data / Update Data</h2>
	<table>
		<tr id="product-id" style="display: none;">
			<td>Product ID</td>
			<td>:</td>
			<td><input type="text" name="productID" disabled="disabled"></td>
		</tr>
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
			<td><span id="message" style="color:red"></span></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><button onclick="insertData()">Insert Data</button> <button onclick="updateData()">Update Data</button></td>
		</tr>
	</table>

	<script src="js/jquery.min.js"></script>

	<script>
		
		//Load data
		loadData();

		$(document).ready(function(){
			var keyword = $("#search").val();

			console.log(keyword+"aaa");
		});

		// search
		$(document).on("keyup","#search",function(){
			var keyword = $(this).val();

			if(keyword == ""){

			}else {
					$.ajax({
					type : "GET",
					data : {keyword:keyword},
					url : "doGetData.php",
					success : function(result){
						//parsing json menjadi object
						var resultObj = JSON.parse(result);
						var dataHandler = $("#load-data-here");
						dataHandler.html("");
						// menampilkan data 
						$.each(resultObj,function(key,val){

							var newRow = $("<tr>");
							newRow.html("<td>"+val.productID+"</td><td>"+val.productName+"</td><td>"+val.productDescription+"</td><td>"+val.productPrice+"</td>"+"<td><button class='select-data' data-id='"+val.productID+"'>Select</button></td>"+"<td><button class='delete-data' data-id='"+val.productID+"'>Delete</button></td>");

							dataHandler.append(newRow);

						});
					}
				});
			}
		});

		// select data
		$(document).on("click",".select-data",function(){
			// mengambil nilai data-id
			var productID = $(this).data("id");
			
			$.ajax({
				type : "GET",
				data : {productID:productID},
				url : "doGetDataProduct.php",
				success : function(result){
					$("#product-id").show();
					var resultObj = JSON.parse(result);

					$("[name='productName']").val(resultObj.productName);
					$("[name='productDescription']").val(resultObj.productDescription);
					$("[name='productPrice']").val(resultObj.productPrice);
					$("[name='productID']").val(resultObj.productID);

				}
			});
		});

		// delete data
		$(document).on("click",".delete-data",function(){
			// mengambil nilai data-id
			var productID = $(this).data("id");
			
			$.ajax({
				type : "POST",
				data : {productID:productID},
				url : "doDeleteData.php",
				success : function(result){
					var resultObj = JSON.parse(result);

					loadData();
					$("#message").html(resultObj.message);



				}
			});
		});

		// membuat fungsi update data
		function updateData(){
			// mengambil valuedari input
			var productID        = $("[name='productID']").val();
			var productName        = $("[name='productName']").val();
			var productDescription = $("[name='productDescription']").val();
			var productPrice       = $("[name='productPrice']").val();

			$.ajax({
				type : "POST",
				data : {productID: productID, productName: productName,productDescription: productDescription, productPrice:productPrice },
				url : "doUpdateData.php",
				success : function(result){
					var resultObj = JSON.parse(result);

					loadData();

					$("#message").html(resultObj.message);

					var productName        = $("[name='productName']").val("");
					var productDescription = $("[name='productDescription']").val("");
					var productPrice       = $("[name='productPrice']").val("");

					$("#product-id").hide();
				}
			});
		}

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
					var dataHandler = $("#message");

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
						newRow.html("<td>"+val.productID+"</td><td>"+val.productName+"</td><td>"+val.productDescription+"</td><td>"+val.productPrice+"</td>"+"<td><button class='select-data' data-id='"+val.productID+"'>Select</button></td>"+"<td><button class='delete-data' data-id='"+val.productID+"'>Delete</button></td>");

						dataHandler.append(newRow);

					});
				}
			});
		}
	</script>	
</body>
</html>