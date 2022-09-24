<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, shrink-to-fit=no">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<title>
			Munshn Lunshn
		</title>

		<style>
			@font-face {font-family: AntiqueHeritage; src: url('http://cs.uky.edu/~ajmo276/Homework4/AntiqueHeritage.otf')}

			h2 {font-family:AntiqueHeritage; margin-top:30px; margin-bottom:30px;}			

			.highlighted {background-color:yellow;}
                        .normalText {font-weight:normal;}
                        .tableElement {text-align:center;}
                        .green {color:green;}
                        .red {color:red;}
                        .bold {font-weight:bold;}
			.centered {text-align:center;}

			#BackgroundImage {width: 100%; height: 100%; position:fixed; z-index: -1;}
			#MainMenu {margin-top: 33px;}
			#MenuHead {text-align: center;}
                        #inedible {border: 2px solid green;}
			#poisonous {border-top: 2px solid red; border-bottom: 2px solid red; border-left: 2px solid blue; border-right: 2px solid blue;}
		</style>
	</head>

	<body>
	<div id="BackgroundImage">
	<img src="http://cs.uky.edu/~ajmo276/Homework4/WebsiteBackground.jpg" width="100%" height="100%">
	</div>
	<div class="container-fluid">
		<div class="centered">
		<h1>
			Welcome to the High Times Munshn Lunshn &#x2122; !
		</h1>

		</br>

		<h4 class="normalText">
		All our clients are served right!<br>

		<!-- Clicking this span calls an easter egg function -->
		<span class="highlighted" onclick='easterEgg(this)'>This website is under construction, as is our cafe.</span>
		</h4>

		</br>

		<h2>	
			See the menu
		</h2>

		<h3>
			Click on a word for details
		</h3>
		</div>

		<div class="row">

		</br>
		<div class="col-lg-7" id="MainMenu">
		<table class="table table-striped table-bordered">
			<h1 id="MenuHead">Menu Categories</h1>
			</br>
			</br>

			<tr>
				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("snacks")'>
					<p>snacks</p>
				</td>
		
				<td class="tableElement">
					&#x1F34E;
				</td>

				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("drinks")'>
					<p>drinks</p>
				</td>

				<td class="tableElement">
					&#x1F378;
				</td>

				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("mains")'>
					<p>mains</p>
				</td>

				<td class="tableElement">
					&#x1F357;
				</td>
			</tr>

			<tr>
				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("desserts")'>
					<p>desserts</p>
				</td>

				<td class="tableElement">
					&#x1F382;
				</td>

				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("for kids")'>
					<p>for kids</p>
				</td>

				<td class="tableElement">
					&#x1F37C;
				</td>

				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("for pets")'>
					<p>
						<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sorry: No Items">
						for pets
						</span>
					</p>
				</td>

				<td class="tableElement">
					&#x1F415;
				</td>
			</tr>

			<tr>
				<td class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("takeout")'>
					<p>takeout</p>
				</td>

				<td class="tableElement">
					&#x1F355;
				</td>

				<td id="inedible" class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("inedible")'>
					<p>inedible</p>
				</td>

				<td class="tableElement">
					&#x1F388;
				</td>

				<td id="poisonous" class="tableElement" onmouseenter='greenAndWhite(this)' onmouseleave='removeBackgdAndColor(this)' onclick='clicked("poisonous")'>
					<p>poisonous</p>
				</td>

				<td class="tableElement">
					&#x2620;
				</td>
			</tr>
		</table>
		</div>

		<div class="col-lg-5">
		<h2 id="menuLabel">
		</h2>

		<p class="red" id="numAccessed">
		</p>

		<table class="table table-striped table-bordered table-hover table-dark" id = "menu">
		</table>
		</div>

		</div>

		<?php if(count($_REQUEST) > 0 && $_REQUEST['buttonParam'] != "for pets") {?>
		<p id="json">
				<?php
				if(count($_REQUEST) > 0)
				{
				$servername = "mysql.cs.uky.edu";
				$user = "ajmo276";
				$pass = "u2499774";
				$connection = new mysqli($servername, $user, $pass, $user);

				if($connection->connect_error)
				{
					die("Connection failed: " . $connection->connect_error);
				}

				$sql1 = "SELECT category, item, description, price FROM menu";
				$sql2 = "SELECT category, number FROM accesses";
				
				$param = $_REQUEST['buttonParam'];
				
					$jsonObj = '{
							"category": "' . $param . '",
							"accesses": ';

					
					$result2 = $connection->query($sql2);
					$accesses = "";
					$sql3 = "UPDATE accesses SET number = number + 1 WHERE category = '".$param."'";
					while($row = $result2->fetch_assoc())
					{
						if($row["category"] == $_REQUEST['buttonParam'])
						{
							$accesses = $row["number"] + 1;
							$connection->query($sql3);
						}
					}
					
					$jsonObj .= $accesses . ',
									"details": [';

					$result1 = $connection->query($sql1);
					while($row1 = $result1->fetch_assoc())
					{
						if($row1["category"] == $_REQUEST['buttonParam'])
						{
							$jsonObj .= '{
									"item": "' . $row1["item"] . '",
									"description": "' . $row1["description"] . '",
									"price": ' . $row1["price"] . '
							},';
						}
					}
					
					$newJSON = rtrim($jsonObj, ",");
					$newJSON .= 		']
							}';

					echo($newJSON);
				}
			?>
		</p>
		<?php } ?>

		</br>

		<button type="button" id="tipButton" class="btn btn-success">Compute Tip</button>

		</br>
		</br>

		<input type="hidden" id="tipInput" oninput="calculateTip()">
		</input>


		<p id="tipCalculations" class="bold">
		</p>

		<h2>
			We are hiring!
		</h2>

		<h4 class="normalText">
			We are looking for employees who are
		</h4>

		<ol>
			<li>
				Reliable
			</li>

			<li>
				Prompt
			</li>

			<li>
				Friendly

				<ul>
					<li>
						Able to deal with <i>obnoxious customers</i>
					</li>

					<li>
						Able to deal with <i>critical managers</i>
					</li>

					<li>
						Able to cater to <i>the chef's whims</i>
					</li>
				</ul>
			</li>

			<li>
				<span class="green">Multi</span><span class="red">lingual</span>
			</li>

			<li class="bold">
				Healthy
			</li>
		</ol>
	</div>
	</body>

	<script
	src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous"></script>

	<script
	src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
	integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
	crossorigin="anonymous"></script>
	
	<script
	src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
	integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
	crossorigin="anonymous"></script>

		<script>
		document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (elt) {
			new bootstrap.Tooltip(elt);
		});

		function greenAndWhite(obj)
		{
			obj.style.color = 'white';
			obj.style.backgroundColor = 'green';
		}

		function removeBackgdAndColor(obj)
		{
			obj.style.color = 'black';
			obj.style.backgroundColor = 'transparent';
		}

		$('#tipButton').on('click', function(event) {
			document.querySelector('#tipButton').disabled = "true";
			document.querySelector('#tipInput').type = "number";
		});

		async function calculateTip()
		{
			if(Number(document.querySelector('#tipInput').value) != Number(document.querySelector('#tipInput').value).toFixed(2))
			{
				document.querySelector('#tipInput').value = Math.trunc(Number(document.querySelector('#tipInput').value) * 100) / 100;
			}

			if(Number(document.querySelector('#tipInput').value) < 0)
			{
				document.querySelector('#tipInput').value = 0;
			}

			let num = Number(document.querySelector('#tipInput').value);
			let fifteen = num * 1.15;
			let eighteen = num * 1.18;
			let twenty = num * 1.2;
			let twentyfive = num * 1.25;

			let htmlString = "bill: $" + num.toFixed(2) + "</br>with 15% tip: $" + fifteen.toFixed(2) + "</br>with 18% tip: $" + eighteen.toFixed(2) + "</br>with 20% tip: $" + twenty.toFixed(2) + "</br>with 25% tip: $" + twentyfive.toFixed(2) + "</br>";

			document.querySelector('#tipCalculations').innerHTML = htmlString;
		}

		async function clicked(tag)
		{
			if(tag != "for pets")
			{
			fetch('/~ajmo276/Homework3/cafe-3.php?buttonParam=' + tag).then(function (response) {
				return response.text();
			}).then(function (html) {
				let parser = new DOMParser();
				let actualHTML = parser.parseFromString(html, 'text/html');
				let obj = JSON.parse(actualHTML.querySelector('#json').innerText);

				document.querySelector("#menuLabel").innerText = "Details about " + tag;
				document.querySelector("#numAccessed").innerHTML = "You have accessed this information " + obj.accesses + " time(s)."
				let htmlString = '<thead><tr style="font-weight: bold;"><th scope="col">Item</th><th scope="col">Description</th><th scope="col">Price</th></tr></thead>';

				for(let j = 0; j < obj.details.length; j++)
				{
					htmlString += "<tr> <td>" + obj.details[j].item + "</td> <td>" + obj.details[j].description + "</td> <td>$" + obj.details[j].price.toFixed(2) + "</td> </tr>";
				}

				document.querySelector("#menu").innerHTML = htmlString;
			}).catch(function (err) {
				console.log("Error: " + err);
			});
			} else {
				document.querySelector("#menuLabel").innerText = "";
				document.querySelector("#numAccessed").innerHTML = "";
				document.querySelector("#menu").innerHTML = "";
			}
		}
		
		//This is the easter egg function
		async function easterEgg(obj)
		{
			obj.style.backgroundColor = 'green';
			obj.innerHTML = "This website is no longer under construction and can be used.";
		}
	</script>
</html>
