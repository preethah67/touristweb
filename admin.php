<?php
include_once('junk.php');
$que="SELECT * FROM `customer`";
$result = mysqli_query($db, $que);
$que1="SELECT * FROM `travel_agent`";
$result1 = mysqli_query($db, $que1);
$que2="SELECT * FROM `places`";
$result2 = mysqli_query($db, $que2);
$que3="SELECT * FROM `hotels`";
$result3 = mysqli_query($db, $que3);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<title>Admin Page</title>
	<style>
		.container .addp-workspace{
			width: 70vw;
			height: 80vh;
			float: right;
		}
		.container .addp-workspace .insert-pform{
			display: none; 
			width: 30vw;
			height: 50vh;
			margin: 10% 30%;
			text-align: center;
		}
		.container .addp-workspace .insert-pform input{
			margin: 20px 0px;
		}
	</style>
</head>
<body>
	<div class="main">
	    <ul>
	      <ul class="list">
	        <li class="logo"><a href="mainPage.html"><img src="earth-globe.png" alt="Logo" style="width:180px;height:180px"></a></li>
	      </ul>
	    </ul>
	</div>
	<div class="container">
		<div class="menu-list">
			<button onclick="showhide('c-op')" id="c-op">Customer Operations</button>
			<button onclick="showhide('a-op')" id="a-op">Agent Operations</button>
			<button onclick="showhide('p-op')" id="p-op">Places Operations</button>
			<button onclick="showhide('h-op')" id="h-op">Hotels Operations</button>
			<button onclick="showDetails('v1')" id="v1">View Customers</button>
			<button onclick="showDetails('v2')" id="v2">View Agents</button>
			<button onclick="showDetails('v3')" id="v3">View Places</button>
			<button onclick="showDetails('v4')" id="v4">View Hotels</button>
		</div>
		<div class="addp-workspace">
			<div class="cust-op" id="cust-op" style="display: block;">
				<button onclick="showForm('ins-c')" id="ins-c">Insert New Customer</button>
				<button onclick="showForm('del-c')" id="del-c">Delete Customer</button>
				<div class="insert-cform" id="ins-form">
					<h1>Insert Customer</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="id" placeholder="Customer ID" required><br>
						<input type="text" name="fname" placeholder="First Name" required><br>
						<input type="text" name="lname" placeholder="Last Name" required><br>
						<input type="email" name="email" placeholder="Email" required><br>
						<input type="text" name="city" placeholder="City" required><br>
						<input type="text" name="phone" placeholder="Phone" required><br>
						<input type="submit" name="in-submit-c">
					</form>
				</div>
				<div class="delete-cform" id="del-form" style="display: none;">
					<h1>Delete Customer</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="id" placeholder="Customer ID" required><br>
						<input type="text" name="fname" placeholder="First Name" required><br>
						<input type="submit" name="de-submit-c">
					</form>
				</div>
			</div>
			<div class="agn-op" id="agn-op" style="display: none;">
				<button onclick="showForm('ins-a')" id="ins-a">Insert New Agent</button>
				<button onclick="showForm('del-a')" id="del-a">Delete Agent</button>
				<div class="insert-aform" id="ins-form2" style="display: none;">
					<h1>Insert Agent</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="aid" placeholder="Agent ID" required><br>
						<input type="text" name="afname" placeholder="Agent Name" required><br>
						<input type="email" name="aemail" placeholder="Agent Email" required><br>
						<input type="text" name="aphone" placeholder="Agent Phone" required><br>
						<input type="text" name="acity" placeholder="Agent City" required><br>
						<input type="submit" name="in-submit-a">
					</form>
				</div>
				<div class="delete-aform" id="del-form2" style="display: none;">
					<h1>Delete Agent</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="aid" placeholder="Agent ID" required><br>
						<input type="text" name="afname" placeholder="Agent Name" required><br>
						<input type="submit" name="de-submit-a">
					</form>
				</div>
			</div>
			<div class="plc-op" id="plc-op" style="display: none;">
				<button onclick="showForm('ins-p')" id="ins-p">Insert New Place</button>
				<button onclick="showForm('del-p')" id="del-p">Delete Place</button>
				<div class="insert-pform" id="ins-form3" style="display: none;">
					<h1>Insert Place</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="pid" placeholder="Place ID" required><br>
						<input type="text" name="pname" placeholder="Place Name" required><br>
						<input type="text" name="pcity" placeholder="Place City" required><br>
						<input type="submit" name="ins-submit-p">
					</form>
				</div>
				<div class="delete-pform" id="del-form3" style="display: none;">
					<h1>Delete Place</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="pid" placeholder="Place ID" required><br>
						<input type="text" name="pname" placeholder="Place Name" required><br>
						<input type="submit" name="de-submit-p">
					</form>
				</div>
			</div>
			<div class="htl-op" id="htl-op" style="display: none;">
				<button onclick="showForm('ins-h')" id="ins-h">Insert New Hotel</button>
				<button onclick="showForm('del-h')" id="del-h">Delete Hotel</button>
				<div class="insert-hform" id="ins-form4" style="display: none;">
					<h1>Insert Hotel</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="hid" placeholder="Hotel ID" required><br>
						<input type="text" name="hname" placeholder="Hotel Name" required><br>
						<input type="text" name="hphone" placeholder="Hotel Phone" required><br>
						<input type="text" name="hcity" placeholder="Hotel City" required><br>
						<input type="submit" name="ins-submit-h">
					</form>
				</div>
				<div class="delete-hform" id="del-form4" style="display: none;">
					<h1>Delete Hotel</h1>
					<form method="POST" action="admin_op.php">
						<input type="text" name="hid" placeholder="Hotel ID" required><br>
						<input type="text" name="hname" placeholder="Hotel Name" required><br>
						<input type="submit" name="de-submit-h">
					</form>
				</div>
			</div>
			<div class="tb-container" id="tb-container" style="display: none;">
				<table class="tb" border="1" style="color: black">
					<tr>
						<th>Customer ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>City</th>
						<th>Phone No</th>
					</tr>
					<?php
					while ($rows=mysqli_fetch_assoc($result)) {
					?>
					<tr>
						<td><?php echo $rows['id']; ?></td>
						<td><?php echo $rows['fname']; ?></td>
						<td><?php echo $rows['lname']; ?></td>
						<td><?php echo $rows['email']; ?></td>
						<td><?php echo $rows['city']; ?></td>
						<td><?php echo $rows['phone']; ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="agent-container" id="agent-container" style="display: none;">
				<table class="tb" border="1" style="color: black">
					<tr>
						<th>Agent ID</th>
						<th>Agent Name</th>
						<th>Email</th>
						<th>Phone No</th>
						<th>City</th>
					</tr>
					<?php
					while ($rows1=mysqli_fetch_assoc($result1)) {
					?>
					<tr>
						<td><?php echo $rows1['aid']; ?></td>
						<td><?php echo $rows1['afname']; ?></td>
						<td><?php echo $rows1['aemail']; ?></td>
						<td><?php echo $rows1['aphone']; ?></td>
						<td><?php echo $rows1['acity']; ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="place-container" id="place-container" style="display: none;">
				<table class="tb" border="1" style="color: black">
					<tr>
						<th>Place ID</th>
						<th>Place Name</th>
						<th>City</th>
					</tr>
					<?php
					while ($rows2=mysqli_fetch_assoc($result2)) {
					?>
					<tr>
						<td><?php echo $rows2['pid']; ?></td>
						<td><?php echo $rows2['pname']; ?></td>
						<td><?php echo $rows2['pcity']; ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="hotel-container" id="hotel-container" style="display: none;">
				<table class="tb" border="1" style="color: black">
					<tr>
						<th>Hotel ID</th>
						<th>Hotel Name</th>
						<th>Phone No</th>
						<th>City</th>
					</tr>
					<?php
					while ($rows3=mysqli_fetch_assoc($result3)) {
					?>
					<tr>
						<td><?php echo $rows3['hid']; ?></td>
						<td><?php echo $rows3['hname']; ?></td>
						<td><?php echo $rows3['hphone']; ?></td>
						<td><?php echo $rows3['hcity']; ?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>

	<script type="text/javascript">
    function showhide(clickedId){
        // Hide all main operation divs first
        document.getElementById("cust-op").style.display = "none";
        document.getElementById("agn-op").style.display = "none";
        document.getElementById("plc-op").style.display = "none";
        document.getElementById("htl-op").style.display = "none";
        document.getElementById("tb-container").style.display = "none";
        document.getElementById("agent-container").style.display = "none";
        document.getElementById("place-container").style.display = "none";
        document.getElementById("hotel-container").style.display = "none";

        // Show the relevant div based on clickedId
        if (clickedId === 'c-op'){
            document.getElementById("cust-op").style.display = "block";
        } else if (clickedId === 'a-op'){
            document.getElementById("agn-op").style.display = "block";
        } else if (clickedId === 'p-op'){
            document.getElementById("plc-op").style.display = "block";
        } else if (clickedId === 'h-op'){
            document.getElementById("htl-op").style.display = "block";
        }
    }

    function showForm(clickedBtnId){
        // Hide all specific forms first (adjust as needed if forms overlap)
        document.getElementById("ins-form").style.display = "none";
        document.getElementById("del-form").style.display = "none";
        document.getElementById("ins-form2").style.display = "none";
        document.getElementById("del-form2").style.display = "none";
        document.getElementById("ins-form3").style.display = "none";
        document.getElementById("del-form3").style.display = "none";
        document.getElementById("ins-form4").style.display = "none";
        document.getElementById("del-form4").style.display = "none";

        // Show the parent operation div first, then the specific form
        if (clickedBtnId === 'ins-c'){
            document.getElementById("cust-op").style.display = "block"; // Ensure parent is visible
            document.getElementById("ins-form").style.display = "block";
        } else if (clickedBtnId === 'del-c'){
            document.getElementById("cust-op").style.display = "block";
            document.getElementById("del-form").style.display = "block";
        } else if (clickedBtnId === 'ins-a'){
            document.getElementById("agn-op").style.display = "block";
            document.getElementById("ins-form2").style.display = "block";
        } else if (clickedBtnId === 'del-a'){
            document.getElementById("agn-op").style.display = "block";
            document.getElementById("del-form2").style.display = "block";
        } else if (clickedBtnId === 'ins-p'){
            document.getElementById("plc-op").style.display = "block";
            document.getElementById("ins-form3").style.display = "block";
        } else if (clickedBtnId === 'del-p'){
            document.getElementById("plc-op").style.display = "block";
            document.getElementById("del-form3").style.display = "block";
        } else if (clickedBtnId === 'ins-h'){
            document.getElementById("htl-op").style.display = "block";
            document.getElementById("ins-form4").style.display = "block";
        } else if (clickedBtnId === 'del-h'){
            document.getElementById("htl-op").style.display = "block";
            document.getElementById("del-form4").style.display = "block";
        }
    }

    function showDetails(clickedBtnId){
        // Hide all operation and form divs first
        document.getElementById("cust-op").style.display = "none";
        document.getElementById("agn-op").style.display = "none";
        document.getElementById("plc-op").style.display = "none";
        document.getElementById("htl-op").style.display = "none";
        document.getElementById("ins-form").style.display = "none";
        document.getElementById("del-form").style.display = "none";
        document.getElementById("ins-form2").style.display = "none";
        document.getElementById("del-form2").style.display = "none";
        document.getElementById("ins-form3").style.display = "none";
        document.getElementById("del-form3").style.display = "none";
        document.getElementById("ins-form4").style.display = "none";
        document.getElementById("del-form4").style.display = "none";
        document.getElementById("tb-container").style.display = "none";
        document.getElementById("agent-container").style.display = "none";
        document.getElementById("place-container").style.display = "none";
        document.getElementById("hotel-container").style.display = "none";


        // Show the relevant table container based on clickedBtnId
        if (clickedBtnId === 'v1'){
            document.getElementById("tb-container").style.display = "block";
        } else if (clickedBtnId === 'v2'){
            document.getElementById("agent-container").style.display = "block";
        } else if (clickedBtnId === 'v3'){
            document.getElementById("place-container").style.display = "block";
        } else if (clickedBtnId === 'v4'){
            document.getElementById("hotel-container").style.display = "block";
        }
    }
	</script>

</body>
</html>