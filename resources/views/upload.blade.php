<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <br>

                <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form">

                    <div class="form-group">
                        <label for="image">Upload Image to S3 Bucket</label>
                        <input id="image" name="image" type="file">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="save_btn" class="btn btn-white btn-info btn-bold">
                            <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>
                            Save
                        </button>
                    </div>

                    {{ csrf_field() }}

                </form>

                <div>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>Filename</td>
                            <td>URL</td>
                            <td>Action</td>
                        </tr>
                        @foreach($images as $key => $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td>{{ $image->image_name }}</td>
                            <td>
                                <a href="{{ $image->image_path }}" target="_blank">
                                {{ $image->image_path }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('download', $image->id) }}" target="_blank">Download</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>