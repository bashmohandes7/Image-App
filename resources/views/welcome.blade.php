<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    </head>
    <body>

        <div class="container pt-5">

            <form action="/p" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-7 offset-2">

                        {{-- display success and error messages --}}
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row">
                            <h1>Add New Image</h1>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                            <input id="title" type="text"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            name="title"
                            value="{{ old('title') }}"
                            autocomplete="title" autofocus>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Post Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @if ($errors->has('image'))
                            <strong>{{ $errors->first('image') }}</strong>
                            @endif
                        </div>
                        <div class="row pt-4">
                            <button class="btn btn-primary">Add New Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container pt-5">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-4">
                    <img src="/storage/{{ $product->image }}" class="w-100">
                    <h5 class="pt-2 text-center">{{ $product->title }}</h5>
                </div>
                @endforeach
            </div>
        </div>

    </body>
</html>
