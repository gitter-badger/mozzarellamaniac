<?php
	function GetAllPizza(){
		//Establishing Mysql connection
		$conn = new PDO("mysql:host=localhost;dbname=pizzeria", 'root', 'godfather');
		
		$sql = "SELECT pizza_id, name, price FROM pizza";
				
		$query = $conn->query($sql);
		
		while($res = $query->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $res;
		}
		header("Content-type: application/json");
		echo json_encode($rows) . "<br /><br />";
	}
	
	function GetPizzaById($id=null){
		$id = $_GET['id'];
		if(!$id){
			echo "<script type='text/javascript'>alert('Nincs megadva pizza azonosítószám!');</script>";
		}else{
			//Establishing Mysql connection
			$conn = new PDO("mysql:host=localhost;dbname=pizzeria", 'root', 'godfather');
			
			$sql = "SELECT pizza_id, name, price FROM pizza WHERE pizza_id = $id";
			
			$sql2 = "SELECT name topping FROM topping";
			
			$query = $conn->query($sql);
			$query2 = $conn->query($sql2);
			while($res = $query2->fetch(PDO::FETCH_ASSOC)) {
					$row[] = $res;
			}
			print_r($row);
			while($res = $query->fetch(PDO::FETCH_ASSOC)) {
				$rows[] = $res;
			}
			$rows[] = $row;
			header("Content-type: application/json");
			echo json_encode($rows);
		}
	}
	GetAllPizza();
	GetPizzaById();
?>