<?php

namespace Webkul\Marketplace\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Marketplace\Repositories\FlagReasonRepository;

class FlagReasonController extends Controller
{
    public function __construct(protected FlagReasonRepository $flagReasonRepository) {}

    public function index()
    {
        $flagReasons = $this->flagReasonRepository->all();

        return view('marketplace::admin.flags.index', compact('flagReasons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'required|in:product,seller',
            'is_active' => 'boolean',
        ]);

        $this->flagReasonRepository->create($data);

        return response()->json(['message' => trans('marketplace::app.admin.flags.create-success')]);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'required|in:product,seller',
            'is_active' => 'boolean',
        ]);

        $this->flagReasonRepository->update($data, $id);

        return response()->json(['message' => trans('marketplace::app.admin.flags.update-success')]);
    }

    public function destroy(int $id)
    {
        $this->flagReasonRepository->delete($id);

        return response()->json(['message' => trans('marketplace::app.admin.flags.delete-success')]);
    }
}
