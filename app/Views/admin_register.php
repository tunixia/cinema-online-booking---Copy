<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/custom/cinema-online-booking.css" rel="stylesheet">
</head>
<body class="main-bg">
    <div class="container">
        <div class="d-flex justify-content-center flex-column vh-100 min-h-500 text-light">
            <div class="mb-3"><h1>Register Account</h1></div>
                <form id="theater-account-register" method="POST">
                    <div class="row">
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input type="text" class="form-control" id="contactNumber" name="contact_number">
                                <small id="contact_number" class="form-text">Error msg here.</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">G-mail</label>
                                <input type="text" class="form-control" id="theaterName" name="email">
                                <small id="_email" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                     
                        <div class="col-12 d-flex justify-content-end">             
                            <button type="submit" class="btn btn-primary pr-5 pl-5 pt-3 pb-3">REGISTER</button>
                        </div>
                    </div>
                </form>
        </div>   
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/jquery.js"></script>
<script src="/js/register-theater-account.js"></script>
</html>