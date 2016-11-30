<?php

namespace App\Http\Controllers\Manager;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $documents = $user->documents()->paginate(10);

        return view('pages.manager.document.index')->with(compact('documents'));
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

        $disk = Storage::disk('uploads');

        $disk->delete($document->path);

        $document->delete();

        Flash::success(Lang::get('document.destroy-success'));

        return redirect(action('Manager\DocumentController@index'));

    }
}
