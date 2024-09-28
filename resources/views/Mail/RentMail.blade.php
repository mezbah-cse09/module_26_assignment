<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Static Template</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
</head>

<body
    style="
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #ffffff;
      font-size: 14px;
    ">
    <div
        style="
        max-width: 680px;
        margin: 0 auto;
        padding: 45px 30px 60px;
        background: #f4f7ff;
        background-image: url(https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1661497957196_595865/email-template-background-banner);
        background-repeat: no-repeat;
        background-size: 800px 452px;
        background-position: top center;
        font-size: 14px;
        color: #434343;
      ">
        <header>
            <table style="width: 100%;">
                <tbody>
                    <tr style="height: 0;">
                        <td>
                            <img alt=""
                                src="https://archisketch-resources.s3.ap-northeast-2.amazonaws.com/vrstyler/1663574980688_114990/archisketch-logo"
                                height="30px" />
                        </td>
                        <td style="text-align: right;">
                            <span style="font-size: 16px; line-height: 30px; color: #ffffff;">12 Nov, 2021</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>

        <main>
            <div
                style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 115px;
            background: #ffffff;
            border-radius: 30px;
            text-align: left;
          ">
                <div style="width: 100%; max-width: 489px; margin: 0 auto;">
                    <h1
                        style="
                margin: 0;
                font-size: 24px;
                font-weight: 500;
                color: #1f1f1f;
              ">
                        Rent Detail
                    </h1>
                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Rent Id: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['id'] }}</span>
                    </p>

                    @php
                        use Carbon\Carbon;
                        $todayString = Carbon::today()->toDateString();
                    @endphp
                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 14px;
                font-weight: 600;
              ">
                        Date: <span style="font-weight: 500; color: #1f1f1f;">{{ $todayString }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Customer Name: <span
                            style="font-weight: 500; color: #1f1f1f;">{{ $data['user']['name'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Email: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['user']['email'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Id: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['user']['id'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Start Date: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['start_date'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        End Date: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['end_date'] }}</span>
                    </p>



                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Car Id: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['name'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Car Name: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['name'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Brand: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['brand'] }}</span>
                    </p>
                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Model: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['model'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Year: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['year'] }}</span>
                    </p>

                    <p
                        style="
                margin: 0;
                margin-top: 4px;
                font-size: 16px;
                font-weight: 600;
              ">
                        Type: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['car']['car_type'] }}</span>
                    </p>


                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">
                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-size: 16px;
                font-weight: 600;
              ">
                        total Cost: <span style="font-weight: 500; color: #1f1f1f;">{{ $data['total_cost'] }}
                            Taka</span>
                    </p>
                    <p
                        style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">

                </div>
            </div>

            <p
                style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #8c8c8c;
          ">

            </p>
        </main>

        <footer
            style="
          width: 100%;
          max-width: 490px;
          margin: 20px auto 0;
          text-align: center;
          border-top: 1px solid #e6ebf1;
        ">
            <p
                style="
            margin: 0;
            margin-top: 40px;
            font-size: 16px;
            font-weight: 600;
            color: #434343;
          ">
                CarRent Company
            </p>
            <p style="margin: 0; margin-top: 8px; color: #434343;">
                Address 540, City, State.
            </p>

            <p style="margin: 0; margin-top: 16px; color: #434343;">
                Copyright © 2022 Company. All rights reserved.
            </p>
        </footer>
    </div>
</body>

</html>
