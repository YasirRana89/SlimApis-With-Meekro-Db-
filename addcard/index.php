<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mobile Templates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <link rel="stylesheet" href="style/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="style/custome2.css?v=version2">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
</head>
<body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">

                </div>
                <div class="col-sm-6 main-body">
                    <img src="" alt="">
                    <h2 class="heading">Attach Card</h2>
                    <p class="description">plese enter the details for the card that will <br> pay out the monthely
                        donations</p>

                    <form name="myform" class="form-signin" role="form">
                        <input type="text" class="form-custome card-number" name="ccnumber" id="loginnumber"
                            placeholder=" Card Number" required value="4242 4242 4242 4242">

                        <input type="text" class="form-custome date" name="ccexpyear" id="loginyear"
                            placeholder=" YEAR/MONTH" required autocomplete="false" value="2019/12">
                        <input type="text" class="form-custome cvs" name="cccvs" id="logincsv" placeholder=" CVS" required autocomplete="false" value="1234">
                        <input type="text" class="form-custome" name="user_id" id="loginuserid" placeholder=" Userid" required autocomplete="false" value="7860">
                        <button id="submit" class="btn btn-lg btn-primary btn-block" type="submit" ><b>ATTACH
                                CARD</b></button>
                    </form>
                    <p class="description-end">we employ multilevel safegurads including TLS<br> encryption to protect
                        your data
                    </p>
                    <button class="btn-end " type="submit">powereb by<b> STRIPE</b></button>
                </div>
                <div class="col-sm-3">

                </div>

            </div>
        </div>
    </div>

    <script>
        var apiUrl = "http://localhost/addcard/api/index.php";
        $(document).ready(function () {
            // masking
            $("#loginyear").mask("9999/99", { placeholder: "YYYY/MM" });
            $("#loginnumber").mask("9999 9999 9999 9999", { placeholder: "0000 0000 0000 0000" });
            $("#logincsv").mask("9999", { placeholder: "0000" });
            $("#loginuserid").mask("9999", { placeholder: "0000" });



            // api interaction
            $(".form-signin").submit(function (e) {
                e.preventDefault();
                // this will give you complete form fields
                // do read later what is .serialize() does
                var postData = $(".form-signin").serialize();
                // ready to make ajax call
                $.ajax({
                    url: apiUrl + "/card",
                    type: "POST",
                    data: postData, /// this postData will be fetched in API
                    //dataType: "json",
                    success: function (response) {
                        console.log(response);
                        alert(response);
                    },
                    error: function (err) {
                        alert("Whoops! Something went wrong. Please check logs");
                    }
                });
            });



            /*
            
                        $(".form-signin").validate({
                            rules: {
                                number: {
                                    required: true,
                                    minlength: 16
                                },
                                year: {
                                    required: true,
                                },
                                csv: {
                                    required: true,
                                },
                                userid: {
                                    required: true,
                                },
                            },
                            messages: {
                                number: {
                                    required: "Please enter a Valid Card number",
                                    minlength: "Your Card number must consist of at least 16 characters"
                                },
                                year: {
                                    required: "Invalid Year / Month entered",
                                },
                                csv: {
                                    required: "Please provide CVS",
                                },
                                userid: {
                                    required: "Please provide a valid userid",
                                },
                            }
                        });
            */
        });
    </script>

</body>

</html>