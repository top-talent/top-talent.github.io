<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\NoteRequest;
use App\Repositories\Inventory\Repository as InventoryRepository;

class NoteController extends BaseController
{
    /**
     * @var InventoryRepository
     */
    protected $inventory;

    /**
     * Constructor.
     *
     * @param InventoryRepository $inventory
     */
    public function __construct(InventoryRepository $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Displays the form for creating a new inventory note.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $item = $this->inventory->find($id);

        return view('inventory.notes.create', compact('item'));
    }

    /**
     * Creates a note for the specified inventory.
     *
     * @param NoteRequest $request
     * @param int|string  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoteRequest $request, $id)
    {
        $note = $this->inventory->createNote($request, $id);

        if ($note) {
            $message = 'Successfully created note.';

            return redirect()->route('maintenance.inventory.show', [$id])->withSuccess($message);
        } else {
            $message = 'There was an issue creating a note. Please try again.';

            return redirect()->route('maintenance.inventory.notes.create', [$id])->withErrors($message);
        }
    }

    /**
     * Displays the specified inventory note.
     *
     * @param int|string $id
     * @param int|string $noteId
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $noteId)
    {
        $item = $this->inventory->find($id);

        $note = $item->notes()->find($noteId);

        if ($note) {
            return view('inventory.notes.show', compact('item', 'note'));
        }

        abort(404);
    }

    /**
     * Displays the form for editing the specified inventory note.
     *
     * @param int|string $id
     * @param int|string $noteId
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $noteId)
    {
        $item = $this->inventory->find($id);

        $note = $item->notes()->find($noteId);

        if ($note) {
            return view('inventory.notes.edit', compact('item', 'note'));
        }

        abort(404);
    }

    /**
     * Updates the specified note for the specified inventory.
     *
     * @param NoteRequest $request
     * @param int|string  $id
     * @param int|string  $noteId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NoteRequest $request, $id, $noteId)
    {
        $note = $this->inventory->updateNote($request, $id, $noteId);

        if ($note) {
            $message = 'Successfully updated note.';

            return redirect()->route('maintenance.inventory.notes.show', [$id, $noteId])->withSuccess($message);
        } else {
            $message = 'There was an issue updating this note. Please try again.';

            return redirect()->route('maintenance.inventory.notes.update', [$id, $noteId])->withErrors($message);
        }
    }

    /**
     * Deletes the specified note attached to the specified inventory.
     *
     * @param int|string $id
     * @param int|string $noteId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $noteId)
    {
        if ($this->inventory->deleteNote($id, $noteId)) {
            $message = 'Successfully updated note.';

            return redirect()->route('maintenance.inventory.show', [$id])->withSuccess($message);
        } else {
            $message = 'There was an issue deleting this note. Please try again.';

            return redirect()->route('maintenance.inventory.notes.show', [$id, $noteId])->withErrors($message);
        }
    }
}
