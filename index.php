<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
     form{
        margin: 20px;
     }
 

label {
  
  width: 150px;
  
}

input[type="text"],
input[type="date"],
select {
  width: 200px;
  margin-bottom: 5px;
}

input[type="radio"],
input[type="checkbox"] {
  margin-right: 5px;
}

.box {
  display: inline-block;
}

    </style>
</head>

<body>
    <?php
    $name = $board = "";
    $riverSideHotel = [7500, 8500, 10000];
    $lagoonViewHotel = [8500, 10000, 12500];
    $natureVilla = [10000, 12500, 15000];
    $beachResort = [12500, 15000, 20000];
    $spa = 5000;
    $cycling = 400;
    $swimming = 1000;
    $gym = 850;
    $numberOfDays = $SpaHr = $CyclingHr = $SwimmingHr = $GymHr = $total = 0;

    $fullBoard = 3500;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $checkinDate = $_POST['date'];
        $checkoutDate = $_POST['date2'];
        $hotel = $_POST['hotel'];
        $room = $_POST['room'];
        $board = $_POST['board'] ?? 'half';
        $date1 = new DateTime($checkinDate);
        $date2 = new DateTime($checkoutDate);
        $interval = $date1->diff($date2);
        $numberOfDays = $interval->days;

        if (isset($_POST['spa'])) {
            $SpaHr = (int) $_POST['spa_hr'];
        }

        if (isset($_POST['cycling'])) {
            $CyclingHr = (int) $_POST['cycling_hr'];
        }

        if (isset($_POST['swimming'])) {
            $SwimmingHr = (int) $_POST['swimming_hr'];
        }

        if (isset($_POST['gym'])) {
            $GymHr = (int) $_POST['gym_hr'];
        }
        if ($hotel == "hotel1") {
            if ($room == "standard") {
                $total += $riverSideHotel[0] * $numberOfDays;
            } elseif ($room == "deluxe") {
                $total += $riverSideHotel[1] * $numberOfDays;
            } elseif ($room == "suite") {
                $total += $riverSideHotel[2] * $numberOfDays;
            }
        } elseif ($hotel == "hotel2") {
            if ($room == "standard") {
                $total += $lagoonViewHotel[0] * $numberOfDays;
            } elseif ($room == "deluxe") {
                $total += $lagoonViewHotel[1] * $numberOfDays;
            } elseif ($room == "suite") {
                $total += $lagoonViewHotel[2] * $numberOfDays;
            }
        } elseif ($hotel == "hotel3") {
            if ($room == "standard") {
                $total += $natureVilla[0] * $numberOfDays;
            } elseif ($room == "deluxe") {
                $total += $natureVilla[1] * $numberOfDays;
            } elseif ($room == "suite") {
                $total += $natureVilla[2] * $numberOfDays;
            }
        } elseif ($hotel == "hotel4") {
            if ($room == "standard") {
                $total += $beachResort[0] * $numberOfDays;
            } elseif ($room == "deluxe") {
                $total += $beachResort[1] * $numberOfDays;
            } elseif ($room == "suite") {
                $total += $beachResort[2] * $numberOfDays;
            }
        }
        $total += ($SpaHr * $spa) + ($CyclingHr * $cycling) + ($SwimmingHr * $swimming) + ($GymHr * $gym);
        if ($board == "full") {
            $total += $fullBoard;
        }

    }
    ?>
    <form action="receipt.php" method="POST">
        <Label for="name">Customer name</Label>
        <input type="text" id="name" name="name" required>
        <br>
        <Label for="date">Check-in Date</Label>
        <input type="date" id="date" name="date" required>
        <Label for="date2">Chech-out date</Label>
        <input type="date" id="date2" name="date2" required>
        <br>
        <label for="hotel">Hotel</label>
        <select id="hotel" name="hotel" required>
            <option value="hotel1">River Side Hotel</option>
            <option value="hotel2">Lagoon view hotel</option>
            <option value="hotel3">Nature Villa</option>
            <option value="hotel4">Beach Resort</option>
        </select>
        <br>
        
        <label for="room" class="room-type-title">Room Type</label>
        
        <div class="box">
        <input type="radio" id="standard" name="room" value="standard" required>
        <label for="standard">Standard Double</label>
        <br>
        <input type="radio" id="deluxe" name="room" value="deluxe" required>
        <label for="deluxe">Deluxe Twin Room</label>
        <br>
        <input type="radio" id="suite" name="room" value="suite" required>
        <label for="suite">Executive Suite</label>
        </div>
        
        

        <table>
            <tr>
                <td>Activities</td>
                <td>Number of hours</td>
            </tr>
            <tr>
                <td><input type="checkbox" id="spa" name="spa"><label for="spa">Spa</label> </td>
                <td><input type="number" id="spa_hr" name="spa_hr" min="0" max="8" value="0"></td>
            </tr>
            <tr>
                <td><input type="checkbox" id="cycling" name="cycling"><label for="cycling">Cycling</label> </td>
                <td><input type="number" id="cycling_hr" name="cycling_hr" min="0" max="8" value="0"></td>
            </tr>
            <tr>
                <td><input type="checkbox" id="swimming" name="swimming"><label for="swimming">Swimming</label> </td>
                <td><input type="number" id="swimming_hr" name="swimming_hr" min="0" max="8" value="0"></td>
            </tr>
            <tr>
                <td><input type="checkbox" id="gym" name="gym"><label for="gym">Gym</label> </td>
                <td><input type="number" id="gym_hr" name="gym_hr" min="0" max="8" value="0"></td>
            </tr>
        </table>

        <br>
        <input type="radio" id="half" name="board" value="half">
        <label for="half">Half Board</label>
        <input type="radio" id="full" name="board" value="full">
        <label for="full">Full Board</label>
        <br>

        <input type="submit" value="Reserve">
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

</html>