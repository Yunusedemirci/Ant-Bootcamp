<?php
    
    session_start();
    require("database.php");

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $postmessage = $_POST['postmessage'];

        
        $stmt = $db->prepare("INSERT INTO post (username, postmessage) VALUES (:username, :postmessage)");

        
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':postmessage', $postmessage);

       
        $stmt->execute();
    }

    
    $stmt = $db->query("SELECT * FROM post");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>


<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="post.php">Post</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

</body>


<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    
}

.container {
    max-width: 600px;
    width: 100%;
    margin: 20px auto;
}

form {
    background-color: #555;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    
    
}

.post-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%; 
    margin: 0 auto;
}

.post-box {
    border: 1px solid #000;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    text-align: left;
    width: 100%;
}

.post-box hr {
    border: 0;
    border-top: 1px solid #000;
    margin: 10px 0;
}

.post-form {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
}

.post-form .username,
.post-form .postmessage {
    margin-bottom: 20px;
}

.post-form input,
.post-form textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.post-form button {
    padding: 10px 20px;
    border: none;
    background-color: #007BFF;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.post-form button:hover {
    background-color: #0056b3;
}

.header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: left;
        }
        .header-title {
            flex: 1;
            text-align: left;
        }
        .header-menu {
            flex: 1;
            text-align: right;
        }
        .header-menu ul {
            display: flex;
            justify-content: space-between;
            list-style-type: none;
            padding: 0;
        }
        .header-menu ul li {
            margin: 0 10px;
        }




</style>

   

    
    <svg class="bi pe-none me-2" width="100" height="100"><use xlink:href="#home"></use></svg>


<form method="post" action="" class="post-form">
    <div class="username">
        <input type="text" name="username" id="username" placeholder="username" required>
    </div>
    <div class="postmessage">
        <textarea name="postmessage" id="postmessage" cols="60" rows="5" placeholder="postmessage" required></textarea>
    </div>
    <div class="button-input">
        <button type="submit">Send Post</button>
    </div>           
</form>

<svg class="bi pe-none me-2" width="50" height="50"><use xlink:href="#home"></use></svg>


<div class="post-container">
<?php foreach ($posts as $post): ?>
    <div class="post-box">

        <h2><?php echo htmlspecialchars($post['username']); ?></h2>
        <hr>
        <p><?php echo htmlspecialchars($post['postmessage']); ?></p>
    </div>
<?php endforeach; ?>



