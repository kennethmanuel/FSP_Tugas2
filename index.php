<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>title1</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
        table,
        tr,
        td {
            border: 1px solid black;
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
	<div style="text-align: center;">
		<h1> Tic Tac Toe</h1>
		<?php	
			$role = $_POST['role'];	
			echo "<div style = 'text-align:center;'><h3>My Role : $role</h3></div>";	
		?>
		<div>Player1 (Circle) &larr;</div>
    	<div>Player2 (Cross)</div>    	
    	<table style="margin-left: auto;margin-right: auto;">
        	<tr>
            	<td>
                	<button id="1">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="" hidden>
                	</button>
            	</td>
            	<td>
                	<button id="2">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="3">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
        	<tr>
            	<td>
                	<button id="4">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="5">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="6">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
        	<tr>
            	<td>
                	<button id="7">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="8">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
            	<td>
                	<button id="9">
                    	<img class="circle" src="res/circle.png" alt="" hidden>
                    	<img class="cross" src="res/cross.png" alt="" hidden>
                    	<img class="none" src="res/none.png" alt="">
                	</button>
            	</td>
        	</tr>
    	</table>
    	<p id="textku">For debug</p>
    	<h1 hidden>The winner is None</h1>
    	<button id="restart">Restart</button>
	</div>    
</body>

<script>
    var role = "circle";
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

        $('button').click(function() {
            if (last_turn !== role) {
                last_turn = role;
                $(this).children('*').hide();
                $(this).children("." + role).show();
                if (role == "circle") {
                    stateOfBoard[this.id - 1] = "o"
                } else {
                    stateOfBoard[this.id - 1] = "x";
                }
                stateOfBoard_json = JSON.stringify(stateOfBoard);
                $.post("http://localhost/full-stack/FSP_Tugas2/ajax.php", {
                    stateOfBoard: stateOfBoard_json,
                    role: role
                }).done(function(data_dr_server) {
                    // $("#textku").text(data_dr_server);
                });

            }
        });

        setInterval(function() {
            $.post("http://localhost/full-stack/FSP_Tugas2/ajax2.php", {}).done(function(data_dr_server) {
                $("#textku").text(data_dr_server);
                array_data_dr_server = data_dr_server.split("//");
                stateOfBoard = $.parseJSON(array_data_dr_server[0]);
                last_turn = array_data_dr_server[1];


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

                $("#textku").text(data_dr_server);
                // $("#textku").text(stateOfBoard);

            })
        }, 10);

        $('input').click(function() {
            role = $(this).val();
        });

        $('#restart').click(function() {
            $("h1").hide();
            role = "none";
            stateOfBoard = ["none", "none", "none",
                "none", "none", "none",
                "none", "none", "none"
            ];
            stateOfBoard_json = JSON.stringify(stateOfBoard);
            $.post("http://localhost/full-stack/FSP_Tugas2/ajax.php", {
                stateOfBoard: stateOfBoard_json,
                role: role
            }).done(function(data_dr_server) {
                // $("#textku").text(data_dr_server);
            });
        })

    });
</script>

</html>