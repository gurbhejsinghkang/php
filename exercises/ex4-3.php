<?php

$Candidats = [
['Pierre', 22, '123 rue A', 'aa@ser.com', ['programming' => 5, 'teaching' => 2]],
['Julie', 65, '123 rue B', 'bb@ser.com', ['electronics' => 46]],
['Martin', 45, '123 rue C', 'cc@ser.com', ['programming' => 21, 'teaching' => 1]],
['Mélanie', 41, '123 rue D', 'dd@ser.com', ['welding' => 12, 'nutrition' => 6, 'restoration' => 1]],
];

// background black if age equal reference age, green when higher, blue when lower
const AGE_REFERENCE = 45;

// background yellow when years of experience higher or equal to MINIMUM_EXPERIENCE
const MINIMUM_EXPERIENCE = 5;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Exercice 4-3 - Job Candidates</title>

    <style>
        table,
        td,
        th {
            border: 1px solid black;
            margin: auto;
        }

        ul {
            list-style-type: none;
            padding: 5px;
        }

        /* when egal age reference*/
        .age-reference {
            background-color: black;
            color: white;
        }

        /* when > age reference*/
        .age-over {
            background-color: green;
            color: white;
        }

        /* when < age reference */
        .age-under {
            background-color: blue;
            color: white;
        }

        /* when  < minimum experience */
        .experience-invalid {
            background-color: white;
            color: black;
        }

        /* when >= minimum experience */
        .experience-valid {
            background-color: yellow;
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Email</th>
                <th>Experiences</th>
            </tr>
        </thead>


        <?php
            $avg = 0;
            foreach ($Candidats as $value) {
                $avg = $avg + $value[1];
                $class_name;
                if ($value[1] == 45) {
                    $class_name = 'age-reference';
                } elseif ($value[1] > 45) {
                    $class_name = 'age-over';
                } else {
                    $class_name = 'age-under';
                }
                echo '<tr class='.$class_name.'>';
                echo '<td>'.$value[0].'</td>';
                echo '<td>'.$value[1].'</td>';
                echo '<td>'.$value[2].'</td>';
                echo '<td>'.$value[3].'</td>';
                echo '<td>';
                echo '<ul>';
                foreach ($value[4] as $key => $values) {
                    $class_name1;
                    if ($values >= MINIMUM_EXPERIENCE) {
                        $class_name1 = 'experience-valid';
                    } else {
                        $class_name1 = 'experience-invalid';
                    }
                    echo '<li class='.$class_name1.'>';
                    echo $key.':';
                    echo $values;
                    echo '</li>';
                }
                echo '</ul>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        <tr>
            <td>
                Average
            </td>
            <td>
                <?php
                $avg = $avg / 4;
                echo $avg;
                ?>
            </td>
            <td colspan="3">

            </td>
        </tr>
    </table>

</body>

</html>