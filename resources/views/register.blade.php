<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Register</title>
     <link rel="stylesheet" href="{{ asset('css/registerStyles.css') }}">
     <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
     <div class="container">
          <div class="title">Registration</div>
          <form action="{{ route('msRegister') }}" method="post" id="formReg">
                 @csrf
                 @method('POST') 
                <div class="user-details">
                     <div class="input-box">
                          <span class="details">Name</span>
                          <input type="text" name="name" placeholder="Type your name" required>
                     </div>
                     <div class="input-box">
                         <span class="details">Email</span>
                         <input type="email" name="email" placeholder="Type your Email" required>
                    </div>
                    <div class="input-box">
                         <span class="details">Password</span>
                         <input type="password" name="password" placeholder="Type your Password" required>
                    </div> 
                    <div class="input-box">
                         <span class="details">Confirm Password</span>
                         <input type="password" name="password_confirmation" placeholder="Confirm your Password" required>
                    </div>                                                             
                </div>
                <div class="sex-details">
                     <input type="radio" name="sex" value="Male" id="dot-1">
                     <input type="radio" name="sex" value="Female" id="dot-2">
                     <span class="sex-title">Sex</span>
                     <div class="category">
                          <label for="dot-1">
                               <span class="dot one"></span>
                               <span class="sex">Male</span>
                          </label>
                          <label for="dot-2">
                              <span class="dot two"></span>
                              <span class="sex">Female</span>
                         </label>                          
                     </div>
                </div>
                <div class="button">
                     <input type="Submit" Value="Register">
                </div>
                @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                @endif
          </form>
     </div>
     <script>

     </script>
</body>
</html>