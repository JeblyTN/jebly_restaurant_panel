<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\VendorUsers;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DocumentList()
    {
        return view("documents.index");
    }
    public function DocumentUpload($id)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $exist = VendorUsers::where('user_id', $userId)->first();
        $vendorId = $exist->uuid;
        return view("documents.document_upload", compact('vendorId', 'id'));
    }
}
