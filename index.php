<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div>Player1 (Circle) &larr;</div>
    <div>Player2 (Cross)</div>
    <form action="">
        <input id="radio_cross" type="radio" value="cross" name="role">
        <label for="radio_cross">Cross</label>

        <input id="radio_circle" type="radio" value="circle" name="role">
        <label for="radio_circle">Circle</label>

    </form>

    <table>
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
</body>

<script>
    var role = "none";
    var stateOfBoard = ["none", "none", "none",
        "none", "none", "none",
        "none", "none", "none"
    ];

    $(document).ready(function() {
        for (let i = 1; i < stateOfBoard.length + 1; i++) {
            $('#' + i).children(".none").show();
        }

        $('button').click(function() {
            $(this).children('*').hide();
            $(this).children("." + role).show();
            if (role == "circle") {
                stateOfBoard[this.id - 1] = "o"
            } else {
                stateOfBoard[this.id - 1] = "x";
            }
            var data = JSON.stringify(stateOfBoard);
            // Lanjutne kene do... 
            // Kirim data JSON lewat ajax ke ajax.php
        })
        $('input').click(function() {
            role = $(this).val();
        })
    });
</script>

</html>