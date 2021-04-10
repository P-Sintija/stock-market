<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<p class="text-2xl text-pink-700 --tw-text-opacity: 1; m-4 ">
    <?php echo 'You bought ' . $_SESSION['stock']['symbol'] . ' for ' .
        number_format($_SESSION['wallet']['expenses'] / 100, 2) . ' USD'; ?> </p>

<form method="get" action="/">
    <button class="bg-indigo-400 hover:bg-indigo-500 text-white py-2 px-4 rounded border border-indigo-900 m-4 "
            type="submit" name="back">back
    </button>
</form>

</body>
</html>
