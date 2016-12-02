<?php

namespace App\Http\Controllers\Manager;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:permission::access_manager_section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $document = Document::findOrFail($id);

        if (auth()->user()->id !== $document->owner->id) {
            return abort(404);
        }

        $disk = Storage::disk('uploads');

        if ($document->validation_document) {
            $disk->delete($document->validation_document->path);
            $document->validation_document->delete();
        }

        $disk->delete($document->path);

        $document->delete();

        Flash::success(Lang::get('document.destroy-success'));

        return redirect()->back();

    }
}
