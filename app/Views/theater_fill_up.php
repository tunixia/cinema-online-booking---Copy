<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Theater</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/custom/cinema-online-booking.css" rel="stylesheet">
</head>
<body class="main-bg">
    <div class="container">
        <div class="d-flex justify-content-center flex-column vh-100 min-h-500 text-light">
            <div class="mb-3"><h1>Fill up theater</h1></div>
                <form id="theater-fill-up" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="theaterName">Theater Name</label>
                                <input type="text" class="form-control" id="theaterName" name="theater_name">
                                <small id="theater_name" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="building">Building Name</label>
                                <input type="text" class="form-control" id="building" name="building">
                                <small id="_building" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                                <small id="_address" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="floor">Floor</label>
                                <input type="text" class="form-control" id="floor" name="floor">
                                <small id="_floor" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="businessLicense">Business License</label>
                                    <input type="text" class="form-control" id="businessLicence" name="business_license">
                                    <small id="business_license" class="form-text">Error msg here.</small>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">             
                            <button type="submit" class="btn btn-primary pr-5 pl-5 pt-3 pb-3">NEXT <i class="ml-1 fa fa-arrow-right"></i></button>
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
<script src="/js/register-theater.js"></script>
</html>