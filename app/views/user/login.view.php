<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/images/ink_and_imprint.png">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/login.css"/>
    <title>Login</title>
    <link rel="icon" type="image/png" href="<?=ROOT?>/assets/images/bh.png">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        
        <div class="row border rounded-5 p-3 shadow box-area" style="background-color: #191919; border-color: transparent !important;">


            
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                
                <div class="featured-image mb-3">
                    <img src="<?=ROOT?>/assets/images/bhaven.png" alt="BookHaven" class="img-fluid" style="width: 250px;">
                </div>
            
            </div>
            
            <div class="col-md-6 right-box">
                
                <div class="row align-items-center">
                    
                    <div class="header-text mb-4 text-center" style="color: white;"> 
                        <h3>Login</h3>
                    </div>
                    
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-text bg-light"><i class="lni lni-envelope"></i></div>
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-text bg-light"><i class="lni lni-lock-alt"></i></div>
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                        </div>
                        <div class="input-group mb-4 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Forgot Password</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <a href="bookspage.html" class="btn btn-lg btn-dark w-100 fs-6" style="background-color: #e50914; border-color: transparent;">Login</a>
                        </div>
                        
                        
                        <div class="text-center" style="color: white;">
                            <p style="margin-bottom: -10px; color: #6c757d;">Don't have an account?</p>
                            <a href="signup" class="btn btn-lg w-100 fs-6" style="background-color: transparent; border: none; text-decoration: underline; color: white;">Sign up</a>
                        </div>
                        
                        
                    </form>
                </div>

            </div>
        
        </div>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
