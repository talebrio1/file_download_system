<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>view</title>
</head>
<body>
    <div class=" flex justify-center">

    
    <div>
      <p>Name: {{ $file->name }}</p>  
      <p>Description:  {{ $file->description }}</p> 
    </div>
   

    <iframe height="1000" width="1000" src="/files/uploads/{{ $file->file_path }}"></iframe>
</div>
</body>
</html>