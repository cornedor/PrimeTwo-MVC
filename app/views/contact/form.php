<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PrimeTwo Debug/Development version | contactForm</title>
</head>
<body>
    <form action="/contact/update/<?php echo $contactId; ?>" method="post">
        <!--input type="hidden" name="id" value="123123" /-->
        <label for="someRandomInput">Input: </label>
        <input type="text" id="someRandomInput" name="someRandomInput"><br/>
        <input type="submit" name="submit" value="submit">
    </form>

    <?php echo $string; ?>
</body>
</html>
