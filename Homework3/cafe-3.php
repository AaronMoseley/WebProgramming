<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Munshn Lunshn
		</title>
	</head>

	<body>
		<h1>
			Welcome to the High Times Munshn Lunshn &#x2122; !
		</h1>

		<h4 class="normalText">
		All our clients are served right!<br>

		<!-- Clicking this span calls an easter egg function -->
		<span class="highlighted" onclick='easterEgg(this)'>This website is under construction, as is our cafe.</span>
		</h4>

		<h2>	
			See the menu
		</h2>

		<h3>
			Click on a word for details
		</h3>

		<table class="table">
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
					<p>for pets</p>
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

		<h2 id="menuLabel">
		</h2>

		<p class="red" id="numAccessed">
		</p>

		<table class="table" id = "menu">
		 </table>

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
	</body>

	<script>
		document.querySelectorAll(".highlighted").forEach(el => {
				el.style.backgroundColor = 'yellow';
			})

		document.querySelectorAll(".normalText").forEach(el => {
		                el.style.fontWeight = 'normal';
				})

		document.querySelectorAll(".tableElement").forEach(el => {
		                el.style.textAlign = 'center';
				})

		document.querySelectorAll(".green").forEach(el => {
		                el.style.color = 'green';
				})

		document.querySelectorAll(".red").forEach(el => {
		                el.style.color = 'red';
				})

		document.querySelectorAll(".bold").forEach(el => {
		                el.style.fontWeight = 'bold';
				})

		document.querySelectorAll(".table").forEach(el => {
				el.style.backgroundColor = 'beige';
				el.style.border = '1px solid black';
				})

		document.querySelectorAll("#inedible").forEach(el => {
		                el.style.border = '2px solid green';
				})

		document.querySelectorAll("#poisonous").forEach(el => {
				el.style.borderTop = '2px solid red';
				el.style.borderBottom = '2px solid red';
				el.style.borderLeft = '2px solid blue';
				el.style.borderRight = '2px solid blue';
				})

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
				let htmlString = '<tr style="font-weight: bold;"><td>Item</td><td>Description</td><td>Price</td></tr>';

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
