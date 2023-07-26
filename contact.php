<?php
    


      
    
    
    





    session_start();
    if(!isset($_SESSION['username'])) {
        header("Location: singup.php");
        }
    require("database.php");

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = htmlspecialchars($_POST['fullname-surname'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

        try {
            
        
            $stmt = $db->prepare("INSERT INTO messages (fullname, email, subject, messages) VALUES (:fullname, :email, :subject, :messages)");
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':messages', $message);
            $stmt->execute();

            echo "Message sent successfully!";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
?>























<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    
    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="header-wrapper mt-5">
                <div class="row header-content">
                    <div class="header-title col-md-8">
                        <a href="index.php">Blog Title</a>
                    </div>
                    <div class="header-menu col-md-4">
                    <ul>
                            <li>
                                <a href="index.php" style="opacity: 100%;">Home</a>
                            </li>
                            <li>
                                <a href="blog.php">Blog</a>
                            </li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li>
                                <a href="contact.php">Contact</a>
                            </li>

                            <li>
                                <a href="post.php">Post</a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="contact-wrapper">
        <div class="container mt-4">
            <div class="contact-container">
                <div class="contact-top-title">
                    Contact Form
                </div>
                <div class="contact-form">
                    <form action="#" method="post">
                                <div class="fullname-input">
                                    <input type="text" name="fullname-surname" id="" placeholder="Full Name" required>
                                </div>
                                <div class="email-input">
                                    <input type="email" name="email" id="" placeholder="Email Address" required>
                                </div>
                                <div class="subject-input">
                                    <input type="text" name="subject" id="" placeholder="Subject" required>
                                </div> 
                                <div class="message-input">
                                    <textarea name="message" id="" cols="60" rows="5" placeholder="Message" required></textarea>
                                </div>
                                <div class="button-input">
                                    <button type="submit">Send Message</button>
                                </div>           
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid mt-5"></div>
        <hr>
        </div>
        <div class="container text-center mt-5 mb-5">
            <div class="copyright">
                © 2021 All rights reserved.
            </div>
        </div>

    </footer>

</body>

</html>