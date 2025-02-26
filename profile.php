<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Form</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            background: url(pics/g17.jpg) no-repeat center center fixed;
    background-size: cover;
            
        }

        

        form {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Increased maximum width */
            width: 100%;
            min-width: 400px; /* Minimum width to prevent shrinking too much */
           
        }

         /* Change the color of the placeholder text to green */
         form input::placeholder {
            color: #4CAF50;
            opacity: 1; /* Ensure the color is visible in some browsers */
        }

        h2 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group div {
            margin-bottom: 8px;
            font-weight: bold;
            color: white;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            background: none; /* Make background transparent */
            border: none;
            border-bottom: 2px solid #4caf50;
            outline: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            form {
                padding: 30px;
                max-width: 90%;
            }

            .input-group div,
            form input,
            form button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<form action="create.php" method="POST">
    <h2>Profile</h2>

    <div class="input-group">
        <input type="text" id="fname" name="fname" placeholder="First Name" required>
    </div>
    <div class="input-group">
        <input type="text" id="lname" name="lname" placeholder="Last Name" required>
    </div>
    <div class="input-group">
        <input type="email" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit">Submit</button>
</form>


</body>
</html>
