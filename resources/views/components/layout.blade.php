<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                mpesa: '#D9D9D9',
              }
            }
          }
        }
      </script>
    <title>Mpesa Payments</title>
</head>
<body>
    <nav class="flex justify-between items-center mb-4 bg-mpesa h-10">
        <ul class="flex space-x-6 mr-6 text-lg">
            <li class="ml-10">
                <span class="font-bold uppercase">
                    Payments
                </span>
            </li>
        </ul>  
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
    </footer>
    
</body>
</html>