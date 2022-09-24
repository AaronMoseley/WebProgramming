<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Munshn Lunshn
		</title>

		<style>
			.highlighted {background-color:yellow;}
			.normalText {font-weight:normal;}
			.tableElement {text-align:center;}
			.green {color:green;}
			.red {color:red;}
			.bold {font-weight:bold;}
			.table {background-color:beige; border:1px solid black;}

			#inedible {border: 2px solid green;}
			#poisonous {border-top: 2px solid red; border-bottom: 2px solid red; border-left: 2px solid blue; border-right: 2px solid blue;}
		</style>
	</head>

	<body>
		<h1>
			Welcome to the High Times Munshn Lunshn &#x2122; !
		</h1>

		<h4 class="normalText">
		All our clients are served right!<br>
		<span class="highlighted">This website is under construction, as is our cafe.</span>
		</h4>

		<h2>	
			See the menu
		</h2>

		<h3>
			Click on a word for details
		</h3>

		<table class="table">
			<form method="POST" action="cafe-2.php">
			<tr>
				<td class="tableElement">
					<input type="submit" name="buttonParam" value="snacks">
				</td>
		
				<td class="tableElement">
					&#x1F34E;
				</td>

				<td class="tableElement">
					<input type="submit" name="buttonParam" value="drinks">
				</td>

				<td class="tableElement">
					&#x1F378;
				</td>

				<td class="tableElement">
					<input type="submit" name="buttonParam" value="mains">
				</td>

				<td class="tableElement">
					&#x1F357;
				</td>
			</tr>

			<tr>
				<td class="tableElement">
					<input type="submit" name="buttonParam" value="desserts">
				</td>

				<td class="tableElement">
					&#x1F382;
				</td>

				<td class="tableElement">
					<input type="submit" name="buttonParam" value="for kids">
				</td>

				<td class="tableElement">
					&#x1F37C;
				</td>

				<td class="tableElement">
					<input type="button" name="buttonParam" value="for pets">
				</td>

				<td class="tableElement">
					&#x1F415;
				</td>
			</tr>

			<tr>
				<td class="tableElement">
					<input type="submit" name="buttonParam" value="takeout">
				</td>

				<td class="tableElement">
					&#x1F355;
				</td>

				<td id="inedible" class="tableElement">
					<input type="submit" name="buttonParam" value="inedible">
				</td>

				<td class="tableElement">
					&#x1F388;
				</td>

				<td id="poisonous" class="tableElement">
					<input type="submit" name="buttonParam" value="poisonous">
				</td>

				<td class="tableElement">
					&#x2620;
				</td>
			</tr>
			</form>
		</table>


		
			<?php
			if(count($_REQUEST) > 0 && $_REQUEST['buttonParam'] != "for pets")
			{ ?>
			<h2>Details about 
			<?php
			echo htmlspecialchars($_REQUEST['buttonParam']);
			?></h2>
				
				<?php
				$servername = "mysql.cs.uky.edu";
				$user = "ajmo276";
				$pass = "u2499774";
				$connection = new mysqli($servername, $user, $pass, $user);

				if($connection->connect_error)
				{
					die("Connection failed: " . $connection->connect_error);
				}

				$sql = "SELECT category, item, description, price FROM menu";

				if($_REQUEST['buttonParam'] != 'for pets')
				{
				
				$sql2 = "SELECT category, number FROM accesses";

				$result2 = $connection->query($sql2);
				while($row = $result2->fetch_assoc())
				{
					if($row["category"] == $_REQUEST['buttonParam'])
					{
						$newSQL = "UPDATE accesses SET number = number + 1 WHERE category = '".$_REQUEST['buttonParam']."'";
						$connection->query($newSQL);
						?>
						<p class="red">You have requested this information
						<?php
							echo $row["number"] + 1;
						?>
							times</p><?php
					}
				}
				}				
			?> 
			<table class="table">
			<tr> <td class="bold">Item</td> <td class="bold">Description</td> <td class="bold">Price</td> </tr>
			<?php
				if($_REQUEST['buttonParam'] == 'snacks') {
				$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "snacks")
					{
						?>
						<tr>
							<td>
								<?php echo $row["item"];?>
							</td>

							<td>
                                                                <?php echo $row["description"];?>
                                                        </td>

							<td>$<?php echo $row["price"];?>
                                                        </td>
						</tr>
						<?php
					}
				}		
			}
			if($_REQUEST['buttonParam'] == 'drinks') {
				$result = $connection->query($sql);
                                while($row = $result->fetch_assoc())
                                {
                                        if($row["category"] == "drinks")
                                        {
                                                ?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

                                                        <td>
                                                                <?php echo $row["description"];?>
                                                        </td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
			}
			if($_REQUEST['buttonParam'] == 'mains') { 
				$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "mains")
					{
						?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

                                                        <td>
                                                                <?php echo $row["description"];?>
                                                        </td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                	}
			if($_REQUEST['buttonParam'] == 'desserts') { 
				$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "desserts")
					{
						?>
						<tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

							<td>
								<?php echo $row["description"];?>
						        </td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                	}
			if($_REQUEST['buttonParam'] == 'for kids') { 
                        	$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "for kids")
					{
						?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

                                                        <td>
                                                                <?php echo $row["description"];?>
                                                        </td>

							<td>$<?php echo $row["price"];?>
							</td>
						</tr>
						<?php
					}
				}
                	}
			if($_REQUEST['buttonParam'] == 'takeout') { 
				$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "takeout")
					{
						?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

							<td>
								<?php echo $row["description"];?>
							</td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                	}
			if($_REQUEST['buttonParam'] == 'inedible') { 
                        	 $result = $connection->query($sql);
				 while($row = $result->fetch_assoc())
				 {
					if($row["category"] == "inedible")
					{
						?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

                                                        <td>
                                                                <?php echo $row["description"];?>
                                                        </td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                  	}
			if($_REQUEST['buttonParam'] == 'poisonous') { 
                        	$result = $connection->query($sql);
				while($row = $result->fetch_assoc())
				{
					if($row["category"] == "takeout")
					{
						?>
                                                <tr>
                                                        <td>
                                                                <?php echo $row["item"];?>
                                                        </td>

                                                        <td>
                                                                <?php echo $row["description"];?>
                                                        </td>

                                                        <td>$<?php echo $row["price"];?>
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
			} ?>
			 </table>	<?php
			}
		?> 

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
</html>
