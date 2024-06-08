<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin:0;
           
        }

        .calculator {
            background: slategray;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 10 10 10px rgba(10,10,0,0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin: 0 0 20px 0;
            color: black;
            text-shadow: 
                1px 1px 0 #000, 
                2px 2px 0 #000, 
                3px 3px 0 #000, 
                4px 4px 0 #000, 
                5px 5px 0 #000;
            font-size: 2em;
            position: relative;
            z-index: 1;
        }

        h2::after {
            content: attr(data-text);
            position: absolute;
            left: 0;
            top: 0;
            color: goldenrod;
            z-index: -1;
            opacity: 0.3;
            filter: blur(3px);
        }

        form input, form select, form button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid black;
        }

        form button {
            background-color: orangered;
            color: black;
            border: none;
        }

        form button:hover {
            background-color: whitesmoke;
        }

        p {
            font-size: 1.5em;
        }
    </style>
</head>
<body>

    <div class="calculator">
        <h2 data-text="THEE Calculator">THEE Calculator</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="num1">Number 1:</label>
            <input type="number" id="num1" name="num1" step="any" required><br><br>
            
            <label for="num2">Number 2:</label>
            <input type="number" id="num2" name="num2" step="any"><br><br>
            
            <label for="operation">Choose an operation:</label>
            <select id="operation" name="operation" required>
                <option value="add">Addition</option>
                <option value="subtract">Subtraction</option>
                <option value="multiply">Multiplication</option>
                <option value="divide">Division</option>
                <option value="exponentiate">Exponentiation</option>
                <option value="percentage">Percentage</option>
                <option value="squareRoot">Square Root</option>
                <option value="logarithm">Logarithm</option>
            </select><br><br>
            
            <button type="submit">Calculate</button>
        </form>
        
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
                $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
                $operation = $_POST['operation'];
                $result = '';

                switch ($operation) {
                    case 'add':
                        $result = $num1 + $num2;
                        break;
                    case 'subtract':
                        $result = $num1 - $num2;
                        break;
                    case 'multiply':
                        $result = $num1 * $num2;
                        break;
                    case 'divide':
                        if ($num2 != 0) {
                            $result = $num1 / $num2;
                        } else {
                            $result = 'Error: Division by zero';
                        }
                        break;
                    case 'exponentiate':
                        $result = pow($num1, $num2);
                        break;
                    case 'percentage':
                        $result = ($num1 * $num2) / 100;
                        break;
                    case 'squareRoot':
                        if ($num1 >= 0) {
                            $result = sqrt($num1);
                        } else {
                            $result = 'Error: Negative number';
                        }
                        break;
                    case 'logarithm':
                        if ($num1 > 0) {
                            $result = log($num1);
                        } else {
                            $result = 'Error: Non-positive number';
                        }
                        break;
                    default:
                        $result = 'Invalid operation';
                        break;
                }

                echo "Result: " . $result;
            }
            ?>
        </p>
    </div>

</body>
</html>
