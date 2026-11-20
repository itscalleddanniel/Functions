<?php

declare(strict_types=1);

$coffee_products = [
    'Espresso Beans' => ['price' => 450.00, 'stock' => 14],
    'Matcha Powder'  => ['price' => 380.00, 'stock' => 6],
    'Oat Milk'       => ['price' => 165.00, 'stock' => 25],
    'Caramel Syrup'  => ['price' => 290.00, 'stock' => 8],
    'French Press'   => ['price' => 850.00, 'stock' => 11],
    'Cold Brew Can'  => ['price' => 120.00, 'stock' => 4],
];


$tax_rate = 12;
function get_reorder_message(int $stock): string {
    return ($stock < 10) ? 'Yes' : 'No';
}


function get_total_value(float $price, int $stock): float {
    return $price * $stock;
}

function get_tax_due(float $price, int $stock, int $tax_rate = 0): float {
    return ($price * $stock) * ($tax_rate / 100);
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Coffee Corner — Stock Control</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>The Coffee Corner</h1>
        <p class="subtitle">Stock Control</p>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Re-order</th>
                    <th>Total Value</th>
                    <th>Tax Due</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($coffee_products as $product_name => $data) {
                    $stock = $data['stock'];
                    $price = $data['price'];
                    $reorder = get_reorder_message($stock);
                    $total_value = get_total_value($price, $stock);
                    $tax_due = get_tax_due($price, $stock, $tax_rate);
                ?>
                <tr>
                    <td><?= htmlspecialchars($product_name) ?></td>
                    <td><?= $stock ?></td>
                    <td><?= $reorder ?></td>

                    <td>₱<?= number_format($total_value, 2) ?></td>
                    <td>₱<?= number_format($tax_due, 2) ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>