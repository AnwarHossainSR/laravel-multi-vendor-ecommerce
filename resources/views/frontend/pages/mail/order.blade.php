<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    <h3>Order Confirmation Email</h3>
    <p>Hello {{ $details['first_name'] }} ,</p>
    <p>Your order is successfully placed. and your order id is {{ $details['order_number'] }}</p>
    <p>we will contact you as soon as possible</p>
    <br><br><br>
    <p>Best regards</p>
    <p>Team, E-SHOP shopping</p>

</body>
</html>
