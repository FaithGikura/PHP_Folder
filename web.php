<!DOCTYPE html>
<html>
<head>
    <title>Hypermarket Pricing Calculator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hypermarket Pricing Calculator</h1>
        <form method="post" action="">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Buying Price</th>
                    <th>VAT (%)</th>
                    <th>General Expenses (%)</th>
                    <th>Profit Margin (%)</th>
                </tr>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td>Product <?php echo $i; ?></td>
                    <td><input type="number" step="0.01" name="buying_price[]" required></td>
                    <td><input type="number" step="0.01" name="vat[]" required></td>
                    <td><input type="number" step="0.01" name="expenses[]" required></td>
                    <td><input type="number" step="0.01" name="profit[]" required></td>
                </tr>
                <?php endfor; ?>
            </table>
            <button type="submit" name="calculate">Calculate</button>
        </form>

        <?php
        if (isset($_POST['calculate'])) {
            echo "<h2>Calculation Results</h2>";
            echo "<table>";
            echo "<tr>
                    <th>Product</th>
                    <th>VAT Amount</th>
                    <th>Total General Expenses</th>
                    <th>Profit Margin Amount</th>
                    <th>Selling Price</th>
                  </tr>";
            $buying_prices = $_POST['buying_price'];
            $vats = $_POST['vat'];
            $expenses = $_POST['expenses'];
            $profits = $_POST['profit'];

            for ($i = 0; $i < 10; $i++) {
                $buying_price = $buying_prices[$i];
                $vat = $vats[$i];
                $expense = $expenses[$i];
                $profit = $profits[$i];

                $vat_amount = ($buying_price * $vat) / 100;
                $expense_amount = ($buying_price * $expense) / 100;
                $profit_amount = ($buying_price * $profit) / 100;

                $selling_price = $buying_price + $vat_amount + $expense_amount + $profit_amount;

                echo "<tr>
                        <td>Product " . ($i + 1) . "</td>
                        <td>" . number_format($vat_amount, 2) . "</td>
                        <td>" . number_format($expense_amount, 2) . "</td>
                        <td>" . number_format($profit_amount, 2) . "</td>
                        <td>" . number_format($selling_price, 2) . "</td>
                      </tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
