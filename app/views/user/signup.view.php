<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/login.css"/>
    <link rel="icon" type="image/x-icon" href="<?=ROOT?>/assets/images/bh.png">
    <title>Sign Up</title>
</head>

<body>

    <div class="d-flex justify-content-start" style="position: absolute; z-index: 999; top: 10px; left: 10px;">
        <img src="<?=ROOT?>/assets/images/bhaven.png" alt="Logo" style="width: 150px; height: auto;">
    </div>
    

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        
        
        <div class="row border rounded-5 p-3 shadow box-area" style="background-color: #191919; border-color: transparent !important;">

            <div class="header-text mb-4 text-center d-flex justify-content-center align-items-center" style="color: white;"> 
                <h3>Sign Up</h3>
            </div>
            
            
            <div class="col-md-6 right-box">

                <form>
                    <div class="input-group mb-3">
                        <div class="input-group-text bg-light"><i class="lni lni-user"></i></div>
                        <input type="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="First Name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text bg-light"><i class="lni lni-user"></i></div>
                        <input type="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="Middle Name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text bg-light"><i class="lni lni-user"></i></div>
                        <input type="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="Last Name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text bg-light"><i class="lni lni-map-marker"></i></div>
                        <input type="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="Address">
                    </div>

                    
                </form>
                
            
            </div>
            
            <div class="col-md-6 right-box" style="margin-top: 0px;">
                
                <div class="row align-items-center">                   
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-text bg-light"><i class="lni lni-phone"></i></div>
                            <input type="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="Contact Number">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-text bg-light"><i class="lni lni-envelope"></i></div>
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-text bg-light"><i class="lni lni-lock-alt"></i></div>
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light"><i class="lni lni-lock-alt"></i></div>
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password">
                        </div>
                    </form>
                </div>
                

            </div>

            <div class="centered-content">
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-dark w-100 fs-6" style="background-color: #e50914; border-color: transparent;">Sign Up</button>
                </div>
                
                <div class="text-center" style="color: white;">
                    <p style="margin-bottom: -10px; color: #6c757d;">Already have an account?</p>
                    <a href="login" class="btn btn-lg w-100 fs-6" style="background-color: transparent; border: none; text-decoration: underline; color: white;">Login</a>
                </div>
            </div>
        
        </div>

        
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
