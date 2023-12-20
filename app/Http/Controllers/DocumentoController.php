<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use App\Models\Employee;
use PDF;
use QrCode;

class DocumentController extends Controller
{
    public function generatePDF($employeeId)
    {
        // Obtén la información del empleado desde la base de datos
        $employee = Employee::find($employeeId);

        // Genera un código único para el documento
        $uniqueCode = uniqid();

        // Crea el PDF con la información del empleado y el código único
        $pdf = PDF::loadView('pdf.template', ['employee' => $employee, 'uniqueCode' => $uniqueCode]);

        // Guarda el PDF en el sistema de archivos
        $pdfPath = public_path("pdfs/{$uniqueCode}.pdf");
        $pdf->save($pdfPath);

        // Genera un código QR con el mismo código único
        QrCode::size(200)->generate($uniqueCode, public_path("qrcodes/{$uniqueCode}.png"));

        return response()->json(['pdf_path' => $pdfPath, 'qr_code_path' => public_path("qrcodes/{$uniqueCode}.png")]);
    }

    public function verifyPDF($code)
    {
        // Verifica la autenticidad del código en la base de datos o en algún otro método que desees implementar

        // Aquí puedes agregar lógica adicional según tus necesidades

        return response()->json(['verification_status' => true]);
    }
}
