<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::all();
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'dari' => 'required|string',
        'kepada' => 'required|string',
        'klasifikasi' => 'required|string',
        'no_telegram' => 'required|string',
        'status' => 'required',
        'twu' => 'required|string',
        'perihal' => 'required|string',
        'file' => 'required|file|mimes:jpg,jpeg,pdf'
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('file', 'public');
    }

    $document = Document::create([
        'dari' => $validatedData['dari'],
        'kepada' => $validatedData['kepada'],
        'klasifikasi' => $validatedData['klasifikasi'],
        'no_telegram' => $validatedData['no_telegram'],
        'twu' => $validatedData['twu'],
        'status' => $validatedData['status'],
        'perihal' => $validatedData['perihal'],
        'file_path' => $filePath,
    ]);

    return response()->json($document, 201);
}


    public function show($id)
    {
        return Document::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $validatedData = $request->validate([
            'dari' => 'string',
            'kepada' => 'string',
            'klasifikasi' => 'string',
            'no_telegram' => 'string',
            'twu' => 'string',
            'status' => 'numeric',
            'perihal' => 'string',
        ]);

        $document->update($validatedData);

        return response()->json($document);
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        Storage::delete($document->file_path);
        $document->delete();

        return response()->json(null, 204);
    }
}