<?php

// app/Http/Controllers/DatosController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class DatosController extends Controller
{
    public function mostrarFormulario()
    {
        return view('formulario');
    }

    public function guardarDatos(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'number_ci' => 'required|integer|unique:employees,number_ci',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string',
            'pdf' => 'required|mimes:pdf|max:2048', // PDF, tamaño máximo 2MB
        ]);

        // Guardar datos en la base de datos
        $employee = new Employee([
            'number_ci' => $request->input('number_ci'),
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'birthdate' => $request->input('birthdate'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $employee->save();

        // Guardar el archivo PDF
        $pdfPath = $request->file('pdf')->store('pdfs', 'public');

        // Puedes guardar la ruta del PDF en la base de datos si es necesario
        $employee->pdf_path = $pdfPath;
        $employee->save();

        return redirect()->route('mostrarFormulario')->with('success', 'Datos guardados exitosamente.');
    }
}
