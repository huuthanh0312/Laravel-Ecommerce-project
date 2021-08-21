<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
    <p>Hi <b>{{$data['name']}}</b>, </p>
    <p>The payment number is <b>{{$data['payment_id']}}</b>.</p> 
    <p>The payment type is <b>{{$data['payment_type']}}</b>.</p> 
    <p>Total Amount: <b>{{$data['paying_amount']}}$</b>.</p>
    <p>Track your order’s status here <b>{{$data['status_code']}}</b>. </p>   
    <p>Thank you for shopping with us!</p>
    <p><b>ThanhStore</b></p>
</body>
</html>