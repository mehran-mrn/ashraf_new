<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/public/assets/panel/css/fonts.css" rel="stylesheet">
    <link href="/public/assets/panel/css/bootstrap.min.css" rel="stylesheet">
    <title>رسید پرداخت</title>
</head>
<style>
    body, html {
        direction: rtl;
        height: 100%;
    }
    * {
        font-family: IRANSans, Nastaliq, 'Times New Roman', serif;
    }
    .bg-img {
        min-height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .bg {
        background: rgba(251, 255, 254, 0.52);
        border-radius: 50px;
    }
    .bgB {
        background: rgba(251, 255, 254, 0.90);
        border-radius: 50px;
    }

    h1, h3 b {
        font-family: Nastaliq, Tahoma, 'Times New Roman', serif;
        font-size: 45px;
    }

    h5 {
        font-family: IRANSans, Tahoma, 'Times New Roman', serif;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
    }

    .btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        width: 20%;
        opacity: 0.9;
    }
    .btn:hover {
        opacity: 1;
    }
    @media (max-width: 575.98px) {
        .bg-img {
            background-image: url("/public/assets/global/images/callbackSmall.jpg");
        }

        h1, h3 b {
            font-size: 26px;
        }

        h5 {
            font-size: 14px;
            line-height: 20px;
            text-align: center;
        }

        .bg {
            width: 95%;
            margin-top: 140px;

        }

        .bgB {
            width: 90%;
        }

        .btn {
            width: 100%;
        }

    }
    @media (min-width: 576px) and (max-width: 767.98px) {
        .bg-img {
            background-image: url("/public/assets/global/images/callbackM.jpg");
        }

        h1, h3 b {
            font-size: 35px;
        }

        .bg {
            width: 95%;
            margin-top: 210px;
        }
        .bgB {
            width: 90%;
        }
        .btn {
            width: 100%;
        }
    }
    @media (min-width: 768px) and (max-width: 991.98px) {
        .bg-img {
            background-image: url("/public/assets/global/images/callback.jpg");
        }

        h1, h3 b {
            font-size: 35px;
        }

        .bg {
            width: 80%;
            margin-top: 210px;
        }
        .bgB {
            width: 90%;
        }
        .btn {
            width: 50%;
        }
    }
    @media (min-width: 992px) and (max-width: 1199.98px) {
        .bg-img {
            background-image: url("/public/assets/global/images/callback.jpg");
        }

        h1, h3 b {
            font-size: 35px;
        }

        .bg {
            width: 80%;
            margin-top: 210px;

        }
        .bgB {
            width: 90%;
        }
        .btn {
            width: 20%;
        }
    }
    @media (min-width: 1200px) {
        .bg-img {
            background-image: url("/public/assets/global/images/callback.jpg");
        }

        h1, h3 b {
            font-size: 35px;
        }

        .bg {
            width: 50%;
            margin-top: 200px;
        }

        .bgB {
            width: 90%;
        }
        .btn {
            width: 20%;
        }
    }

</style>
<body>
<div class="bg-img">
    <div class="container pt-3">
        <div class="row align-items-center m-auto ">
            <div class="col align-self-center bg">
                <div class="row align-items-center m-3 mb-sm-0">
                    <div class="col align-self-center ">
                        <div class="d-flex justify-content-center flex-column text-center">
                            <h1 class="text-center">{{__('callback.notice')}}<br></h1>
                            <h3>
                                <b>{{__('callback.sher')}}<br></b>
                                <b>{{__('callback.sher2')}}</b>
                            </h3>
                            <h5>{{__('callback.matn')}}</h5>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center bgB m-auto">
                    <div class="col align-self-center m-3">
                        <div class="d-flex justify-content-center">
                            <label><b>نام نیکوکار: </b> </label>
                            <strong> {{isset($messages['name']) ? " ".$messages['name']:''}}</strong>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between  text-center">
                            <label><b>تاریخ: </b></label>
                            <strong>{{isset($messages['date'])?$messages['date']:''}}</strong>
                            <label><b>مبلغ: </b></label>
                            <strong>{{isset($messages['amount'])?$messages['amount']:''}}</strong>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-center">
                            <label><b>بابت: </b></label>
                            <strong>{{isset($messages['des'])?$messages['des']:''}}</strong>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-center">
                            <label><b>شماره پیگیری: </b></label>
                            <strong>{{isset($messages['trackingCode'])?$messages['trackingCode']:''}}</strong>
                        </div>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-center">
                            <a href="{{route('home')}}" class="btn btn-success">برگشت به صفحه اصلی</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
