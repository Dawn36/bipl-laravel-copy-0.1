<!DOCTYPE html>
<html>
<head>
    <title>Ijara Sukuk Term Sheet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .td-color{
        background-color: #959698;
    }
    .image-container {
            text-align: center;
        }

        .image-container img {
            width: 200px;
            height: auto;
        }

        .text {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
        .disclaimer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            background-color: #f0f0f0;
        }
    </style>
<body>
    <div class="image-container">
        <img style="height: 50px; width: 70px" src="{{ $data['image'] }}" alt="Example Image">
    </div>
    <div class="text">
        AKD Securities Limited
    </div>
    <p>The Treasury Marketing Unit <br>
        Investor Portfolio Services <br>
        AKD Securities Limited <br>
        602 Continental Trade Center <br>
        Block 8, Clifton Karachi Pakistan 
    </p>
    <p><b><u>Ijara Sukuk Term Sheet</u></b></p>
    <table class="table table-bordered">
        <tr>
            <td class="td-color">Issue Date</td>
            <td>30-04-2020</td>
        </tr>
        <tr>
            <td class="td-color">Tenor</td>
            <td>5</td>
        </tr>
        <tr>
            <td class="td-color">Maturity Date</td>
            <td>30-04-2025</td>
        </tr>
        <tr>
            <td class="td-color">Settlement Date</td>
            <td>30-04-2023</td>
        </tr>
        <tr>
            <td class="td-color">Coupon</td>
            <td>20.69 %</td>
        </tr>
        <tr>
            <td class="td-color">Days To Maturity</td>
            <td>548</td>
        </tr>
        <tr>
            <td class="td-color">Current Coupon Days</td>
            <td>184</td>
        </tr>
        <tr>
            <td class="td-color">Coupon Remaining Days</td>
            <td>1</td>
        </tr>
        <tr>
            <td class="td-color">Accrued Days</td>
            <td>183</td>
        </tr>
        <tr>
            <td class="td-color">Current Coupon Start</td>
            <td>30-04-2023</td>
        </tr>
        <tr>
            <td class="td-color">Current Coupon End</td>
            <td>31-10-2023</td>
        </tr>
        <tr>
            <td class="td-color">Remaining No Of Coupons</td>
            <td>4</td>
        </tr>
    </table>
    <p style="margin-left: 38rem;">{{ DATE("Y-m-d") }}</p>
    <div class="disclaimer">
        <h5>Disclaimer</h5>
        <p>This for record purposes only</p>
    </div>
</body>
</html>