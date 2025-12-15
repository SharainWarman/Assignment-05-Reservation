<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h2>Reservation Reciept</h2>
    <h4>Customer Name : <?php echo $name ?></h4><br><br>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th>Charges (Rs.)</th>
        </tr>
        <tr>
            <td>Hotel:</td>
            <td>
                <?php
                if ($hotel == "hotel1") {
                    echo "River Side Hotel";
                } elseif ($hotel == "hotel2") {
                    echo "Lagoon View Hotel";
                } elseif ($hotel == "hotel3") {
                    echo "Nature Villa";
                } elseif ($hotel == "hotel4") {
                    echo "Beach Resort";
                }
                ?>
            </td>

        </tr>
        <tr>
            <td>Room Type:</td>
            <td>
                <?php
                if ($room == "standard") {
                    echo "Standard Room";
                } elseif ($room == "deluxe") {
                    echo "Deluxe Twin Room";
                } elseif ($room == "suite") {
                    echo "Suite Room";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Number of days you stay</td>
            <td><?php
            $date1 = new DateTime($_POST['date']);
            $date2 = new DateTime($_POST['date2']);
            $interval = $date1->diff($date2);
            echo $interval->days;
            ?></td>
            <td>
                <?php

                echo $total - (($SpaHr * $spa) + ($CyclingHr * $cycling) + ($SwimmingHr * $swimming) + ($GymHr * $gym)) - (($board == "full") ? ($fullBoard) : 0);

                ?>
            </td>
        </tr>
        <tr>
            <td>
                Full board/half board
            </td>
            <td>
                <?php

                if ($board == "half") {
                    echo "Half Board";
                } elseif ($board == "full") {
                    echo "Full Board";
                }
                ?>
            </td>
            <td>
                <?php
                if ($board == "full") {
                    echo $fullBoard;
                } else {
                    echo "0";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">
                Activities
            </td>
        </tr>
        <tr>
            <?php
            if (isset($_POST['spa'])) {
                echo "<td>Spa (" . $SpaHr . " hrs)</td>
                <td></td>
                <td>" . ($SpaHr * $spa) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <?php
            if (isset($_POST['cycling'])) {
                echo "<td>Cycling (" . $CyclingHr . " hrs)</td>
                <td></td>
                <td>" . ($CyclingHr * $cycling) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <?php
            if (isset($_POST['swimming'])) {
                echo "<td>Swimming (" . $SwimmingHr . " hrs)</td>
                <td></td>
                <td>" . ($SwimmingHr * $swimming) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <?php
            if (isset($_POST['gym'])) {
                echo "<td>Gym (" . $GymHr . " hrs)</td>
                <td></td>
                <td>" . ($GymHr * $gym) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <td></td>
            <td style="font-weight: bold;">Total Amount:</td>
            <td style="font-weight: bold;">
                <?php
                echo $total;
                ?>
            </td>
        </tr>
    </table>
</body>

</html>