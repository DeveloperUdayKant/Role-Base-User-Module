<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #1F4529, #118B50);
            font-family: Arial, sans-serif;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #118B50;
        }
        .input-group {
            position: relative;
            margin: 10px 0;
        }
        input,select {
            width: 90%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .forgot-password, .switch a {
            color: #118B50;
            text-decoration: none;
            font-size: 14px;
            float: right;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        .btn {
            background: linear-gradient(to right, #1F4529, #118B50);
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" id="loginContainer">
        <div><img src="https://nata.clickbot.com.au/wp-content/uploads/2023/09/canberra-logo.png" width="100" height="100"></div>
        <h2>Welcome Back</h2>
        <div class="input-group">
            <input type="email" id="loginEmail" placeholder="Email Address">
        </div>
        <div class="input-group">
            <input type="password" id="loginPassword" placeholder="Password">
            <span class="toggle-password" onclick="togglePassword('loginPassword')">👁</span>
        </div>
        <a href="#" class="forgot-password">Forgot password?</a>
        <p class="error hidden" id="loginError">Error logging in</p>
        <button class="btn" onclick="login()">Login</button>
        <p class="switch">Don't have an account? <a href="#" onclick="showSignup()">Sign up</a></p>
    </div>

    <div class="container hidden" id="signupContainer">
    <div><img src="https://nata.clickbot.com.au/wp-content/uploads/2023/09/canberra-logo.png" width="100" height="100"></div>
        <h2>Create Account</h2>
        <div class="input-group">
            <input type="text" id="signupUsername" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="email" id="signupEmail" placeholder="Email Address" required>
        </div>        
        <div class="input-group">
            <input type="password" id="signupPassword" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword('signupPassword')">👁</span>
        </div>
        <div class="input-group">
            <select id="user-role" style="width: 97%!important;" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
                <option value="editor">Editor</option>
                <option value="user">User</option>
                <option value="guest">Guest</option>
            </select>
        </div>
        <button type="submit" class="btn">Sign Up</button>
        <p class="switch">Already have an account? <a href="#" onclick="showLogin()">Login</a></p>
    </div>

    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
        function showSignup() {
            document.getElementById('loginContainer').classList.add('hidden');
            document.getElementById('signupContainer').classList.remove('hidden');
        }
        function showLogin() {
            document.getElementById('signupContainer').classList.add('hidden');
            document.getElementById('loginContainer').classList.remove('hidden');
        }
        function login() {
            document.getElementById('loginError').classList.remove('hidden');
        }       
    </script>
    
</body>
</html>
