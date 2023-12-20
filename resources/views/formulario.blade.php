

@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Formulario de Datos y Documentos</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('guardarDatos') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="number_ci">Número de CI:</label>
            <input type="text" name="number_ci" required>

            <label for="name">Nombre:</label>
            <input type="text" name="name" required>

            <label for="last_name">Apellido:</label>
            <input type="text" name="last_name" required>

            <label for="birthdate">Fecha de Nacimiento:</label>
            <input type="date" name="birthdate" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <label for="pdf">Cargar PDF:</label>
            <input type="file" name="pdf" accept=".pdf" required>

            <button type="submit">Guardar</button>
        </form>
    </div>
@endsection
