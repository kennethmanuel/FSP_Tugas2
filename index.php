<?php
	session_start();
	if(isset($_POST['role']))
	{
		$role = $_POST['role'];		
		$_SESSION['role'] = $role;						
	}
	else
	{
		if(!isset($_SESSION['role']))
		{
			header('location:login.php');
		}	
		else
		{
			$role = $_SESSION['role'];
		}		
	}	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>title1</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/variable_path.js"></script>
    <style>	
        table,
        tr,
        td {
            border: 1px solid black;
        }
        @media (max-width: 500px){
        	body{
    			padding: 0px; 
    			margin: 0px;
    		}
        }        
    </style>
</head>

<!-- Logic: 
1. Dapetin role user (x / o)
2. Dapetin state of the board
3. Show state of the board
4. Disable button yang bukan milik user
5. Kalo user klik button (show gambar sesuai role user)
    - Update array state of the board
    - Update state of turn
6. Ganti state of the turn -->


<body>
	<div id = "container" style="text-align: center;">
		<h1 > Tic Tac Toe</h1>
		<?php	
			
			echo "<div style = 'text-align:center;'><h3>My Role : $role</h3></div>";
		?>
		<div>Player1 (Circle) <span id="turn_circle">&larr;</span></div>
    	<div>Player2 (Cross) <span id="turn_cross" hidden>&larr;</span></div>     	
		<div id="containertable">
			<table style="margin-left: auto;margin-right: auto;">
        	<tr>
            	<td>
                	<button id="1" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="" hidden>
                	</button>
            	</td>
            	<td>
                	<button id="2" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="3" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
        	<tr>
            	<td>
                	<button id="4" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="5" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="6" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
        	<tr>
            	<td>
                	<button id="7" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="8" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="9" class="button_board">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
    	</table>
		</div>
    	
    	<!-- <p id="textku">For debug</p> -->
    	<h1 hidden>The winner is None</h1>
    	<button id="restart">Restart</button>
	</div>    
</body>

<script>
    var role = '<?php echo $role ?>';
    var last_turn = "cross";
    var stateOfBoard = ["none", "none", "none",
        "none", "none", "none",
        "none", "none", "none"
    ];
    var stateOfBoard_json = "";

    $(document).ready(function() {    	
        for (let i = 1; i < stateOfBoard.length + 1; i++) {
            $('#' + i).children(".none").show();
        }

        $('.button_board').click(function() {
            if (last_turn !== role) {
                last_turn = role;
                $(this).children('*').hide();
                $(this).children("." + role).show();
                if (role == "circle") {
                    stateOfBoard[this.id - 1] = "o";
                  
                } else {
                    stateOfBoard[this.id - 1] = "x";
                }
                stateOfBoard_json = JSON.stringify(stateOfBoard);
                $.post(ajax_boardState, {
                    stateOfBoard: stateOfBoard_json,
                    role: role
                }).done(function(data_dr_server) {
                    // $("#textku").text(data_dr_server);
                });

            }
        });

        setInterval(function() {
            $.post(ajax_updateBoard, {}).done(function(data_dr_server) {
                $("#textku").text(data_dr_server);
                array_data_dr_server = data_dr_server.split("//");
                stateOfBoard = $.parseJSON(array_data_dr_server[0]);
                last_turn = array_data_dr_server[1];

                if(last_turn == "circle"){
                	$('#turn_circle').hide();
                    $('#turn_cross').show();
                }
                else{
                	$('#turn_circle').show();
                    $('#turn_cross').hide();
                }


                for (let i = 1; i < stateOfBoard.length + 1; i++) {
                    if (stateOfBoard[i - 1] == "o") {
                        $('#' + i).children("*").hide();
                        $('#' + i).children(".circle").show();
                    } else if (stateOfBoard[i - 1] == "x") {
                        $('#' + i).children("*").hide();
                        $('#' + i).children(".cross").show();
                    } else {
                        $('#' + i).children("*").hide();
                        $('#' + i).children(".none").show();
                    }
                }

                if ((stateOfBoard[0] === stateOfBoard[1]) && (stateOfBoard[1] === stateOfBoard[2]) && (stateOfBoard[1] != "none") ||
                    (stateOfBoard[3] === stateOfBoard[4]) && (stateOfBoard[4] === stateOfBoard[5]) && (stateOfBoard[4] != "none") ||
                    (stateOfBoard[6] === stateOfBoard[7]) && (stateOfBoard[7] === stateOfBoard[8]) && (stateOfBoard[7] != "none") ||
                    (stateOfBoard[0] === stateOfBoard[3]) && (stateOfBoard[3] === stateOfBoard[6]) && (stateOfBoard[3] != "none") ||
                    (stateOfBoard[1] === stateOfBoard[4]) && (stateOfBoard[4] === stateOfBoard[7]) && (stateOfBoard[4] != "none") ||
                    (stateOfBoard[2] === stateOfBoard[5]) && (stateOfBoard[5] === stateOfBoard[8]) && (stateOfBoard[5] != "none") ||
                    (stateOfBoard[0] === stateOfBoard[4]) && (stateOfBoard[4] === stateOfBoard[8]) && (stateOfBoard[4] != "none") ||
                    (stateOfBoard[2] === stateOfBoard[4]) && (stateOfBoard[4] === stateOfBoard[6]) && (stateOfBoard[4] != "none")
                ) {
                    $("h1").text("The winner is " + last_turn);
                    $("h1").show();
                } else {
                    $("h1").hide();
                }

                //$("#textku").text(data_dr_server);
                // $("#textku").text(stateOfBoard);

            })
        }, 2000);

        $('input').click(function() {
            role = $(this).val();
        });

        $('#restart').click(function() {
            $("h1").hide();
            role = '<?php echo $role ?>';
            last_turn = "cross";
            window.alert("Role = " + role +  " last_turn = " + last_turn);
            stateOfBoard = ["none", "none", "none",
                "none", "none", "none",
                "none", "none", "none"
            ];
            stateOfBoard_json = JSON.stringify(stateOfBoard);
            $.post(ajax_boardState, {
                stateOfBoard: stateOfBoard_json,
                role: last_turn
            }).done(function(data_dr_server) {
                // $("#textku").text(data_dr_server);
            });
        })

    });
</script>

</html>