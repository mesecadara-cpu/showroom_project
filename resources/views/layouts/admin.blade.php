<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'klaer-pink-gradient': '#F9F1F5',
                        'klaer-pink-logo': '#F9B9D1',
                        'graphite': '#5C5C5C',
                        'btn-rose': '#B27F85',
                        'btn-rose-hover': '#96666B'
                    },
                    fontFamily: {
                        sans: ["Advent Pro", 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-[#F9F1F5]">
    @yield('content')
</body>
</html>
